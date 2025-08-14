<?php
include_once "db.php";

$acc = $_POST['acc'] ?? '';
$pw = $_POST['pw'] ?? '';

$user = $Users->find(['acc' => $acc, 'pw' => $pw]);

if ($user) {
    $_SESSION['user'] = $user['id'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'msg' => '帳號或密碼錯誤']);
}
