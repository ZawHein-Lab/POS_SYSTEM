<div class="sidebar extend">
    <div class="sidebar-header">
        <div class="sidebar-item">
            <i class="fa fa-smile mb-2 me-2 fs-1"></i>
            <h4>Jo Jo Hot Pot</h4>
        </div>
    </div>
    <div class="division"></div>
    <div class="sidebar-list justify-content-between toggle-sidebar" data-bs-toggle="collapse" data-bs-target="#user-menu">
        <div class="sidebar-list-item">
            <i class="fa fa-users mb-2 me-2 fs-3"></i>
            <h5>User</h5>
        </div>
        <div>
            <i class="fa fa-angle-down" id="down_arrow"></i>
        </div>
    </div>
    <!-- <div class="division"></div> -->
    <div class="sidebar-sub-menu collapse" id="user-menu">
        <div class="sidebar-submenu" onclick="location.replace('./add_user.php')">
            <i class="fa fa-user-plus mb-2 me-2 fs-5"></i>
            <a href="./add_user.php" class="fs-6 text-decoration-none text-white">Add User</a>
        </div>
        <!-- <div class="division"></div> -->
        <div class="sidebar-submenu" onclick="location.replace('./user_list.php')">
            <i class="fa fa-list mb-2 me-2 fs-5"></i>
            <!-- <h6>User List</h6> -->
            <a href="./user_list.php" class="fs-6 text-decoration-none text-white">User List</a>
        </div>
        <div class="division"></div>
    </div>
    <div class="division"></div>
    <div class="sidebar-list justify-content-between toggle-sidebar" data-bs-toggle="collapse" data-bs-target="#user-menu-category">
        <div class="sidebar-list-item">
            <i class="fa fa-users mb-2 me-2 fs-3"></i>
            <h5>Category</h5>
        </div>
        <div>
            <i class="fa fa-angle-down" id="down_arrow"></i>
        </div>
    </div>
    <div class="sidebar-sub-menu collapse" id="user-menu-category">
        <div class="sidebar-submenu">
            <i class="fa fa-user-plus mb-2 me-2 fs-5"></i>
            <a href="./add_category.php" class="fs-6 text-decoration-none text-white">Add Category</a>
        </div>
        <!-- <div class="division"></div> -->
        <div class="sidebar-submenu">
            <i class="fa fa-list mb-2 me-2 fs-5"></i>
            <!-- <h6>User List</h6> -->
            <a href="./category_list.php" class="fs-6 text-decoration-none text-white">Category List</a>
        </div>
        <div class="division"></div>
    </div>
    <div class="division"></div>
    <div class="toggle-button">
        <i id="toggle" class="fa fa-angle-left"></i>
    </div>
</div>