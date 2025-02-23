<!DOCTYPE html>
<html lang="en">

<?php

include "../Database/db_connect.php";
$title = 'View | Travel Pass History';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid vh-100">
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2">
         <div class="col col-4 d-flex gap-2 ms-2 mt-2">
            <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
            <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
         </div>

         <div class="col d-flex gap-5 align-items-center justify-content-end me-5   ">
            <a class="btn btn-nav" href="">New <i class="bi bi-plus"></i></a>
            <div class="dropdown">
               <a class="btn btn-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  View <i class="bi bi-eye"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../TravelPass/onHold.php">On Hold</a></li>
                  <li><a class="dropdown-item" href="travel_pass_history.php">Travel Pass History</a></li>
               </ul>
            </div>

            <a class="btn btn-nav" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right"></i></a>
         </div>
      </div>

      <div class="row">
         <p class="text-center fs-2 text-white">Travel Pass History</p>
      </div>

      <div class="row">
         <div class="border p-0 m-0" style="max-height: 450px; overflow-y: auto;">
            <?php
            try {
               $sql = "SELECT * FROM travel_pass_view";

               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {

            ?>
                     <ul class="list-group mb-1">
                        <li class="list-group-item d-flex align-items-center justify-content-center border border-2">
                           <div class="card shadow-lg border w-100 m-0 p-0">
                              <div class="card-body">
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

                                    <div class="row mt-2">
                                       <div class="col">

                                       </div>
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col d-flex gap-3 align-items-center">

                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>

                        </li>
                     </ul>
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