  
  <?php
require_once "admin/includes/conn.php";
try{

  $sql = "SELECT * FROM `testimonials` WHERE `published`=1";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
  $testimonials= $stmt->fetchAll();
 
}catch(PDOException $e){
    $error="error".$e->getMessage();
}

?>
  <!-- Testimonial Start -->
  <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <?php foreach($testimonials as $testimonial) { ?>
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5"><?php echo $testimonial['comment']; ?></p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="images/<?php echo $testimonial['image']; ?>" style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1"><?php echo $testimonial['fullName']; ?></h3>
                                <span><?php echo $testimonial['jopTitle']; ?></span>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->