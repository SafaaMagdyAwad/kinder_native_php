<?php
require_once "includes/conn.php";
require_once "includes/logged.php";



if($_SERVER['REQUEST_METHOD'] == 'POST') {
 
  if(
    isset($_POST['fullName']) && !empty($_POST['fullName'])
    &&isset($_POST['jopTitle']) && !empty($_POST['jopTitle'])
    &&isset($_FILES['image']) && !empty($_FILES['image'])
    ){
      $fullName=$_POST['fullName'];
      $jopTitle=$_POST['jopTitle'];
      
      if(isset($_POST['published']) && !empty($_POST['published'])) {
        $published=$_POST['published']; //not required
        }else{
          $published=0; //not required
          
          }
          require_once "includes/addimage.php";
          
          try{
            $sql = "INSERT INTO `teachers`( `fullName`, `jopTitle`, `published`, `image`) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
          $stmt->execute([$fullName,$jopTitle,$published,$image_name]);
          header("location:teachers.php");
          die();
        }catch(PDOException $e){
          $error="error". $e->getMessage();
        }
    }else{
      $error="all feilds are required";
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Teacher</h2>
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
          <form action="" method="post" class="px-md-5"  enctype="multipart/form-data">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  name="fullName"
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
                  placeholder="e.g. Content Creator"
                  class="form-control py-2"
                  name="jopTitle"
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
                  style="padding: 0.7rem;"
                  name="published"
                  value=1
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
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Add Teacher
            </button>
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
