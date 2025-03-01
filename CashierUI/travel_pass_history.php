<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";
$title = 'View | Travel Pass History';
require "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid vh-100">

      <!-- Modal for create travel pass-->
      <div class="modal fade" id="travelPassModal" tabindex="-1" aria-labelledby="travelPassModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="travelPassModalLabel">Create Travel Pass</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form method="POST" action="./op_create_travel_pass.php">
                     <!-- Card Color -->
                     <div class="mb-3">
                        <label class="fw-semibold">Card Color:</label>
                        <select class="form-select" name="card_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT card_id, card_color FROM card";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['card_id'] . '">' . $row['card_color'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>

                     <!-- Route -->
                     <div class="mb-3">
                        <label class="fw-semibold">Route:</label>
                        <select class="form-select" name="route_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT route_id, route_name FROM routes";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['route_id'] . '">' . $row['route_name'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>

                     <!-- Driver -->
                     <div class="mb-3">
                        <label class="fw-semibold">Driver:</label>
                        <select class="form-select" name="driver_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT driver_id, driver_name FROM driver";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['driver_id'] . '">' . $row['driver_name'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>

                     <!-- Plate Number -->
                     <div class="mb-3">
                        <label class="fw-semibold">Plate Number:</label>
                        <select class="form-select" name="vehicle_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT vehicle_id, platenumber FROM vehicle";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['vehicle_id'] . '">' . $row['platenumber'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>

                     <!-- Cashier -->
                     <div class="mb-3">
                        <label class="fw-semibold">Cashier:</label>
                        <select class="form-select" name="cashier_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT cashier_id, cashier_name FROM cashier";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['cashier_id'] . '">' . $row['cashier_name'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Create</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal for create travel pass-->

      <!-- Success Modal -->
      <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="successModalLabel">Success</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  The travel pass has been saved successfully!
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>

      <!-- Check for success parameter and trigger modal -->
      <script>
         document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
               const successModal = new bootstrap.Modal(document.getElementById('successModal'));
               successModal.show();
            }
         });
      </script>
      <!-- Success Modal -->


      <!-- Row for logo and buttons -->
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2 mb-3">
         <div class="col col-4 d-flex gap-2 ms-2 mt-2">
            <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
            <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
         </div>

         <div class="col d-flex gap-5 align-items-center justify-content-end me-5">
            <button class="btn btn-c text-white" data-bs-toggle="modal" data-bs-target="#travelPassModal">New Travel Pass</button>
            <a class="btn btn-c text-white" href="travel_pass_history.php">Travel Pass History <i class="bi bi-clock-history"></i></a>
            <a class="btn btn-c text-white w-25" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right"></i></a>
         </div>
      </div>
      <!-- Row for logo and buttons -->
      <div class="row pt-2 bg-white border border-dark border-2">
         <p class="text-center fs-2">Travel Pass History</p>
      </div>

      <div class="row">
         <div class="col-12" style="max-height: 500px; overflow-y: auto;">
            <?php
            include "../Database/db_connect.php"; // Include database connection

            try {
               // Fetch travel pass details from the view
               $sql = "SELECT * FROM travel_pass_summary ORDER BY travel_date DESC, departure_time DESC, destination_name";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                  $previous_travel_pass_id = null;
                  $firstRow = true;
                  $total_passengers = 0;
                  $total_fare = 0;

                  while ($row = $result->fetch_assoc()) {
                     // If it's a new travel pass, close the previous card first
                     if ($previous_travel_pass_id !== $row['travel_pass_id']) {
                        if (!$firstRow) {
                           // Display total passengers & total fare row before closing the table
                           echo "<tr class='table-secondary fw-bold'>
                                    <td class='text-end' colspan='1'>TOTAL:</td>
                                    <td>{$total_passengers}</td>
                                    <td>" . number_format($total_fare, 2) . "</td>
                                 </tr>
                              </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>";

                           // Reset totals for the new travel pass
                           $total_passengers = 0;
                           $total_fare = 0;
                        }

                        // Start a new travel pass card
                        echo "<div class='row mb-3'>
                                <div class='col-12'>
                                    <div class='card shadow border border-2 w-100 m-0 mb-2 mt-2 p-0'>
                                        <div class='card-body mx-2'>
                                            <form method='POST' action='depart_operation.php'>
                                                <div class='row border border-top-0 border-start-0 border-end-0 border-2 mb-4'>
                                                    <div class='col'>
                                                        <p class='fw-semibold fs-5 mb-0'>Caltransco</p>
                                                        <p class='fw-semibold fs-5'>Travel Pass (Davao)</p>
                                                    </div>
                                                    <div class='col col-3'>
                                                        <span><b>Date: </b>" . $row['travel_date'] . "</span><br>
                                                        <span><b>Departure Time: </b>" . $row['departure_time'] . "</span><br>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col col-3 d-flex align-items-center'>
                                                      <div>
                                                         <span><b>Driver: </b>" . $row['driver_name'] . "</span><br>
                                                            <span><b>Plate Number: </b>" . $row['platenumber'] . "</span><br>
                                                            <span><b>Card Color: </b>" . $row['card_color'] . "</span><br>
                                                            <span><b>Cashier: </b>" . $row['cashier_name'] . "</span>
                                                         </div>
                                                      </div>
                                                    <div class='col'>
                                                        <table class='table table-bordered text-center'>
                                                            <thead class='table-secondary'>
                                                                <tr>
                                                                    <th>Destination</th>
                                                                    <th>Total Passengers</th>
                                                                    <th>Total Fare</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";

                        $firstRow = false; // First row flag turned off after first pass
                     }

                     echo "
                                    <tr>
                                        <td>" . $row['destination_name'] . "</td>
                                        <td>" . $row['total_passengers'] . "</td>
                                        <td>" . number_format($row['total_fare'], 2) . "</td>
                                    </tr>";

                     $total_passengers += $row['total_passengers'];
                     $total_fare += $row['total_fare'];

                     $previous_travel_pass_id = $row['travel_pass_id'];
                  }
               }
            } catch (\Exception $e) {
               die($e);
            }
            ?>
         </div>
      </div>

   </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>