<?php
require "db.php";
header ('Access-Control-Allow-Origin: *');
$responseJson = $_POST['form'];
$data = json_decode($responseJson, true);
if (isset($data['getData'])) {
    $errors=array();
    $user=R::findOne('users','login=?',array($data['email']));
    if($user){
        if($data['token']==$user->password){
          $arrForGet['status'] = "OK";
          $arrForGet['user'] = $user->login;
          $arrForGet['name'] = $user->name;
          $arrForGet['last_name'] = $user->last_name;
          $arrForGet['phone_number'] = $user->phone_number;
          $arrForGet['date_of_birth'] = $user->date_of_birth;
          $arrForGet['city'] = $user->city;
          $arrForGet['about_self'] = $user->about_self;
          $arrForGet['gender'] = $user->gender;
            echo json_encode( $arrForGet, JSON_UNESCAPED_UNICODE);
        }else{
                $errors[]='Ошыбка при подгрузке данних! Перезайдите в аккаунт';
        }
    }else {
    $errors[]='Ошыбка при подгрузке данних! Перезайдите в аккаунт';
    }
    if (!empty($errors)) {
    echo json_encode( array_shift($errors), JSON_UNESCAPED_UNICODE);
  }
}
 ?>
