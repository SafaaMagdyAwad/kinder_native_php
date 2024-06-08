<?php
require_once "admin/includes/conn.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id=$_GET['id'];
  try{
    //get the class
    $sql = "SELECT classes.* ,teachers.fullName FROM `classes` INNER JOIN `teachers`ON teachers.id=classes.teacher_id WHERE  classes.id=? and classes.published=1";
    // var_dump($sql);
    // die();
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $class= $stmt->fetch();
    $teacher_id=$class['teacher_id'];
    $id=$class['id'];
    if(! $class){
        echo "<h1>this class cant be viewed<a href='classes.php'>All Classes</a></h1>";
    }
    // var_dump($class);die();
    
    $sql = "SELECT classes.* ,teachers.fullName FROM `classes` INNER JOIN `teachers`ON teachers.id=classes.teacher_id WHERE classes.teacher_id=? and classes.id !=? and classes.published=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id,$id]);
    $classes= $stmt->fetchAll();
    if(! $classes){

    }
  }catch(PDOException $e){
      $error="error".$e->getMessage();
  }
}
else{
    header("location:404.php");
}


?>
<div class="container my-5">
        <div class="bg-light p-5 rounded">
          <div class="card bg-light border-0">
            <div class="row justify-content-center">
                <h4>Rleated Classes</h4>
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
      <?php foreach($classes as $classe){ ?>
      <div class="col-md-4">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-10">
                <img src="images/<?php echo $classe['image'] ?>" alt="" class="card-img" />
              </div>
              <div class="col-lg-8 col-md-6 col-12 card-body">
                <div class="mb-4 text-center py-2">
                  <h2 class="fw-semibold bg-light card-header"><a href="classDetails.php?id=<?php echo $classe['id'] ?>"><?php echo $classe['className'] ?></a></h2>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Teacher:</span> <?php echo $classe['fullName'] ?>
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Price:</span> <?php echo $classe['price'] ?>$
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Published:</span> <?php echo ($classe['published']==1)?"YES":"NO" ?>
                  </p>
                </div>
                <div class="row">
                  <div class="col-md-4" style="border-top: 3px solid #198754">
                    <p class="text-success fs-5 fw-bold lh-1 pt-2">Age:</p>
                    <p class="lh-1 fw-bold"><?php echo $classe['ageFrom'] ?> - <?php echo $classe['ageTo'] ?> Years</p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #fe5d37">
                    <p class="text-primary fs-5 fw-bold lh-1 pt-2">Time:</p>
                    <p class="lh-1 fw-bold"><?php echo $classe['timeFrom'] ?> - <?php echo $classe['timeTo'] ?> AM</p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #ffc107">
                    <p class="text-warning fs-5 fw-bold lh-1 pt-2">Capacity:</p>
                    <p class="lh-1 fw-bold"><?php echo $classe['capacity'] ?> kids</p>
                  </div>
                </div>
                
              </div>
              </div>
              </div>
            <?php } ?>
              
            </div>
          </div>
        </div>
      </div>