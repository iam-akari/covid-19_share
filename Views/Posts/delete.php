<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
$post = new PostController();
$delete = $post->delete();
header("Location: ./index.php");
exit();
?>
