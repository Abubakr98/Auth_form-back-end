<?php
require "db.php";
header ('Access-Control-Allow-Origin: *');
$responseJson = $_POST['form'];
$data = json_decode($responseJson, true);
$login=$data['email'];
$password=$data['password'];
if (isset($data['do_login'])) {
    $errors=array();
    $user=R::findOne('users','login=?',array($data['email']));
    if($user){
        if(password_verify($data['password'], $user->password)){
          $arrForGet['status'] = "OK";
          $arrForGet['user'] = $user->login;
          $arrForGet['token'] = $user->password;
            echo json_encode( $arrForGet, JSON_UNESCAPED_UNICODE);
        }else{
                $errors[]='Неверный пароль!';
        }
    }else {
    $errors[]='Пользователя не сушествует!';
    }
    if (!empty($errors)) {
    echo json_encode( array_shift($errors), JSON_UNESCAPED_UNICODE);


  }
}
 ?>
