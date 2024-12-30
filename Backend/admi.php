<?php
require_once "class.php" ;
$file =dirname(__DIR__).DIRECTORY_SEPARATOR.'Frontend'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'acces.json';
$file_data =dirname(__DIR__).DIRECTORY_SEPARATOR.'Frontend'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'data.json';

if(!(form::is_not_empty(["name" , "password"] , "POST"))){
    header('location:http://localhost:3000');
    exit() ;
}
try{
    $db = new PDO ('mysql:host=localhost;dbname=upb;charset=utf8' ,'root' ,'');
}
catch (Exception $e){
    echo 'error of connexion of server ' ;
}

$info = db::get(' SELECT *FROM administrateur ' ,$db);

if($_POST["name"] == $info['name']  && $_POST["password"] == $info['password'] ){

    $b = $_POST["name"] == $info['name']  && $_POST["password"] == $info['password'] ?true:false;
    $access = ['ac' => $b];
    $students = db::get_All("SELECT id , nom ,prenoms , sexe ,email ,contact ,quartier ,date_ajout  FROM etudiants" ,$db);
    if(!file_exists($file_data)){
        file_put_contents($file_data ,json_encode($students ,JSON_PRETTY_PRINT));
    }
    if(!file_exists($file)){
        file_put_contents($file ,json_encode($access ,JSON_PRETTY_PRINT));
    }
    header('location:http://localhost:3000');
    exit();

}
    
$access = ['ac' => false];
$write = file_put_contents($file ,json_encode($access));
header('location:http://localhost:3000');
exit();
?>