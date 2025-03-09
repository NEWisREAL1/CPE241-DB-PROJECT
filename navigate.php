<?php
// ---------------------
// Prevention of direct access
if(!defined('NAVIGATE_PHP')){
    // 403 Forbidden header
    header("HTTP/1.1 403 Forbidden");
    die("You are not allowed to access this page directly.");
}
// ---------------------
// Function to generate navigation panel sidebar of the admin system
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
                <a href="<?php echo $page == "mflight" ? "#" : "manage.php?manage=flight"; ?>" class="nav-link <?php echo $page == "mflight" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-airplane"></i>
                    <p>
                        Manage flight
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page == "muser" ? "#" : "manage.php?manage=user"; ?>" class="nav-link <?php echo $page == "muser" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-people"></i>
                    <p>
                        Manage user
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page == "moverall" ? "#" : "manage.php"; ?>" class="nav-link <?php echo $page == "moverall" ? "active" : "" ?>">
                    <i class="nav-icon bi bi-sliders"></i>
                    <p>
                        Manage
                    </p>
                </a>
            </li>
            <li class="nav-header">Analytics</li>
            <li class="nav-item">
                <a href="<?php echo $page == "report" ? "#" : "reports.php"; ?>" class="nav-link <?php echo $page == "report" ? "active" : "" ?>">
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