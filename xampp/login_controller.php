<?php
	include "basedatos.php";
	$usuario = $_POST['userId'];
    $contra = $_POST['userPass'];
    $consult = DataBase::query("SELECT UserId, Pass, Levels FROM Users WHERE UserId = '".$usuario."';")->fetch_array();
    if($consult[1] == $contra){
        //echo "Contraseña correcta";
        header('Location: dashboard.php?userId='.$usuario.'&level='.$consult[2]);
    }
    else{
        //echo "Contraseña incorrecta";
        header('Location: login.php');
    }
?>