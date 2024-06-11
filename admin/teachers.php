<?php
require_once "includes/conn.php";
require_once "includes/logged.php";


try{

  $sql = "SELECT * FROM `teachers`";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
  $teachers= $stmt->fetchAll();
  // var_dump($classes);
  // die();
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
      <?php  require_once "includes/navbar.php"; ?>

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Teachers</h2>
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
                <th scope="col">Job Title</th>
                <th scope="col">Published</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($teachers as $teacher) { ?>
              <tr>
                <th scope="row"><?php echo $teacher['regDate'] ?></th>
                <td><?php echo $teacher['fullName'] ?></td>
                <td><?php echo $teacher['jopTitle'] ?></td>
                <td><?php echo ($teacher['published']==1)?"YES":"NO"; ?></td>
              <td><a href="edit_teacher.php?id=<?php echo $teacher['id'] ?>" class="text-decoration-none" onclick="return confirm('are you sure to edit this teacher ')"><i>✒️</i></a></td>
                <td><a href="deleteTeacher.php?id=<?php echo $teacher['id'] ?>" class="text-decoration-none" onclick="return confirm('are you sure to delete this teacher ')"><img src="../img/trash-bin.png" alt="" style="max-width: 35px"></a></td>
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
