
<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == "GET") {
  try{
    $sql = "SELECT * FROM `testimonials` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $id=$_GET['id'];
    $stmt->execute([$id]);
    $testimonial= $stmt->fetch();
    }catch(Exception $e){
      $error= $e->getMessage();
      }
      }
      if($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
          $fullName=$_POST["fullName"];
          $jopTitle=$_POST["jopTitle"];
          $comment=$_POST["comment"];
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
   

$sql = "UPDATE `testimonials` SET `fullName`=?,`jopTitle`=?,`comment`=?,`published`=?,`image`=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$fullName,$jopTitle,$comment,$published,$image_name,$id]);
// var_dump($stmt->fetch());die();
   
    header("location:testimonials.php");
    die();
   
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
    <?php   require_once "includes/navbar.php"; ?>

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Testimonial</h2>
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
            <input name="id" value="<?php echo $testimonial['id'] ?>" hidden/>
            <input name="image_name" value="<?php echo $testimonial['image'] ?>" hidden/>
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
                  value="<?php echo $testimonial['fullName'] ?>"
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
                  value="<?php echo $testimonial['jopTitle'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Comment:</label
              >
              <div class="col-md-10">
                <textarea
                  id=""
                  cols="30"
                  rows="5"
                  class="form-control py-2"
                  name="comment"
                  value="<?php echo $testimonial['comment'] ?>"
                ><?php echo $testimonial['comment'] ?></textarea>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  name="published"
                  value=1
                  <?php echo ($testimonial['published']==1)?"checked":" " ?>
                  class="form-check-input"
                  style="padding: 0.7rem"
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
                  src="../images/<?php echo $testimonial['image'] ?>"
                  alt="testimonial-image"
                  style="max-width: 150px"
                />
              </div>
            </div>
            <div class="text-md-end">
              <button
                class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
              >
                Update Testimonial
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
