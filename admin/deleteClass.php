<?php

require_once "includes/conn.php";
require_once "includes/logged.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
    $id=$_GET['id'];
    try{

     $sql = "DELETE FROM `classes` WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("location:classes.php");
        die();
      }catch(PDOException $e){
        $error="error". $e->getMessage();
      }
}

?>