
<?php
require_once "admin/includes/conn.php";



try{

  $sql = "SELECT classes.*,teachers.fullName,teachers.image as tImage  FROM `classes`    INNER JOIN `teachers`ON teachers.id=classes.teacher_id where classes.published=1";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
  $classes= $stmt->fetchAll();
  // var_dump($classes);
  // die();
}catch(PDOException $e){
    $error="error".$e->getMessage();
}

?>
   <!-- Classes Start -->
   <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Classes</h1>
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
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="row g-4">
                    <?php foreach($classes as $class){ ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="images/<?php echo $class['image'];  ?>" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="classDetails.php?id=<?php echo $class['id'];  ?>"><?php echo $class['className'];  ?></a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="images/<?php echo $class['tImage'];  ?>" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1"><?php echo $class['fullName'];  ?></h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$<?php echo $class['price'];  ?></span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small><?php echo $class['ageFrom'];  ?>- <?php echo $class['ageTo'];  ?> Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small><?php echo $class['timeFrom'];  ?>- <?php echo $class['timeTo'];  ?> AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small><?php echo $class['capacity'];  ?> Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>
        </div>
        <!-- Classes End -->
