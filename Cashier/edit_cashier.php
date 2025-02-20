<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM cashier WHERE id=" . $id;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$title = 'Cashier Lists | ' . $row['cashier_fname'] . ' ' . $row['cashier_lname'];
require "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid vh-100">
      <div class="row border border-start-0 border-end-0 border-top-0 border-2 border-dark pb-2">
         <div class="col d-flex gap-2 ms-2 mt-2">
            <a href="../AdminUI/adminDashboard.php" style="text-decoration: none;" class="d-flex gap-2">
               <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
               <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
            </a>
         </div>
      </div>

      <div class="row pt-3">
         <div class="col col-3">
            <div class="card shadow-lg">
               <div style="height: 500px;" class="card_css card-body">
                  <div class="mx-3 mb-3">
                     <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Cashier/view_cashier.php">Cashier</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-h w-100 fw-semibold mb-2 border border-1 border-dark" href="../Driver/add_driver.php">Driver</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Vehicle/view_vehicle.php">Vehicle</a>
                  </div>

                  <div class="mx-3">
                     <a href="../Login-Register/Login.php" class="btn btn-h w-100 border border-1 border-dark fw-semibold">Log Out</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="col col-9">
            <div class="card shadow-lg">
               <div class="card-body">

                  <div class="row mt-3 ms-3">
                     <div class="col col-3">
                        <img class="img-fluid border border-2 border-black rounded-pill" src="../images/cashier.png" alt="" width="150" height="150">
                     </div>

                     <div class="col">
                        <h1 class="mt-3">CASHIER</h1>
                     </div>
                  </div>

                  <div class="row d-flex justify-content-center align-items-center mt-4">
                     <div class="col col-10">

                        <div class="card shadow-lg bg-light ">
                           <div class="card-body">
                              <form action="../Operations//op_edit_cashier.php" method="POST">
                                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                                 <div class="row">
                                    <div class="col">
                                       <label for="cashier_fname" class="fw-semibold mb-3">First Name</label>
                                       <input type="text" id="cashier_fname" name="cashier_fname" value="<?php echo $row['cashier_fname'] ?>" class="form-control border-dark">
                                    </div>

                                    <div class="col">
                                       <label for="cashier_lname" class="fw-semibold mb-3">Last Name</label>
                                       <input type="text" id="cashier_lname" name="cashier_lname" value="<?php echo $row['cashier_lname'] ?>" class="form-control border-dark">
                                    </div>
                                 </div>

                                 <div class="row mt-2">
                                    <div class="col">
                                       <label for="cashier_address" class="fw-semibold mb-3">Address</label>
                                       <input type="text" id="cashier_address" name="cashier_address" value="<?php echo $row['cashier_address'] ?>" class="form-control border-dark">
                                    </div>

                                    <div class="col">
                                       <label for="cashier_contactNum" class="fw-semibold mb-3">Contact Number</label>
                                       <input type="text" id="cashier_contactNum" name="cashier_contactNum" value="<?php echo $row['cashier_contactNum'] ?>" class="form-control border-dark">
                                    </div>
                                 </div>

                                 <div class="row mt-4">
                                    <div class="col">
                                       <a href="../AdminUI/adminDashboard.php" class="btn btn-outline-info w-100 text-dark fw-semibold">CANCEL</a>
                                    </div>
                                    <div class="col">
                                       <button type="submit" class="btn btn-info w-100 border border-dark fw-semibold">UPDATE</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>