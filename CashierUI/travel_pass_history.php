<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$sql = "SELECT total_sales_today, total_sales_month FROM sales_summary";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total_today = $row['total_sales_today'] ?? 0;
$total_month = $row['total_sales_month'] ?? 0;

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
                        <select class="form-select" name="card_color_id">
                           <option value="">None</option>
                           <?php
                           $sql = "SELECT card_color_id, card_color_name FROM card_colors";
                           $result = $conn->query($sql);
                           while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['card_color_id'] . '">' . $row['card_color_name'] . '</option>';
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
                           $sql = "SELECT driver_id, driver_name FROM drivers";
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
                           $sql = "SELECT vehicle_id, platenumber FROM vehicles";
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
                           $sql = "SELECT cashier_id, cashier_name FROM cashiers";
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
         <div class="modal-dialog ">
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
      <div class="row  pb-2 mb-3">
         <div class="col col-5 d-flex gap-2 ms-2 mt-2">
            <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
            <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
         </div>

         <div class="col d-flex gap-5 align-items-center justify-content-end me-5">
            <button class="btn btn-c text-white" data-bs-toggle="modal" data-bs-target="#travelPassModal">New Travel Pass <i class="bi bi-plus-circle-fill ms-2"></i></button>
            <a class="btn btn-c text-white" href="travel_pass_history.php">Travel Pass History <i class="bi bi-clock-history ms-2"></i></a>
            <a class="btn btn-c text-white w-25" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right ms-2"></i></a>
         </div>
      </div>
      <!-- Row for logo and buttons -->

      <div class="row pt-2 bg-white border border-2">
         <div class="col col-7">
            <p class="fs-4 ms-3 fw-semibold">Travel Pass History</p>
         </div>
         <div class="col d-flex align-items-center justify-content-end me-4">
            <label class="fw-semibold me-3 fs-5">Total fares:</label>
            <button class="btn btn-info me-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#todayModal">Today</button>
            <button class="btn btn-info fw-semibold" data-bs-toggle="modal" data-bs-target="#monthModal">Month</button>
         </div>
      </div>

      <!-- Today Modal -->
      <div class="modal fade" id="todayModal" tabindex="-1" aria-labelledby="todayModalLabel" aria-hidden="true">
         <div class="modal-dialog ">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="todayModalLabel">Total Fares Today</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <p><strong>₱<?= number_format($total_today, 2) ?></strong></p>
               </div>
            </div>
         </div>
      </div>

      <!-- Month Modal -->
      <div class="modal fade" id="monthModal" tabindex="-1" aria-labelledby="monthModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="monthModalLabel">Total Fares This Month</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <p><strong>₱<?= number_format($total_month, 2) ?></strong></p>
               </div>
            </div>
         </div>
      </div>

      <!-- Table -->
      <div class="row">
         <div class="col-12" style="max-height: 500px; overflow-y: auto;">
            <?php
            try {
               // Fetch travel pass details from the travel_pass_history view
               $sql = "SELECT * FROM travel_pass_history ORDER BY travel_date DESC";
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
                                    <td>₱" . number_format($total_fare, 2) . "</td>
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
                                                        <span><b>Date: </b>" . date('Y-m-d', strtotime($row['travel_date'])) . "</span><br>
                                                        <span><b>Departure Time: </b>" . date('H:i:s', strtotime($row['departure_time'])) . "</span><br>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col col-3 d-flex align-items-center'>
                                                      <div>
                                                         <span><b>Driver: </b>" . $row['driver'] . "</span><br>
                                                         <span><b>Plate Number: </b>" . $row['vehicle'] . "</span><br>
                                                         <span><b>Card Color: </b>" . $row['card_color_name'] . "</span><br>
                                                         <span><b>Cashier: </b>" . $row['cashier'] . "</span>
                                                      </div>
                                                    </div>
                                                    <div class='col'>
                                                        <table class='table table-bordered text-center'>
                                                            <thead class='table-secondary'>
                                                                <tr>
                                                                    <th>Route</th>
                                                                    <th>Total Passengers</th>
                                                                    <th>Total Fare</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";

                        $firstRow = false; // First row flag turned off after first pass
                     }

                     echo "
                            <tr>
                                <td>" . $row['route'] . "</td>
                                <td>" . $row['total_passengers'] . "</td>
                                <td>₱" . number_format($row['total_fare'], 2) . "</td>
                            </tr>";

                     $total_passengers += $row['total_passengers'];
                     $total_fare += $row['total_fare'];

                     $previous_travel_pass_id = $row['travel_pass_id'];
                  }

                  // Display total for the last travel pass
                  echo "<tr class='table-secondary fw-bold'>
                        <td class='text-end' colspan='1'>TOTAL:</td>
                        <td>{$total_passengers}</td>
                        <td>₱" . number_format($total_fare, 2) . "</td>
                      </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>";
               }
            } catch (\Exception $e) {
               die($e);
            }
            ?>
         </div>
      </div>
      <!-- Table -->

   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>