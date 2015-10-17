<?php

include('Base.php');

$regno = $_POST['regno'];
$pass = $_POST['pass'];
$name = $_POST['name'];

$response = array('code' => 0, 'msg' => 'ok');

if (strlen($regno) != 10) {
  $response['code'] = 1;
  $response['msg']  = 'malformed request';
  goto _exit;
}

if (strlen($pass) < 6) {
  $response['code'] = 1;
  $response['msg']  = 'password too short!';
  goto _exit;
}

if (strlen($name) > 30) {
  $response['code'] = 1;
  $response['msg']  = 'user name too long';
  goto _exit;
}

$login = new Base;
$login->Init($regno);

$ret = $login->AddUser($regno, $pass, $name);

if ($ret != 0) {
  if ($ret == -1) {
    $response['code'] = $ret;
    $response['msg']  = 'user already exists!';
  } else if ($ret == -2) {
    $response['code'] = $ret;
    $response['msg']  = 'unknown error';
  }
} // if ret != 0

_exit:
  echo json_encode($response);
?>
