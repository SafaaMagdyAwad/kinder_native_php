<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == "GET") {
  try{
    $sql = "SELECT * FROM `teachers` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $id=$_GET['id'];
    $stmt->execute([$id]);
    $teacher= $stmt->fetch();
    if(! $teacher){
      echo "<h1>this teacher gosent exsist</h1>";
      die();
    }
  }catch(Exception $e){
    $error= $e->getMessage();
  }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
  try{
    $fullName=$_POST["fullName"];
    $jopTitle=$_POST["jopTitle"];
    $id=$_POST["id"];

    if(isset($_POST["published"]) && !empty($_POST["published"])){   
      $published=$_POST["published"];//if
    }else{
      $published= 0;
    }

    $oldImage=$_POST["image_name"];

    require_once "includes/updateImage.php";
      // var_dump("sa");
// die();
$sql = "SELECT * FROM `classes` WHERE teacher_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$id]);
      $classes= $stmt->fetchAll();
      if($classes){//
        $updatepublished="";
      }else{
           $sql = "UPDATE `teachers` SET `fullName`=?,`jopTitle`=?,`published`=?,`image`=? WHERE id=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$fullName,$jopTitle,$published,$image_name,$id]);
      
        header("location:teachers.php");
        die();
      } 
    

    
   
  }catch(Exception $e){
    $error= $e->getMessage();
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Teacher</h2>
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
          <h3>
              <?php
      if(isset($updatepublished)) {
      ?>
      <div style="color: #ee0002; padding: 5px;">
      you can't update published for this teacher ,becouse this teacher is working in courses delete courser first 
      <br>
      classes
      <?php foreach($classes as $class) { ?>
        <h1><a href="class_details.php?id=<?php echo $class['id'] ?>">
                <?php echo $class['className']; ?>
                </a></h1><br>
                <h1><a href="deleteClass.php?id=<?php echo $class['id'] ?>"> Or direct delete class 
                <?php echo $class['className']; ?> from here
                </a></h1><br>
      <?php } ?>

      </div>
      <?php
      die();
      }
      ?>
      </h3>
          <form action="" method="post" class="px-md-5" enctype="multipart/form-data">
            <input name="id" value="<?php echo $teacher['id'] ?>" hidden/>
            <input name="image_name" value="<?php echo $teacher['image'] ?>" hidden/>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="<?php echo $teacher['fullName'] ?>"
                  class="form-control py-2"
                  name="fullName"
                  value="<?php echo $teacher['fullName'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Job Title:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="<?php echo $teacher['jopTitle'] ?>"
                  class="form-control py-2"
                  name="jopTitle"
                  value="<?php echo $teacher['jopTitle'] ?>"
                />
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
                  style="padding: 0.7rem"
                  name="published"
                  value=1
                  <?php echo ($teacher['published']==1)?"checked":"" ?>
                />
              </div>
            </div>
            <hr />
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem"
                  name="image"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <img
                  src="../images/<?php echo $teacher['image'] ?>"
                  alt="teacher-image"
                  style="max-width: 150px"
                />
              </div>
            </div>
            <div class="text-md-end">
              <button
                class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
              >
                Edit Teacher
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
