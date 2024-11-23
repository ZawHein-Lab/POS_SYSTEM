<?php
require_once("../layout/header.php");
require_once("../auth/isLogin.php");
?>
<div class="main">
    <?php require_once("../layout/sidebar.php") ?>
    <div class="content w-100">
        <?php require_once("../layout/navbar.php") ?>
    </div>
</div>
<?php
require_once("../layout/footer.php")
?>