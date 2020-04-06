<?php
require_once 'pdo-connect.php';
require_once 'functions.php';
$id = $_GET['id'];
deleteArticle($pdo, $id);
header('Location: articles-list.php?delete='.$id);
?>