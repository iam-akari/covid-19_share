<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
$newPass = new PostController();
$newPass->new_pass();
header("Location: ./login_form.php");
exit();
?>
