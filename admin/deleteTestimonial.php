<?php

require_once "includes/conn.php";
require_once "includes/logged.php";
if($_SERVER['REQUEST_METHOD']=="GET"){
    $id=$_GET['id'];
    try{

     $sql = "DELETE FROM `testimonials` WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("location:testimonials.php");
        die();
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
      </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
