<?php
require_once 'pdo-connect.php';
require_once 'functions.php';
$id = $_GET['id'];
deleteUser($pdo, $id);
header('Location: user-list.php?delete='.$id);
?>