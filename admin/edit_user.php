<?php
require_once "includes/conn.php";
require_once "includes/logged.php";

if($_SERVER['REQUEST_METHOD'] == "GET") {
  try{
    $sql = "SELECT * FROM `users` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $id=$_GET['id'];
    $stmt->execute([$id]);
    $user= $stmt->fetch();
    if(!$user){
      echo "<h1>user dosen't exist!!<a href='users.php' >Go To all users</a></h1>";
      die();
    }
  }catch(Exception $e){
    $error= $e->getMessage();
  }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $id=$_POST["id"];
  if(
    !empty($_POST["fullName"])
    && !empty($_POST["userName"])
    && !empty($_POST["email"])
  ) {
    try{
      $fullName=$_POST["fullName"];
      $userName=$_POST["userName"];
      $email=$_POST["email"];
      $phone=$_POST["phone"];
      if(isset($_POST['active']) && !empty($_POST['active'])) {
        $active=$_POST['active']; //not required
       }else{
         $active=0; //not required
       }  
       
  
  //userName &email are unique
      $sql1 = "SELECT * FROM `users` WHERE (`userName`=? OR `email`=?) AND `id`!=?; ";
      $stmt1 = $conn->prepare($sql1);
      $stmt1->execute([$userName,$email,$id]);
      $existsUser= $stmt1->fetch();//boolean value
      
      // var_dump($existsUser);die();
      if($existsUser){
        echo "<h1>you cant use this userName or email there is already account,  <a href='edit_user.php?id=".$id ."' >back to edit user</a></h1>";
        die();
      }else{
        if(isset($_POST['password']) && !empty($_POST['password'])) {
          $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
          $sql = "UPDATE `users` SET `fullName`=?,`userName`=?,`email`=?,`password`=?,`phone`=?,`active`=? WHERE id=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$fullName,$userName,$email,$password,$phone,$active,$id]);
        }else{
          $sql = "UPDATE `users` SET `fullName`=?,`userName`=?,`email`=?,`phone`=?,`active`=? WHERE id=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$fullName,$userName,$email,$phone,$active,$id]);
        }
        header("location:users.php");
        die();
              // var_dump($user);
              // die();
      }
  
      
    }catch(Exception $e){
      $error= $e->getMessage();
    }
  }else{
    echo "<h1>full name , user name , email are required,  <a href='edit_user.php?id=".$id ."' >back to edit user</a></h1>";
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit User</h2>
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
          <form action="" method="post" class="px-5">
            <input type="text"  class="form-control py-2" name="id" value="<?php echo $user['id'] ?>" hidden/>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input type="text" placeholder="<?php echo $user['fullName'] ?>" class="form-control py-2" name="fullName" value="<?php echo $user['fullName'] ?>"/>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Username:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="<?php echo $user['userName'] ?>"
                  class="form-control py-2"
                  name="userName" value="<?php echo $user['userName'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Email:</label
              >
              <div class="col-md-10">
                <input
                  type="email"
                  placeholder="<?php echo $user['email'] ?>" name="email"  value="<?php echo $user['email'] ?>"
                  class="form-control py-2"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Password:</label
              >
              <div class="col-md-10">
                <input
                  type="password"
                  placeholder="*********"   name="password"  
                  class="form-control py-2"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Phone:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="<?php echo $user['phone'] ?>" name="phone"   value="<?php echo $user['phone'] ?>"
                  class="form-control py-2"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Active:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"   name="active"     value=1      <?php echo ($user['active']==1)?"checked":""; ?>         />
              </div>
            </div>
            <div class="text-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Update User
            </button>
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
