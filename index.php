<?php

session_start();


$rolePages = [
  1 => 'sinhvien/index.php',
  2 => 'giangvien/index.php'
];


if (!isset($_SESSION['ma_nguoidung'])) {
  header('Location: login.php');
  exit;
}

if (isset($_SESSION['vaitro']) && array_key_exists($_SESSION['vaitro'], $rolePages)) {
  header('Location: ' . $rolePages[$_SESSION['vaitro']]);
  exit;
}
