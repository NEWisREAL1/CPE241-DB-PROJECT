<?php
if(!defined('NAVIGATE_PHP')){
    die("You are not allowed to access this page directly.");
}
function navigatePanel($page = null){
    if ($page == null) {
        echo "Error: Page not found";
    }
?>
    <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo $page == "dashboard" ? "#" : "dashboard.php"; ?>" class="nav-link <?php echo $page == "dashboard" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-header">Managements</li>
            <li class="nav-item">
                <a href="<?php echo $page == "dashboard" ? "#" : "manage.php?manage=flight"; ?>" class="nav-link <?php echo $page == "mflight" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-airplane"></i>
                    <p>
                        Manage flight
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page == "dashboard" ? "#" : "manage.php?manage=user"; ?>" class="nav-link <?php echo $page == "muser" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-people"></i>
                    <p>
                        Manage user
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page == "dashboard" ? "#" : "manage.php"; ?>" class="nav-link <?php echo $page == "moverall" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-sliders"></i>
                    <p>
                        Manage
                    </p>
                </a>
            </li>
            <li class="nav-header">Analytics</li>
            <li class="nav-item">
                <a href="<?php echo $page == "dashboard" ? "#" : "reports.php"; ?>" class="nav-link <?php echo $page == "report" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-graph-up-arrow"></i>
                    <p>
                        Reports
                    </p>
                </a>
            </li>
        </ul>
    </nav>

<?php
}
?>