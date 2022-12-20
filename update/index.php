<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMS Update Module</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/update">Оновлення</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="/">Головна</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <div class="bg-light p-3 rounded">
        <h3>Software GIT Updating</h3>
        <div class="mb-3">
            <button type="button" hidden class="btn btn-md btn-primary" id="local_branch_button" onclick="getLocalBranches()">Показати доступні гілки</button>
            <select id="LocalBranches" style="display: none">
<!--                <option selected value="develop">develop</option>-->
                <option value="master">master</option>
            </select>
        </div>
        <label>Select branch</label>
        <div class="mb-3">
            <select id="branch">
<!--                <option selected value="develop">develop</option>-->
                <option value="master">master</option>
            </select>
            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalResult" id="branch_button">Move to</button>
            <button type="button" class="btn btn-md btn-warning" data-toggle="modal" data-target="#modalResult" id="update">Check for updates</button>
            <button type="button" class="btn btn-md btn-danger runMigrate" data-toggle="modal" data-target="#modalResult">Start migration</button>
        </div>
    </div>

    <div class="bg-light p-5 rounded">
        <h3>Редагування- apache.conf</h3>
        <form method="post">
        <textarea name="content" id="editor" cols="80" rows="10"><?php
            $data = shell_exec("cat /etc/apache2/sites-available/000-default.conf 2>&1");
            echo $data;?></textarea>
            <p><button type="button" class="btn btn-md btn-primary" id="save_file">Зберегти</button>
            </p>
        </form>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="update-info-body" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    document.getElementById("save_file").addEventListener( 'click', () => {
        let comment = document.getElementById("editor").value;
        console.log(comment);
        $.ajax({
            url: 'update_default_conf.php',
            type: 'POST',
            data: {content: comment},
            success: function (res) {
                const summaryPanel = document.getElementById("update-info-body");
                summaryPanel.innerText = res;
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
    } );
</script>
<script>
    $('body').on('click', '#update', function ()
    {
        let branch_obj = document.getElementById("branch").options.selectedIndex,
            branch = document.getElementById("branch").options[branch_obj].value;
        const summaryPanel = document.getElementById("update-info-body");
        summaryPanel.innerHTML = '<span>Перевірка оновлень </span><span class="spinner-border spinner-border-lg text-info" role="status" aria-hidden="true"></span>';

        this.setAttribute("disabled", "disabled");

        $.ajax({
            url: '/update/migration/hundler.php',
            type: 'POST',
            data: {check: 'check', branch: branch},
            success: function (res) {
                summaryPanel.innerHTML = res;
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
        this.removeAttribute("disabled");
    });
    $('body').on('click', '.runMigrate', function ()
    {
        let branch_obj = document.getElementById("branch").options.selectedIndex,
            branch = document.getElementById("branch").options[branch_obj].value;
            const summaryPanel = document.getElementById("update-info-body");
            summaryPanel.innerHTML = '<span>Виконуємо оновлення </span><span class="spinner-border spinner-border-lg text-info" role="status" aria-hidden="true"></span>';
            this.setAttribute("disabled", "disabled");
        $.ajax({
            url: '/update/migration/hundler.php',
            type: 'POST',
            data: {run: 'run', branch: branch},
            success: function (res) {
                summaryPanel.innerHTML = "Статус оновлення: <br>" + res;
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
        this.removeAttribute("disabled");
    });
    $('body').on('click', '#branch_button', function ()
    {
        let branch_obj = document.getElementById("branch").options.selectedIndex,
            branch = document.getElementById("branch").options[branch_obj].value;
        const summaryPanel = document.getElementById("update-info-body");
        summaryPanel.innerHTML = ' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        this.setAttribute("disabled", "disabled");
        $.ajax({
            url: '/update/migration/hundler.php',
            type: 'POST',
            data: {branch: branch, goToBranch: true},
            success: function (res) {
                summaryPanel.innerText = res;
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
        this.removeAttribute("disabled");
    });
    function getRemoteBranches()
    {
        let branch_select = document.getElementById("branch"),
            branch_button = document.getElementById("branch_button");
        branch_select.style.display = "none";
        branch_button.setAttribute("disabled", "disabled");
        $.ajax({
            url: '/update/migration/hundler.php',
            type: 'POST',
            data: {branch: 'branch'},
            success: function (res) {
                branch_select.innerHTML = res;
                branch_select.style.display = "inline";
                branch_button.removeAttribute("disabled");
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
    }
    function getLocalBranches()
    {
        let branch_button = document.getElementById("branch_button"),
            branch_select = document.getElementById("LocalBranches");
        branch_button.setAttribute("disabled", "disabled");
        $.ajax({
            url: '/update/migration/hundler.php',
            type: 'POST',
            data: {getLocalBranches: 'getLocalBranches'},
            success: function (res) {
                branch_select.innerHTML = res;
                console.log(res);
                branch_select.style.display = "inline";
                branch_button.removeAttribute("disabled");
            },
            error: function (err) {
                alert(JSON.stringify(err));
            }
        });
    }
</script>
</body>
</html>
