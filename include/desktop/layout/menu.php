<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
                    <h2 class="brand-text">Consolid App</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/dashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Email">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Транспорт</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/dashboard"><i data-feather="activity"></i><span class="menu-title text-truncate" data-i18n="Email">Реєстр</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/to_send"><i data-feather="navigation"></i><span class="menu-title text-truncate" data-i18n="Email">Запити на доставку</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/to_deliver"><i data-feather="truck"></i><span class="menu-title text-truncate" data-i18n="Email">Транспортні запити</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/ttn"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Email">Рейси</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Склад</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="activity"></i><span class="menu-title text-truncate" data-i18n="Email">Реєстр</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/wh_income"><i data-feather="download"></i><span class="menu-title text-truncate" data-i18n="Email">Прийом</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/wh_outcome"><i data-feather="upload"></i><span class="menu-title text-truncate" data-i18n="Email">Відвантаження</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/requests/wh_service"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Email">Послуги</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Бухгалтерія</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/agreements"><i data-feather="align-justify"></i><span class="menu-title text-truncate" data-i18n="Email">Договори</span></a>
            </li>
            <li class="disabled nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="dollar-sign"></i><span class="menu-title text-truncate" data-i18n="Email">Фінанси</span></a>
            </li>
            <li class="disabled nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Email">Документи</span></a>
            </li>
            <?php if($_SESSION["role"]==1 || $_SESSION["role"]==2):?>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Адмін-панель</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/admin/user"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Email">Користувачі</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/admin/company"><i data-feather="columns"></i><span class="menu-title text-truncate" data-i18n="Email">Компанії</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/admin/location"><i data-feather="crosshair"></i><span class="menu-title text-truncate" data-i18n="Email">Локації</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/admin/product"><i data-feather="codepen"></i><span class="menu-title text-truncate" data-i18n="Email">SKU</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="/desktop/admin/transport"><i data-feather="truck"></i><span class="menu-title text-truncate" data-i18n="Email">Автопарк</span></a>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->