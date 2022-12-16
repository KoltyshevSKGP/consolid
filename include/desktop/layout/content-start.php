<?php
//if(!isset($settingsPage["title"])) {
//    $settingsPage["title"]="Page without name";
    if(!isset($settingsPage["navigation_array"]) || count($settingsPage["navigation_array"])==0) {
        $settingsPage["navigation"]='<li class="breadcrumb-item"><a href="/">Головна</a></li>';
    } else {
        foreach ($settingsPage["navigation_array"] as $name => $link) {
            if($link!="") $link=" href='".$link."'";
            $settingsPage["navigation"].='<li class="breadcrumb-item"><a '.$link.'>'.$name.'</a></li>';
        }
    }
//}
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0"><?php echo $settingsPage["title"];?></h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <?php echo $settingsPage["navigation"];?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none" style="display: none !important;">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">