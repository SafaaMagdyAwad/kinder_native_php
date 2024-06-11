<?php
require_once "includes/conn.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(
    isset($_POST['fullName']) && !empty($_POST['fullName'])
    && isset($_POST['userName']) && !empty($_POST['userName'])
    && isset($_POST['email']) && !empty($_POST['email'])
  ){


    $fullName=$_POST['fullName'];
    $userName=$_POST['userName'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
    $phone=$_POST['phone'];//not required
    if(isset($_POST['active']) && !empty($_POST['active'])) {
      $active=$_POST['active']; //not required
     }else{
       $active=0; //not required
     }
     
     try{
      //  userName& email are unique
      $sql = "SELECT * FROM `users` WHERE `userName`=? or email=? ";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$userName,$email]);
      $existsUser= $stmt->fetch();
      if($existsUser){
          $error="you cant use this userName or email there is already account";
      }else{
        $sql = "INSERT INTO `users`(`fullName`, `userName`, `email`, `password`, `phone`, `active`) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$fullName,$userName,$email,$password,$phone,$active]);
        header("location:users.php");//if user was logedi(redirect to users)else redirect to ogin
        die();

      }
  
    }catch(PDOException $e){
      $error="error". $e->getMessage();
      
    }

  }else{
    $error=" full name, user name, email are required";
  }
  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Registeration</title>

  <link rel="stylesheet" href="css/main.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-dark">
  <div class="container" >
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 main position-relative mt-5 d-flex flex-column align-items-center">
        <h2 class="text-white mt-5 fw-bold">Registeration Form</h2>
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

        <form action="" method="post" class="mt-3 w-100 px-3">
          <input type="text"  name="active" value=0 hidden>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Fullname*</label>
            <input type="text" placeholder="e.g. John Doe" class="form-control form-control-input py-2" name="fullName" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Username*</label>
            <input type="text" placeholder="Username" class="form-control form-control-input py-2" name="userName"  required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Email*</label>
            <input type="email" placeholder="Email" class="form-control form-control-input py-2"  name="email"  required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Password*</label>
            <input type="password" placeholder="Password" class="form-control form-control-input py-2"  name="password"  required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Phone</label>
            <input type="text" placeholder="e.g. +2011423253" class="form-control form-control-input py-2"  name="phone" >
          </div>
          <button class="btn my-4 bg-light fs-5 fw-bold w-100 border-0 py-2">Register</button>
          <a href="login.php" class="text-center d-block fs-4 text-white mb-5">Already have account?</a>
        </form>
       
      </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
