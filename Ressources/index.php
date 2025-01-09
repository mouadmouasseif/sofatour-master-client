<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="">
<?php
include 'header.php';
?>
<body style=" margin-top: -23px; ">
<script src="toast.js"></script>
<?php
if (!isset($_SESSION['id_user'])) {
    include("../Front-end/se_connecter/se_connecter.php");
    exit();
}
else {
include '../Front-end/menu/menu.php';
include 'home.php';
}
include 'footer.php';
?>
</body>
</html>