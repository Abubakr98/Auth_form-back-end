<?php
require "db.php";
header ('Access-Control-Allow-Origin: *');
$data = $_POST['form'];
$data = json_decode($data, true);
 if (isset($data['do_signup'])) {
    $errors=array();
    if (R::count('users',"login = ?", array($data['email']))>0) {
     $errors[]='Пользователь с таким логином уже зарегистрирован!';
   }
    if (empty($errors)) {
      $login=$data['email'];
      $password=$data['password'];
      $name=$data['name'];
      $lastName=$data['lastName'];
      $phoneNumber=$data['phoneNumber'];
      $dateOfBirth=$data['dateOfBirth'];
      $city=$data['city'];
      $aboutSelf=$data['aboutSelf'];
      $gender=$data['gender'];

      $user=R::dispense('users');
      $user->login=$login;
      $user->password=password_hash($password,
      PASSWORD_DEFAULT);
      $user->name=$name;
      $user->last_name=$lastName;
      $user->phone_number=$phoneNumber;
      $user->date_of_birth=$dateOfBirth;
      $user->city=$city;
      $user->about_self=$aboutSelf;
      $user->gender=$gender;
      R::store($user);
      echo json_encode("OK", JSON_UNESCAPED_UNICODE);
    }else {
      echo json_encode(array_shift($errors), JSON_UNESCAPED_UNICODE);
    }
    }
    ?>
