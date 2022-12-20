<?php

if (isset($_POST) && !empty($_POST['content'])) {
    $data = trim($_POST['content']);
    echo shell_exec('echo "' . $data . '" > /etc/apache2/sites-available/000-default.conf 2>&1');
    echo shell_exec("sudo service apache2 restart 2>&1");
}

