<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      $sql = "INSERT INTO `users`(`fullName`, `userName`, `email`, `password`, `phone`, `active`) VALUES (?,?,?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$fullName,$userName,$email,$password,$phone,$active]);
      header("location:users.php");
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
      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add User</h2>
          <form action="" method="post" class="px-md-5">
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
                >Username:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="Username"
                  class="form-control py-2"
                  name="userName"

                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Email:</label
              >
              <div class="col-md-10">
                <input
                  type="email"
                  placeholder="email@example.com"
                  class="form-control py-2"
                  name="email"

                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Password:</label
              >
              <div class="col-md-10">
                <input
                  type="password"
                  placeholder="Password"
                  class="form-control py-2"
                  name="password"

                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Phone:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="+20133332323"
                  class="form-control py-2"
                  name="phone"

                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Active:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"
                  name="active"
                  value=1

                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Add User
            </button>
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
