<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
$log_in = new PostController();
$log_in->login();
header("Location: ./index.php");
exit();
?>
