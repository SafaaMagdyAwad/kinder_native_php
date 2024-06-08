<?php

require_once "includes/conn.php";
require_once "includes/logged.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
    $id=$_GET['id'];

    try{

     $sql = "SELECT * FROM `classes` WHERE teacher_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $classes= $stmt->fetchAll();
        if($classes){
           //if there any classes will open html & not delete

        }else{
            $sql = "DELETE FROM `teachers` WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            header("location:teachers.php");
            die();
        }
     
      }catch(PDOException $e){
        $error="error". $e->getMessage();
      }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/main.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <main>
      <?php require_once "includes/navbar.php"; ?>
<h3>
              <?php
      if(isset($error)) {
      ?>
      <div style="color: #ee0002; padding: 5px;">
        <?php echo $error ?>
      </div>
      <?php
      }
      ?>
      </h3>
<h4>You cant delete this teacher , related to classes . if you are sure to delete ,firstly delete classes related to this teacher</h4><br>
<h5>teacher's classes</h5>
           <?php foreach($classes as $class){ ?>
                <h6><a href="class_details.php?id=<?php echo $class['id'] ?>">
                <?php echo $class['className']; ?>
                </a></h6><br>
                <h6><a href="deleteClass.php?id=<?php echo $class['id'] ?>"> Or direct delete class 
                <?php echo $class['className']; ?> from here
                </a></h6><br>
            <?php } ?>
            </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
