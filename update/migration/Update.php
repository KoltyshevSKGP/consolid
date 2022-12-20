<?php

/**
 * @class Update Відповідає за оновлення системи та бази данних
 *
 * Має 2 інтерфейси:
 *  `checkNewVersion()`-перевіряє наявність оновлень
 *  `runMigrate()`-запускає процесс оновлень
 *
 * Умови для успішного застосування модулю:
 *  - в корні додатку вже має бути ініціалізований git, та налагоджений зв'язок між видаленим сервером git
 *  - користувач серверу www-data має бути owner додатку. Для цього виконайте команду в терміналі:
 *      `sudo chown -R www-data $_SERVER["DOCUMENT_ROOT"]."/каталог-додатку`
 *  - Користувачі додатку не повинні змінювати файлову систему додатку локально.
 *      Всі зміни ПОВИННІ завантажуватися лише з видаленного git репозиторію.
 *      В іншому випадку, всі локальні зміни будуть перезаписані данними з видаленного git репозиторію.
 *
 * Вхідні параметри для створення єкземпляру классу:
 *  -array  вхідні параметри для підключення до бази данних
 *  -string назва таблиці бази данних, де зберігаються версії БД
 *  -string Путь до корню проекту
 *  -string Назва гілки Git, з якою буде працювати скрипт
 *  -string повний (від корня) путь до папки, де зберігається файли міграцій *.sql
 */

namespace update\migration;

use Exception;
use mysqli;

class Update
{
    /**
     * Массив параметрів підключення до Бази данних
     * Вхідний массив повинен містити наступні ключі:
     * 'host' - хост підключення до бази данних MySQL,
     * 'user' - user name для підключення до бази данних MySQL,
     * 'pass' - пароль для підключення до бази данних MySQL,
     * 'db' - назва бази данних MySQL
     * @var array
     */
    public $db_params = [];
    /**
     * Об'єкт підключення до бази данних
     * @var mysqli
     */
    public $conn;
    /**
     * Путь до папки, де будуть зберігатися файли міграції *.sql
     * За замовченням пуста строка, яка говорить, про те,
     * що файли міграцій розташовані в тій же папці, що і класс
     *
     * @var string
     */
    public $sqlFolder;
    /**
     * Назва гілки Git, з якою буде працювати скрипт
     * @var string
     */
    public $branch;
    /**
     * Для ОС Windows, путь де знаходиться git.exe
     * @var string
     */
    public $pathToGit;
    /**
     * Операційна система де буде працювати скрипт
     * @var bool
     */
    public $os;
    /**
     * Путь до корню проекту
     * @var string
     */
    public $root;

    /**
     * Update constructor.
     *
     * В конструкторі визначаємо наступні параметри:
     * параметри підключення до бази данних
     * назву таблиці в базі данних для зберігання версій
     * створюємо mysqli підключення до бази данних
     * визначаємо гілку git, з якою буде працювати скрипт
     * визначаємо операційну систему серверу
     * визначаємо путь до git.exe в залежності від операційної системи
     *
     * @param array $db_conf вхідні параметри для підключення до бази данних
     * @param string $db_table_version назва таблиці бази данних, де зберігаються версії БД
     * @param string $root Путь до корню проекту
     * @param string $branch Назва гілки Git, з якою буде працювати скрипт
     * @param string $sqlFolder повний (від корня) путь до папки, де зберігається файли міграцій *.sql
     * @throws Exception
     */
    public function __construct(
        array $db_conf,
        string $db_table_version,
        string $root,
        string $branch,
        string $sqlFolder
    ) {
        $this->db_params = $db_conf;
        $this->db_params['db_table_version'] = $db_table_version;
        $this->getSqlFolder($sqlFolder);
        $this->conn = $this->connectDb();
        $this->branch = $branch;
        $this->os = strtolower(substr(php_uname(), 0, 7)) == 'windows';
        $this->pathToGit = ($this->os) ? '"C:\Program Files\Git\cmd\git.exe"' : 'git';
        $this->root = $root;
    }
    /**
     * Public `checkNewVersion()` Перевірка наявності оновлень:
     *
     * Публічна Функція (Інтерфейс користувача)
     * Перевіряє наявність оновлень файлової системи, файлів міграції бази данних
     * Також перевіряє наявність локальних змін файлової системи
     * При наявності локальних змін, повідомляє користувача, що вони будуть затерті
     *
     * Функція працює з властивостями классу
     *
     * @return string
     */
    public function checkNewVersion()
    {
        /**Перевіряємо чи по поточній гілці ми робимо запит*/
        $currentBranch = $this->getCurLocalBranch();
        if ($this->branch !== $currentBranch) {
            return "Поточна гілка {$currentBranch} відрізняється від обраної {$this->branch}".
                '<br>Спочатку здійсніть перехід';
        }
        /**
         * @param $checkUpdate bool флаг наявності оновлень
         */
        $checkUpdate = false;
        /**
        // * @param $gitStatus array массив локального стану файлової системи
         */
        $gitStatus = $this->gitStatus();
        /**
         * Блок перевіряє, чи були змінені локально файли додатку
         *
         * $gitStatus['ahead'] - наявність локальних git commits
         * $gitStatus['isChanges'] - наявність локальних змін, які не були додані в локальний git commit
         */
        echo '<br><b>Перевірка на наявність локальних змін</b>';
        if (($gitStatus['ahead'] || $gitStatus['isChanges'])) {
            echo '<br>Наявні локальні зміни файлової системи.'
                .' <br> При оновленні, всі локальні зміни будуть перезаписані.'
                .' <br> Детальна інформація по локальним змінам: <br> '
                .' <br> '.$gitStatus['changesLog'].' <br> ';
        } else {
            echo '<br>Все добре<br>';
        }
        /**
         * Команда shell_exec робить запит до Git репозиторію на скачування оновлень
         * cd {$this->root} - переходить до корню проекту, де знаходиться локальний гіт репозиторій
         * git fetch - загружає оновлення з видаленого Git репозиторію, але не накатує їх на робочі файли
         */
        echo '<br><b>Блок оновлень файлової системи</b>';
        $fetch_all = shell_exec("cd {$this->root} &&" . $this->pathToGit . ' fetch --all 2>&1');
        echo '<br> Завантаження оновлень з серверу...';
        /**
         * @param $gitLogStr string формуємо git команду на перевірку різниці
         * локальної версії додатку та версії з видаленного серверу
         */
        $gitLogStr = "{$this->pathToGit} log --pretty=oneline origin/{$this->branch}...{$this->branch} --left-right";
        /**
         *
         * Виконуємо запит на перевірку різниці версій
         *
         * @param $gitLog string Строка яка містить різницю в версіях
         * Якщо повертається пуста строка, то оновлень немає, інакше повертає опис різниці
         */
        $gitLog = shell_exec("cd  {$this->root}  &&" . $gitLogStr . ' 2>&1');
        echo '<br> Порівняння різниці версій...';
//        /**
//         * Якщо сервер працює під Windows, переводимо кодировку з 'cp866' до 'UTF-8'
//         */
//        if ($this->os) {
//            $gitLog  = iconv('cp866', 'UTF-8', $gitLog);
//        }
        /**
         * Перевіряємо змінну $gitLog на наявність оновлень,
         * якщо оновлення є, виводимо користувачу детальну інформацію користувачу,
         * та ставимо флаг наявності оновлень
         */
        if (!empty($gitLog)) {

            echo '<p class="text-success"><b>Доступні оновлення</b></p>';
            echo $gitLog;
            $checkUpdate = true;
        } else {
            echo '<p class="text-success"><b>Оновлення відсутні</b></p>';
        }
        /**
         *
         * Виконуємо запит на перевірку необхідності оновити Базу данних
         *
         * @param $files array Масив sql міграцій, які необхідно виконати
         * Якщо не пусто, виводимо користувачу список файлів для оновлення
         */
        echo '<br><b>Блок оновлень Бази даних</b>';
        $files = $this->getMigrationFiles();
        if (!empty($files)) {
            echo '<br>Доступні нові міграції:<br>';
            $checkUpdate = true;
            echo implode('<br>', $files);
        } else {
            echo '<p class="text-success"><b>Оновлення відсутні</b></p>';
        }
        /**
         * Перевіряємо, якщо оновлень немає, повертаємо строку з текстом, що оновлень немає
         */
        if (!$checkUpdate) {
            return '<div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Оновлень немає!</h5>
                  Встановлена остання версія
                </div>';
        }
        return '<div class="callout callout-danger">
                  <h5>Доступні оновлення!</h5>
                  <p>Можна оновитися</p>
                <button type="button" class="btn btn-md btn-danger runMigrate">Запуск Міграції</button>
                </div>';
    }
    /**
     * Public `runMigrate()` Оновлення додатку:
     *
     * Публічна Функція (Інтерфейс користувача)
     * Спочатку видаляємо всі локальні зміни файлової системи
     * Другим кроком оновлюємо Базу данних (при наявності оновлень)
     * Третім кроком оновлюємо файлову систему
     *
     */
    public function runMigrate()
    {
        /**Перевіряємо чи по поточній гілці ми робимо запит*/
        $currentBranch = $this->getCurLocalBranch();
        if ($this->branch !== $currentBranch) {
            return "Поточна гілка {$currentBranch} відрізняється від обраної {$this->branch}".
                '<br>Спочатку здійсніть перехід';
        }

        /**Видалення локальних змін файлової системи*/
        $this->gitResetLocalChanges();
        /**
         * Отримання списку файлів sql для міграції бази данних
         * @param $files array массив файлів міграцій для оновлення
         */
        echo '<br><b>Оновлення бази даних</b><br>';
        $files = $this->getMigrationFiles();
        /**Якщо оновлювати нічого, оновлюємо файлову систему, та виходимо*/
        if (!empty($files)) {
            /**Накатуємо кожен файл міграції по черзі*/
            foreach ($files as $file) {
                $this->migrate($file);
                echo 'Оновлено:' . basename($file) . '<br>';
            }
        } else {
            echo '<p class="text-success"><b>Оновлень бази даних немає</b></p>';
        }
        /**Запуск функції оновлення файлової системи*/
        echo '<br><b>Оновлення файлової системи</b>';
        $this->filesUpdate();
        return '<div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Оновлення виконано!</h5>
                  Встановлена остання версія
                </div>';
    }
    /**
     * Private `getMigrationFiles()` Отримання файлів міграцій бази данних:
     *
     * Закрита функція классу
     * Додаємо файли міграцій до робочого каталогу з завантажених оновлень git
     * Формуємо массив всіх файлів міграцій з робочого каталогу
     * Робимо запит до Бази данних на наявність таблиці з версіями
     * Якщо таблиці не існує, повертаємо весь список файлів міграцій
     * Якщо таблиця міграцій існує в базі данних,
     * то повретаємо список лише тих файлів з робочого каталогу,
     * які відсутні в записах таблиці версій
     *
     * @return array Массив файлів, доступних для оновлення бази данних
     */
    private function getMigrationFiles()
    {
        /**
         * @param $sqlFolder string Локальна змінна з відносним шляхом до файлів з міграціями
         */
        $sqlFolder = trim(
            str_ireplace(str_ireplace('\\', '/', $this->root), '', $this->sqlFolder),
            '/'
        );
        /**
         * @param $load_sql_files string Git команда для завантаження оновленого списку файлів міграції
         */
        $load_sql_files = $this->pathToGit . ' checkout  origin/' . $this->branch . ' ' . $sqlFolder . '/';
        echo '<br>Переходимо до папки з SQL-файлами...';
        /**
         * Виконуємо shell_exec команду на завантаження оновленого списку міграцій бази данних
         */
        shell_exec("cd {$this->root}  &&" . $load_sql_files);
        /**
         * @param $allFiles array Формування массиву всіх файлів міграцій з робочого каталогу
         */
        echo '<br>Читаємо всі SQL файли...';
        $allFiles = glob($this->sqlFolder . '*.sql');
        /**
         * @param $firstMigration bool Флаг наявності таблиці з версіями в базі данних
         */
        $firstMigration = $this->isSetTableMigration();
        /**
         * Якщо таблиці версій в базі данних не існує, повертаємо весь список міграційних файлів
         */
        if ($firstMigration) {
            return $allFiles;
        }
        /**
         * @param $query string Строка MySQL запиту списку міграцій, які вже є в базі данних
         */
        $query = sprintf(
            'SELECT `name` FROM `%s`',
            $this->db_params['db_table_version']
        );
        /**
         * @param $data array масив списку міграцій, які вже є в базі данних
         */
        $data = $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        /**
         * @param $versionsFiles array масив списку міграцій з бази данних,
         * які вже є в базі данних з додаванням повного шляху
         */
        $versionsFiles = [];
        foreach ($data as $row) {
            $versionsFiles[] = $this->sqlFolder . $row['name'];
        }
        /**
         * Повертаємо массив з файлами міграцій,
         * які є в робочому каталозі, але не були ще застосовані до Бази данних
         */
        return array_diff($allFiles, $versionsFiles);
    }
    /**
     * Private `migrate()` Функція оновлення таблиць бази данних
     *
     * Порядок дій:
     * -формуємо команду терміналу на виконання SQL-запиту із зовнішнього файлу
     * -виконуємо shell-команду з міграцією
     * -витягуємо назву SQL-запиту з змінної $file
     * -формуємо запит на додавання запису в таблицю міграцій
     * -виконуємо запис в таблицю міграцій
     *
     * @param $file string Шлях до файлу з SQL міграцією
     */
    private function migrate(string $file)
    {
        /**
         *
         * @param $command string Командa для терміналу на виконання SQL-запиту із зовнішнього файлу
         */
        $command = sprintf(
            'mysql -u%s -p%s -h %s -D %s < %s',
            $this->db_params['user'],
            $this->db_params['pass'],
            $this->db_params['host'],
            $this->db_params['db'],
            $file
        );
        /**
         * виконуємо shell-команду з міграцією
         */
        shell_exec($command);

        /**
         *
         * Вирізаємо з путі до файлу міграції його назву, для запису в таблицю міграцій
         * @param $baseName string Назва файлу міграції без шляху та типу файлу
         */
        $baseName = basename($file);
        /**
         *
         * Формуємо запит на запис назви файлу міграції до Бази данних в таблицю з версіями
         *
         * @param $query string Запит на запис назви файлу міграції до таблиці з версіями
         */
        $query = sprintf(
            'INSERT INTO `%s` (`name`) VALUES ("%s")',
            $this->db_params['db_table_version'],
            $baseName
        );
        /**
         *
         *Виконуемо запис назви файлу міграції до Бази данних в таблицю з версіями
         *
         */
        $this->conn->query($query);
    }
    /**
     * Private `getSqlFolder()` Функція встановлення путі до папки з файлами міграцій
     *
     * Якщо приходить пуста строка, то шлях до файлів формується як такий же, в якому знаходиться цей класс
     * Переводимо слеши до Unix формату
     *
     * @param $sqlFolder string Відформатована строка зі шляхом до категорії з файлами міграцій бази данних
     */
    private function getSqlFolder(string $sqlFolder)
    {
        if (empty($sqlFolder)) {
            $this->sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/');
        } else {
            $this->sqlFolder = str_replace('\\', '/', rtrim($sqlFolder, '/') . '/');
        }
    }
    /**
     * Private `isSetTableMigration()` Функція перевірки наявності таблиці міграцій в Базі данних
     *
     * @return bool Флаг наявності таблиці міграцій в базі даних
     */
    private function isSetTableMigration()
    {
        $data = [];
        /**
         * @param $query string Строка MySQL запиту наявності таблиці міграцій в базі данних
         */
        $query = sprintf(
            'SHOW TABLES FROM `%s` like "%s"',
            $this->db_params['db'],
            $this->db_params['db_table_version']
        );
        $data = $this->conn->query($query);
        return !$data->num_rows;
    }
    /**
     * Private `filesUpdate()` Функція оновлення файлової системи додатку (`git pull`)
     *
     * Виконуємо в терміналі Git команду `git pull`.
     * Виводимо споміщення результату оновлення користувачу
     */
    private function filesUpdate()
    {
        echo '<br>Оновлюємо файлову систему...<br>';
        $this->gitResetLocalChanges();
        $result = shell_exec("cd {$this->root}  && " . $this->pathToGit . " pull origin {$this->branch} " . ' 2>&1');
        if ($this->os) {
            $result = iconv('cp866', 'UTF-8', $result);
        }
        echo "Деталі оновлення:<br><br>{$result}<br><br>";
        echo '<p class="text-success"><b>Файлова система оновлена</b></p>';
    }
    /**
     * private `gitStatus()` Функція перевірки наявності локальних змін (`git status`)
     *
     * Виконується команда git status, та обробляється відповідь на наявність локальних змін
     *
     * @return array|bool[] повертає массив наступних статусів:
     * 'ahead' - наявність локальних git commit
     * 'ahead_count' - кількість наявних git commit
     * 'isChanges' - наявність локальних змін, які не були закомічені командою git commit
     * 'behind' - наявність зовнішніх коммітів, які були завантажені командою git fetch, але не були застосовані
     * 'isGood' - говорить про відсутність локальних змін файлової системи додатку
     */
    private function gitStatus()
    {
        $result = [
           'ahead' => false,
           'isChanges' => false,
            'changesLog' => '',
           'isGood' => false,
            'behind' => false,
        ];
        /**
         * @param $message string Результуюча строка відповіді команди git status
         */
        $message = shell_exec("cd {$this->root} && " . $this->pathToGit . " status " . ' 2>&1');
        /**
         * Перевіряємо наявність слова `ahead`, яке говорить про наявність локальних коммітів
         */
        $result['ahead'] = substr_count($message, 'ahead') == 1;
        /**
         * Якщо є локальні комміти, то достаємо їх кількість.
         */
        if ($result['ahead']) {
            preg_match('/by ([^ comit]*)/', $message, $matches);
            $result['ahead_count'] = $matches[1];
        }
        /**
         * Перевіряємо наявність слова `behind`, яке говорить про наявність нових коммітів на сервері (оновлень)
         * Які були завантажені, але не застосовані
         */
        $result['behind'] = substr_count($message, 'behind') == 1;
        /**
         * Перевіряємо наявність локальних змін, до яких не застосовувалася команда git commit
         *
         */
        $result['isChanges'] = substr_count($message, 'nothing to commit, working tree clean') == 0;
        if ($result['isChanges']) {
            $result['changesLog'] = $message;
        }
        /**
         * Якщо немає локальних git коммітів та локальних змін робочого каталогу
         * Тоді нічого не затреться при оновлені
         */
        $result['isGood'] = ($result['isChanges'] == false && $result['ahead'] == false);
        /**
         * Повертаємо масив статусів
         */
        return $result;
    }
    /**
     * private `gitResetLocalChanges()` Функція видалення локальних змін додатку
     *
     * В залежності від типу наявних локальних змін, виконується одна або обидві Git команди:
     * `git reset --hard`- при наявності локальних не закоміченних змін
     * `git reset --hard HEAD~{кількість локальних коммітів}` - при наявності локальних коммітів
     *
     */
    private function gitResetLocalChanges()
    {
        /**
         * Виконуємо команду `gitStatus()` для отримання інформації, що до наявності локальних змін
         *
         * @param $gitStatus array Массив статусів наявності локальних змін
         */
        $gitStatus = $this->gitStatus();
        /**
         * Виконуємо в терміналі команду `git reset --hard`
         * - при наявності локальних не закоміченних змін
         */
        if ($gitStatus['isChanges']) {
            shell_exec("cd {$this->root}  && " . $this->pathToGit . " reset --hard " . ' 2>&1');
        }
        /**
         * Виконуємо в терміналі команду `git reset --hard HEAD~{кількість локальних коммітів}`
         * - при наявності локальних коммітів
         */
        if ($gitStatus['ahead']) {
            shell_exec("cd {$this->root}  && " . $this->pathToGit . " reset --hard HEAD~{$gitStatus['ahead_count']} " . ' 2>&1');
        }
        shell_exec("cd {$this->root}  && " . $this->pathToGit . " clean -df " . ' 2>&1');
    }
    /**
     *Функція підключення до БД
     *
     * @return mysqli
     * @throws Exception
     */
    private function connectDb()
    {
        $errorMessage = 'Неможливо підключитися до серверу Бази данних';
        $conn = new mysqli(
            $this->db_params['host'],
            $this->db_params['user'],
            $this->db_params['pass'],
            $this->db_params['db']
        );
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = $conn->query('set names utf8');
        if (!$query) {
            die("NO access do query to db: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
    public function getRemoteBranches()
    {
        $response='';
        shell_exec("cd {$this->root} && " . $this->pathToGit . " fetch" . ' 2>&1');
        $message = shell_exec("cd {$this->root} && " . $this->pathToGit . " branch" . ' 2>&1');
        $message = str_replace(array("\n", "\t", "  ","origin/"), ' ', $message);
        $message = explode(' ', $message);
        foreach ($message as $el) {
            if (!empty($el)) {
                $response .= '<option value="' . $el . '">' . $el . '</option>';
            }
        }
        $response = '<option selected '.substr($response, 8);
        echo $response;
    }
    public function getCurLocalBranch()
    {
        $response='';
        $message = shell_exec("cd {$this->root} && " . $this->pathToGit . " symbolic-ref --short HEAD" . ' 2>&1');
        $message = str_replace(array("\n", "\t", "  "), ' ', $message);
        $message = explode(' ', $message);
        $response = $message[0];
        return $response;
    }
    public function getAllLocalBranches()
    {
        $response='';
        $message = shell_exec("cd {$this->root} && " . $this->pathToGit . " branch" . ' 2>&1');
        $message = str_replace(array("\n", "\t", "  "), ' ', $message);
        $message = str_replace("* ", '*_', $message);
        $message = explode(' ', $message);
        foreach ($message as $el) {
            if (!empty($el)) {

                $response .= '<option value="';
                if (substr($el,0, 2) == '*_') {
                    $el = str_replace('*_', '', $el);
                    $response .= $el.'">';
                    $response .= $el.' (Поточна)</option>';
                } else {
                    $response .= $el .'">'.$el.'</option>';
                }
            }
        }
        $response = '<option selected '.substr($response, 8);
        echo $response;
    }
    public function checkoutToBranch($branch)
    {
        /**Перевіряємо поточну гілку*/
        $currentBranch = $this->getCurLocalBranch();
        if ($branch == $currentBranch) {
            return 'Ви на поточній гілці ' . $branch;
        }
        /**Витягуємо всі локальні гілки*/
        $allLocalBranches = shell_exec("cd {$this->root} && " . $this->pathToGit . " branch " . ' 2>&1');
        /**Оброблюємо строку та переводимо в массив*/
        $allLocalBranches = str_replace(array("\n", "\t", "  ","* "), ' ', $allLocalBranches);
        $allLocalBranches = explode(' ', $allLocalBranches);
        /**Якщо переданої гілки немає в списку поточних локальних виходимо, бо нікуди переходити*/
        if (!in_array($branch, $allLocalBranches)) {
            return "Гілки {$branch} Не існує. Виберіть іншу";
        }
        /**Перед переходом перевіряємо чи є не закомічені локальні зміни поточної гілки*/
        $gitStatus = $this->gitStatus();
        if ($gitStatus['isChanges']) {
            shell_exec("cd {$this->root}  && " . $this->pathToGit . " reset --hard " . ' 2>&1');
            shell_exec("cd {$this->root}  && " . $this->pathToGit . " clean -df " . ' 2>&1');
//            return 'Є локольно змінені файли. Перехід на нову гілку неможливий' .
//                PHP_EOL . $gitStatus['changesLog'].PHP_EOL;
        }
        /**Робимо запит на зміну гілки*/
        $mistake = shell_exec("cd {$this->root} && " . $this->pathToGit . " checkout {$branch} " . ' 2>&1');
        /**Знову дістаємо поточну гілку, вона повинна була змінитися на передану*/
        $currentBranch = $this->getCurLocalBranch();
        /**Якщо поточна гілка не дорівнює переданій, виводимо текст помилки на перехід*/
        if ($branch !== $currentBranch) {
            return 'Не вдалося перейти на гілку ' . $branch.PHP_EOL.' Детальна інформація ' . $mistake.PHP_EOL;
        }
        /**Виводимо повідомлення про успішний перехід на іншу гілку*/
        return 'Ви успішно перейшли на гілку ' . $branch;
    }
    //git branch --track local_branch_name origin/remote_branch_name
}
