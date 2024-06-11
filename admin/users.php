<?php
require_once "includes/conn.php";
require_once "includes/logged.php";


try{

  $sql = "SELECT * FROM `users`";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
  $users= $stmt->fetchAll();
}catch(PDOException $e){
    $error="error".$e->getMessage();
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

      <?php include_once "includes/navbar.php"; ?>

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Users</h2>
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
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Registration Date</th>
                <th scope="col">FullName</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Active</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach ($users as $user) {
              ?>
                <tr>
                  <th scope="row"><?php
                  $dateObject = new DateTime($user['regDate']); 
                  echo date_format($dateObject,"d M Y") ;
                  ?></th>
                  <td><?php echo $user['fullName'];?></td>
                  <td><?php echo $user['userName'];?></td>
                  <td><?php echo $user['email'];?></td>
                  <td><?php echo $user['phone'];?></td>
                  <td><?php echo ($user['active'])==1?"YES":"NO" ; ?></td>
                  <td><a href="edit_user.php?id=<?php echo $user['id'];?>"  onclick="return confirm('are you sure to edit this user ')" class="text-decoration-none"><i>✒️</i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
