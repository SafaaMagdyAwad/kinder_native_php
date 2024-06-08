
<?php
require_once "admin/includes/conn.php";



if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(
    isset($_POST['gName']) && !empty($_POST['gName'])
    && isset($_POST['gEmail']) && !empty($_POST['gEmail'])
    && isset($_POST['cName']) && !empty($_POST['cName'])
    && isset($_POST['cAge']) && !empty($_POST['cAge'])
    && isset($_POST['message']) && !empty($_POST['message'])
    ){
      $gName=$_POST['gName'];
      $gEmail=$_POST['gEmail'];
      $cName=$_POST['cName'];
      $cAge=$_POST['cAge'];
      $message=$_POST['message'];
    
      
      try{
        $sql = "INSERT INTO `appointments`( `gName`, `gEmail`, `cName`, `cAge`, `message`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$gName,$gEmail,$cName,$cAge,$message]);

        // header("location:index.php");
        // die();
      }catch(PDOException $e){
        $error="error". $e->getMessage();
      }
    }else{
        $error= "error!! data are required";
    }
    

}

?>
 <!-- Appointment Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Make Appointment</h1>
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
                                <form action="" method="post">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="gname" name="gName" placeholder="Gurdian Name">
                                                <label for="gname" >Gurdian Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0" name="gEmail" id="gmail" placeholder="Gurdian Email">
                                                <label for="gmail" >Gurdian Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" name="cName" id="cname" placeholder="Child Name">
                                                <label for="cname" >Child Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="cage" name="cAge" placeholder="Child Age">
                                                <label for="cage" >Child Age</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" name="message" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                                <label for="message" >Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="img/appointment.jpg" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->