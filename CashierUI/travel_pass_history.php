<!DOCTYPE html>
<html lang="en">

<?php

include "../Database/db_connect.php";
$title = 'View | Travel Pass History';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid vh-100">
      <div class="row pb-2">
         <div class="col col-4 d-flex gap-2 ms-2 mt-2">
            <a href="cashierUI.php" class="btn btn-c text-white">Back</a>
         </div>

         <div class="col d-flex gap-5 align-items-center justify-content-end me-5   ">
            <a class="btn btn-c text-white" href="travel_pass_history.php">Travel Pass History <i class="bi bi-clock-history"></i></a>
            <a class="btn btn-c text-white w-25" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right"></i></a>
         </div>
      </div>

      <div class="row pt-2 bg-white border border-dark border-2">
         <p class="text-center fs-2 ">Travel Pass History</p>
      </div>

      <div class="row">
         <div class="card  px-4 m-0" style="max-height: 450px; overflow-y: auto;">
            <?php
            try {
               $sql = "SELECT * FROM travel_pass_view ORDER BY travel_date DESC, departure_time DESC";

               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {

            ?>
                     <div class="card shadow border border-2 w-100 m-0 p-0 mb-2 px-2">
                        <div class="card-body mx-2">
                           <form method="POST" action="depart_operation.php">
                              <div class="row border border-top-0 border-start-0  border-end-0 border-2 mb-4">
                                 <div class="col">
                                    <p class="fw-semibold fs-5 mb-0">Caltransco</p>
                                    <p class="fw-semibold fs-5 ">Travel Pass(Davao)</p>
                                 </div>

                                 <div class="col col-3">
                                    <span><b>Date: </b><?php echo $row['travel_date'] ?></span><br>
                                    <span><b>Departure Time: </b><?php echo $row['departure_time'] ?></span><br>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col">
                                    <span><b>Driver: </b><?php echo $row['driver'] ?></span><br>
                                    <span><b>Plate Number: </b> <?php echo $row['vehicle'] ?></span><br>
                                    <span><b>Card Color: </b> <?php echo $row['card'] ?></span><br>
                                    <span><b>Cashier: </b> <?php echo $row['cashier'] ?></span>
                                 </div>
                                 <div class="col">
                                    <table class="table table-bordered text-center">
                                       <thead class="table-secondary ">
                                          <tr>
                                             <th>TOTAL PASSENGERS</th>
                                             <th>TOTAL FARE</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td><?php echo $row['total_passengers'] ?></td>
                                             <td><?php echo $row['total_fare'] ?></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>


            <?php
                  }
               } else {
                  echo '<div class="text-center mt-3"><p class="text-muted fs-5">No cashiers found.</p></div>';
               }

               $conn->close();
            } catch (\Exception $e) {
               die($e);
            }
            ?>
         </div>
      </div>
   </div>
</body>

</html>