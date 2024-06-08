
<?php
require_once "admin/includes/conn.php";



try{

  $sql = "SELECT * FROM `facilities`";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
  $facilities= $stmt->fetchAll();
  // var_dump($classes);
  // die();
}catch(PDOException $e){
    $error="error".$e->getMessage();
}

?>

<!-- Facilities Start -->
<div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Facilities</h1>
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
                <?php foreach($facilities as $faciliti) { ?>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo $faciliti['delay'] ?>s">
                        <div class="facility-item">
                            <div class="facility-icon bg-<?php echo $faciliti['color'] ?>">
                                <span class="bg-<?php echo $faciliti['color'] ?>"></span>
                                <i class="<?php echo $faciliti['icon'] ?>"></i>
                                <span class="bg-<?php echo $faciliti['color'] ?>"></span>
                            </div>
                            <div class="facility-text bg-<?php echo $faciliti['color'] ?>">
                                <h3 class="text-primary mb-3"><?php echo $faciliti['title'] ?></h3>
                                <p class="mb-0"><?php echo $faciliti['discrption'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                   
                </div>
            </div>
        </div>
        <!-- Facilities End -->
