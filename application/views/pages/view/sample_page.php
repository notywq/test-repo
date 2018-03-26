<div id="content">
    <div class="container-fluid">
        <h1>Sample page</h1>
        <p>These pages are meant for making interactive design prototypes, which,
        upon approval, may become part of the system at anytime.</p>
        <div class="container">
            <div class='row'>
                <div class='col-xs-12'>
                    <div class="dropdown">
                        <button class="btn btn-default" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-envelope"></span>
                            &nbsp;<span class="hidden-sm hidden-xs">Messages</span>
                        </button>
                        <ul class="dropdown-menu notify-panel">
                            <li class='container-fluid'>
                                <a href='#' class='row notify-unread'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="glyphicon glyphicon-envelope"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong>Cancellation request for Medium-dark Liberica</strong>
                                                <br />
                                                <small>from Maria Guimaras</small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                    We have to cancel this order because of
                                                    a misinterpretation of the blend on our
                                                    part...
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class='container-fluid'>
                                <a href='#' class='row'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong>Edit request for Medium-dark Liberica</strong>
                                                <br />
                                                <small>from Maria Guimaras</small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                    It seems we may have misordered the
                                                    quantity we require. We apologise...
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-default" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-bell"></span>
                            &nbsp;<span class="hidden-sm hidden-xs">Notifications</span>
                        </button>
                        <ul class="dropdown-menu notify-panel">
                            <li class='container-fluid'>
                                <a href='#' class='row notify-unread'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong>Received request</strong>
                                                <br />
                                                <small>Very dark Arabica-Excelsa</small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                due 2018-4-5<br />
                                                For Maria Guimaras
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class='container-fluid'>
                                <a href='#' class='row'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong>Negotiated request</strong>
                                                <br />
                                                <small>Very dark Arabica-Excelsa</small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                due 2018-4-5<br />
                                                For Maria Guimaras
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class='container-fluid'>
                                <a href='#' class='row'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="glyphicon glyphicon-plus-sign"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong>New request</strong>
                                                <br />
                                                <small>Very dark Arabica-Excelsa</small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                due 2018-4-5<br />
                                                For Maria Guimaras
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-12'>
                    <nav class="navbar navbar-default">
                    <!--Modern navbar-->
                    <div class="container-fluid hidden-xs">
                        <div class="navbar-header">
                            <a href='#' class="navbar-brand">
                                WebKape
                            </a>
                        </div>

                        <?php
                        if (isset($logged_in) && $logged_in == TRUE) {
                            ?>
                        <ul class="nav navbar-nav">
                            <li <?php if ($page_title == "Dashboard") { ?>class="active"<?php } ?>><a href="<?= site_url('dashboard')?>">Dashboard</a></li>
                            <li <?php if ($page_title == "Orders") { ?>class="active"<?php } ?>><a href="<?= site_url('orders')?>">Orders</a></li>
                            <li <?php if ($page_title == "My store") { ?>class="active"<?php } ?>><a href="<?= site_url('mystore')?>">My store</a></li>
                            <li <?php if ($page_title == "Browse") { ?>class="active"<?php } ?>><a href="<?= site_url('browse')?>">Browse</a></li>
                        </ul>
                        <div class="navbar-header navbar-right">
                            <span>
                                <a href="#" class="btn btn-default navbar-btn" data-toggle="dropdown">
                                    <span class="fas fa-comments"></span>
                                    <span>1</span>
                                    <span class="hidden-sm hidden-xs">&nbsp;Messages</span>
                                </a>
                                <ul class="dropdown-menu notify-panel">
                                    <li class='container-fluid'>
                                        <a href='#' class='row notify-unread'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-envelope"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Cancellation request for Medium-dark Liberica</strong>
                                                        <br />
                                                        <small>from Maria Guimaras</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                            We have to cancel this order because of
                                                            a misinterpretation of the blend on our
                                                            part...
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-envelope-open"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Edit request for Medium-dark Liberica</strong>
                                                        <br />
                                                        <small>from Maria Guimaras</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                            It seems we may have misordered the
                                                            quantity we require. We apologise...
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="text-right">
                                        <a href="#">
                                            <span class="h4">
                                                <span class="fas fa-angle-right"></span>
                                                See all messages
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                            <span>
                                <a href="#" class="btn btn-default navbar-btn" data-toggle="dropdown">
                                    <span class="fas fa-bell"></span>
                                    <span>1</span>
                                    <span class="hidden-sm hidden-xs">&nbsp;Notifications</span>
                                </a>
                                <ul class="dropdown-menu notify-panel">
                                    <li class='container-fluid'>
                                        <a href='#' class='row notify-unread'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-check-square"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Received request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-edit"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Negotiated request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-plus-circle"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>New request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="text-right">
                                        <a href="#">
                                            <span class="h4">
                                                <span class="fas fa-angle-right"></span>
                                                See all notifications
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                            <span>
                                <a class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="fas fa-user-circle"></span>
                                    <span class="hidden-sm">&nbsp;<?= $m_fmlname ?>&nbsp;</span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="visible-sm dropdown-header">Logged in as:</li>
                                    <li class="visible-sm"><a ><?= $m_flname ?></a></li>
                                    <li role="separator" class="visible-sm divider"></li>
                                    <li><a href="<?= site_url('profile')?>"><span class="fas fa-user"></span>&nbsp;Profile</a></li>
                                    <li><a ><span class="fas fa-cog"></span>&nbsp;Settings</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?= site_url('logout')?>"><span class="fas fa-sign-out-alt"></span>&nbsp;Log out</a></li>
                                </ul>
                            </span>
                        </div>
                            <?php
                        }
                        else {
                            ?>
                        <!--Navbar sections as lists-->
                        <ul class="nav navbar-nav">
                            <li <?php if ($page_title == 'Browse') { ?>
                                    class="active"
                                <?php } ?>>
                                <a href="<?= site_url('browse')?>">Browse</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li <?php if ($page_title == 'Log in') { ?>
                                    class="active"
                                <?php } ?>>
                                <a href="<?= site_url('login')?>">Log in</a>
                            </li>
                            <li <?php if ($page_title == 'Sign up') { ?>
                                    class="active"
                                <?php } ?>>
                                <a href="<?= site_url('signup')?>">Sign up</a>
                            </li>
                        </ul>
                            <?php
                        }
                        ?>
                    </div>

                    <!--Alternative navbar for mobile (uses sidebar)-->
                    <div class="container-fluid visible-xs">
                    <?php
                    if (isset($logged_in) && $logged_in == true) {
                    ?>
                        <div class="navbar-header">
                            <a class="btn btn-default navbar-brand sidebarCollapse">
                                <span class="fas fa-bars"></span>
                            </a>
                            <span>
                                <a class="btn btn-link navbar-brand" data-toggle="dropdown">
                                    WebKape
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header">Logged in as:</li>
                                    <li><a ><?= $m_flname ?></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="<?= site_url('home')?>">
                                            <span class="fas fa-home"></span>
                                            &nbsp;Home</a>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('profile')?>">
                                            <span class="fas fa-user"></span>
                                            &nbsp;Profile</a>
                                    </li>
                                    <li>
                                        <a >
                                            <span class="fas fa-cog"></span>
                                            &nbsp;Settings</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="<?= site_url('logout')?>">
                                            <span class="fas fa-sign-out-alt"></span>
                                            &nbsp;Log out</a>
                                    </li>
                                </ul>
                            </span>
                            
                            <!-- NOTE: With .navbar-toggle, the buttons will be
                            in reverse order. -->
                            
                            <span>
                                <button class="btn btn-default navbar-toggle" data-toggle="dropdown">
                                    <span class="fas fa-bell"></span>
                                    <span>1</span>
                                    <span class="hidden-sm hidden-xs">&nbsp;Notifications</span>
                                </button>
                                <ul class="dropdown-menu notify-panel">
                                    <li class='container-fluid'>
                                        <a href='#' class='row notify-unread'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-check-square"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Received request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-edit"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Negotiated request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-plus-circle"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>New request</strong>
                                                        <br />
                                                        <small>Very dark Arabica-Excelsa</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                        due 2018-4-5<br />
                                                        For Maria Guimaras
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="text-right">
                                        <a href="#">
                                            <span class="h4">
                                                <span class="fas fa-angle-right"></span>
                                                See all notifications
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                            
                            <span>
                                <button class="btn btn-default navbar-toggle" data-toggle="dropdown">
                                    <span class="fas fa-comments"></span>
                                    <span>1</span>
                                    <span class="hidden-sm hidden-xs">&nbsp;Messages</span>
                                </button>
                                <ul class="dropdown-menu notify-panel">
                                    <li class='container-fluid'>
                                        <a href='#' class='row notify-unread'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-envelope"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Cancellation request for Medium-dark Liberica</strong>
                                                        <br />
                                                        <small>from Maria Guimaras</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                            We have to cancel this order because of
                                                            a misinterpretation of the blend on our
                                                            part...
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class='container-fluid'>
                                        <a href='#' class='row'>
                                            <span class='col-xs-1'>
                                                <span class='notify-mold'>
                                                    <span class="h5">
                                                        <span class="fas fa-envelope-open"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class='col-xs-10'>
                                                <span class="notify-mold">
                                                    <span class="h5">
                                                        <strong>Edit request for Medium-dark Liberica</strong>
                                                        <br />
                                                        <small>from Maria Guimaras</small>
                                                    </span>
                                                    <span class='a-line'></span>
                                                    <span class='h5'>
                                                        <small>
                                                            It seems we may have misordered the
                                                            quantity we require. We apologise...
                                                        </small>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="text-right">
                                        <a href="#">
                                            <span class="h4">
                                                <span class="fas fa-angle-right"></span>
                                                See all messages
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                        </div>
                    <?php
                    }
                    else {
                    ?>
                        <div class="navbar-header">
                            <span>
                                <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                    WebKape
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li <?php if ($page_title == 'Home') { ?>
                                            class="active"
                                        <?php } ?>>
                                        <a href="<?= site_url('home') ?>">Home</a>
                                    </li>
                                    <li <?php if ($page_title == 'Browse') { ?>
                                            class="active"
                                        <?php } ?>>
                                        <a href="<?= site_url('browse')?>">Browse</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li <?php if ($page_title == 'Log in') { ?>
                                            class="active"
                                        <?php } ?>>
                                        <a href="<?= site_url('login')?>">Log in</a>
                                    </li>
                                    <li <?php if ($page_title == 'Sign up') { ?>
                                            class="active"
                                        <?php } ?>>
                                        <a href="<?= site_url('signup')?>">Sign up</a>
                                    </li>
                                </ul>
                            </span>
                        </div>
                    <?php    
                    }
                    ?>
                    </div>
                    
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
