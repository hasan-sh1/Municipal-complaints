<style>
    :root {
        --mian_color: #257180;
        --crame: #F2E5BF;
        --orange: #FD8B51;
        --brown: #CB6040;
        --gray: #dadadae2;
    }
</style>


<nav class="page-sidebar" id="sidebar" style="background-color: var(--mian_color);">
    <div id="sidebar-collapse" style="background-color: var(--mian_color);">
        <div class="admin-block d-flex">
            <div>
                <img src="../css/assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">

                <div class="font-strong" style="color: var(--crame);"><?= $_SESSION['user_name'] ?></div><small
                    style="color: var(--crame);">Administrator</small>
            </div>

        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="./dashboard.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label" style="color: var(--crame);">Dashboard</span>
                </a>

            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                    <span class="nav-label" style="color: var(--crame);">Complaints</span><i
                        class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="./complaints.php" style="color: var(--crame);">View Complaints</a>
                    </li>
                </ul>
            </li>

            <li class="heading" style="color: var(--crame);">PAGES</li>
        </ul>
    </div>
</nav>