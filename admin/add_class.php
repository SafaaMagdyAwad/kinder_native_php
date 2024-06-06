<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {

  try{
    $sql = "SELECT * FROM `teachers` WHERE `published`=1";//he is avilable to work
      $stmt = $conn->prepare($sql);
      $stmt->execute([]);
      $teachers= $stmt->fetchAll();

  }catch(PDOException $e){
    $error="error". $e->getMessage();
  }

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(
    isset($_POST['className']) &&!empty($_POST['className'])
    && isset($_POST['teacher_id']) &&!empty($_POST['teacher_id'])
    && isset($_POST['price']) &&!empty($_POST['price'])
    && isset($_POST['capacity']) &&!empty($_POST['capacity'])
    && isset($_POST['ageFrom']) &&!empty($_POST['ageFrom'])
    && isset($_POST['ageTo']) &&!empty($_POST['ageTo'])
    && isset($_POST['timeFrom']) &&!empty($_POST['timeFrom'])
    && isset($_POST['timeTo']) &&!empty($_POST['timeTo'])
    && isset($_FILES['image']) &&!empty($_FILES['image'])
    )// all feilds are required 
    {
    $className=$_POST['className'];
    $teacher_id=$_POST['teacher_id'];
    $price=$_POST['price']; 
    $capacity=$_POST['capacity'];
    $ageFrom=$_POST['ageFrom'];
    $ageTo=$_POST['ageTo'];
    $timeFrom=$_POST['timeFrom'];
    $timeTo=$_POST['timeTo'];
    if(isset($_POST['published']) && !empty($_POST['published'])) {
      $published=$_POST['published']; //not required
     }else{
       $published=0; //not required

     }
    require_once "includes/addimage.php";
    try{
      $sql = "INSERT INTO `classes`( `className`, `teacher_id`, `price`, `capacity`, `ageFrom`, `ageTo`, `timeFrom`, `timeTo`, `published`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$className,$teacher_id,$price,$capacity,$ageFrom,$ageTo,$timeFrom,$timeTo,$published,$image_name]);
      header("location:classes.php");
      die();
    }catch(PDOException $e){
      $error="error". $e->getMessage();
    }
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Class</h2>
          <form action="" method="post" class="px-md-5"  enctype="multipart/form-data">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Class Name:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Art & Design"
                  class="form-control py-2"
                  name="className"
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
                  <?php foreach($teachers as$teacher){ ?>
                  <option value="<?php echo $teacher['id'] ?>"><?php echo $teacher['fullName'] ?></option>
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
                  placeholder="Enter price"
                  class="form-control py-2"
                  name="price"
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
                  placeholder="Enter catpacity"
                  class="form-control py-2"
                  name="capacity"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="number" name="ageFrom" class="form-control"></label>
                <label for="" class="form-label">To <input type="number" name="ageTo" class="form-control"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="time" name="timeFrom" class="form-control"></label>
                <label for="" class="form-label">To <input type="time" name="timeTo" class="form-control"></label>
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
              Add Class
            </button>
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
