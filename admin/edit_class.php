<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == "GET") {
  try{
    $sql = "SELECT * FROM `classes` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $id=$_GET['id'];
    $stmt->execute([$id]);
    $classe= $stmt->fetch();
    if(! $classe){
      echo "<h1> error!! this class dosen't exist </h1>";
      die();
    }
    $sqlt = "SELECT * FROM `teachers` WHERE `published`=1";
    $stmtt = $conn->prepare($sqlt);
    $stmtt->execute([]);
    $teachers= $stmtt->fetchAll();
    if(! $teachers){
      $error= "<h1>There is no any teachers , you must <a href='add_teacher.php'>add teachers</a>  to be able to add course </h1>";
    }
    // var_dump($user);
    // die();
  }catch(Exception $e){
    $error= $e->getMessage();
  }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $id=$_POST["id"];
  if(isset($_POST["teacher_id"]) 
  && !empty($_POST["className"])
  && !empty($_POST["price"])
  && !empty($_POST["capacity"])
  && !empty($_POST["ageFrom"])
  && !empty($_POST["ageTo"])
  && !empty($_POST["timeFrom"])
  && !empty($_POST["timeTo"])
  ) {
    try{
        $className=$_POST["className"];
        $teacher_id=$_POST["teacher_id"];
        $price=$_POST["price"];
        $capacity=$_POST["capacity"];
        $ageFrom=$_POST["ageFrom"];
        $ageTo=$_POST["ageTo"];
        $timeFrom=$_POST["timeFrom"];
        $timeTo=$_POST["timeTo"];
        if(isset($_POST["published"]) && !empty($_POST["published"])){

          $published=$_POST["published"];
        }else{

          $published=0;
        }
        
        $oldImage=$_POST["image_name"];

        require_once "includes/updateImage.php";
      


      
          $sql = "UPDATE `classes` SET `className`=?,`teacher_id`=?,`price`=?,`capacity`=?,`ageFrom`=?,`ageTo`=?,`timeFrom`=?,`timeTo`=?,`published`=?,`image`=? WHERE id=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$className,$teacher_id,$price,$capacity,$ageFrom,$ageTo,$timeFrom,$timeTo,$published,$image_name,$id]); 
          header("location:classes.php");
          die();
        // var_dump($user);
        // die();
      }catch(Exception $e){
        $error= $e->getMessage();
      }
  }else{
    echo "<h1>you must fill filds with data <a href='edit_class.php?id=".$id."'>Return To Update Class</a></h1>";
    die();
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

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Class</h2>
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
          <form action="" method="post" class="px-md-5" enctype="multipart/form-data">
            <input name="image_name"   value="<?php  echo $classe['image'] ?>" hidden> 
            <input name="id"   value="<?php  echo $classe['id'] ?>" hidden> 
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Class Name:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="<?php  echo $classe['className'] ?>"
                  class="form-control py-2"
                  name="className"
                  value="<?php  echo $classe['className'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Teacher:</label
              >
              <div class="col-md-10">
                <select name="teacher_id" id="" class="form-control py-1">
                  <option value="">Select teacher</option>
                  <?php foreach($teachers as $teacher){ ?>
                  <option value="<?php echo $teacher['id'] ?>" <?php  echo ($classe['teacher_id']==$teacher['id'])?"selected":""  ?> ><?php echo $teacher['fullName'] ?></option>
                 <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Price:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="0.1"
                  placeholder="<?php  echo $classe['price'] ?>"
                  class="form-control py-2"
                  name="price"
                  value="<?php  echo $classe['price'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Capacity:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="1"
                  placeholder="<?php  echo $classe['capacity'] ?>"
                  class="form-control py-2"
                  name="capacity"
                  value="<?php  echo $classe['capacity'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="number" name="ageFrom" placeholder="<?php  echo $classe['ageFrom'] ?>" value="<?php  echo $classe['ageFrom'] ?>" class="form-control"></label>
                <label for="" class="form-label">To <input type="number"  name="ageTo" placeholder="<?php  echo $classe['ageTo'] ?>" value="<?php  echo $classe['ageTo'] ?>"  class="form-control"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="time" name="timeFrom" placeholder="<?php  echo $classe['timeFrom'] ?>" value="<?php  echo $classe['timeFrom'] ?>"  class="form-control"></label>
                <label for="" class="form-label">To <input type="time" name="timeTo" placeholder="<?php  echo $classe['timeTo'] ?>" value="<?php  echo $classe['timeTo'] ?>"  class="form-control"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"
                  name="published"
                  value=1
                  <?php  echo ($classe['published']==1)?"checked":"" ?>
                />
              </div>
            </div>
            <hr>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem;"
                  name="image"
                
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <img
                  src="../images/<?php  echo $classe['image'] ?>"
                  alt="class-image"
                  style="max-width: 150px"
                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Edit Class
            </button>
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
