<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
$regi = new PostController();
$regi->register();
header("Location: ./login_form.php");
exit();
?>
