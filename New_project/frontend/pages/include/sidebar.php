<?php
    function isActive ($data) {
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $key = array_search("pages", $array);
        $name = $array[$key + 1];
        return $name === $data ? 'active' : '' ;
    }

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
    <a href="../dashboard/index.html" class="brand-link">
        <img src="../../assets/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Logo Project</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../assets/img/user1.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['email'] ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="../dashboard/index.php" class="nav-link <?php echo isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../catagory/index.php" class="nav-link <?php echo isActive('catagory') ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../config/index.php" class="nav-link <?php echo isActive('config') ?>">
                        <i class="nav-icon far fa-calendar-check"></i>
                        <p>Config</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../information/index.php" class="nav-link <?php echo isActive('information') ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Information</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#homeSubmenu" class="nav-link <?php echo isActive('report') ?>" data-toggle="collapse" aria-expanded="false">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Report</p>
                        <i class="nav-icon fas fa-caret-down"></i>
                    </a>
                    <ul class="nav-item collapse list-unstyled float-left" id="homeSubmenu">
                        <li class="nav-item">
                            <a href="../report/index_1.php" class="nav-link ">
                                <i class="nav-icon fas fa-calendar-week"></i>
                                <p style="width: auto;">Report Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../report/index_2.php" class="nav-link">
                                <i class="nav-icon fas fa-info"></i>
                                <p>Report Category</p>
                            </a>
                            <!-- <a href="../report/index_2.html" class="nav-link">Category</a> -->
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.php" class="nav-link <?php echo isActive('profile') ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-header">บัญชีของเรา</li>
                <li class="nav-item">
                    <a href="../../logout.php" id="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>