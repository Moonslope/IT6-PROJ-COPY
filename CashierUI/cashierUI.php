<!DOCTYPE html>
<html lang="en">
<?php
include "../Database/db_connect.php";

// Get the latest travel pass ID from URL
$travel_pass_id = isset($_GET['travel_pass_id']) ? $_GET['travel_pass_id'] : null;

if (!$travel_pass_id) {
   $query = "SELECT travel_pass_id FROM travel_pass ORDER BY travel_date DESC LIMIT 1";
   $result = $conn->query($query);
   if ($row = $result->fetch_assoc()) {
      $travel_pass_id = $row['travel_pass_id'];
   }
}

// Fetch travel pass details
if ($travel_pass_id) {
   $query = "SELECT 
                tp.travel_pass_id,
                d.driver_name, 
                c.card_color,
                r.route_name,
                v.platenumber,
                u.cashier_name 
              FROM travel_pass tp
              JOIN driver d ON tp.driver_id = d.driver_id
              JOIN card c ON tp.card_id = c.card_id
              JOIN routes r ON tp.route_id = r.route_id
              JOIN vehicle v ON tp.vehicle_id = v.vehicle_id
              JOIN cashier u ON tp.cashier_id = u.cashier_id
              WHERE tp.travel_pass_id = ?";

   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $travel_pass_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $travel_pass = $result->fetch_assoc();
}

$title = 'Cashier';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid">

      <div class="row ">
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

         <!-- For the destination -->
         <div class="col col-3">
            <div style="height: 675px;" class="card shadow-lg">
               <div class="card-body">
                  <div class="row border border-start-0 border-end-0 border-top-0 border-2">
                     <div class="col d-flex justify-content-center align-items-center gap-3 pb-3">
                        <h1 class="card-title fs-3 pt-1">Ticket</h1>
                        <i class="bi fs-1 bi-ticket-perforated-fill"></i>
                     </div>
                  </div>

                  <div class="row d-flex justify-content-center align-items-center">
                     <div class="col">
                        <form method="POST" action="op_destination.php">
                           <div class="mt-4">
                              <label class="fw-semibold mb-2" for="destination">Destination</label>
                              <select class="form-select mb-3" id="destination" name="destination">
                                 <option value="">None</option>
                              </select>
                           </div>

                           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                           <script>
                              $(document).ready(function() {
                                 let travelPassId = new URLSearchParams(window.location.search).get('travel_pass_id'); // Get travel_pass_id from URL

                                 if (travelPassId) {
                                    $.ajax({
                                       url: "get_destinations.php",
                                       method: "GET",
                                       data: {
                                          travel_pass_id: travelPassId
                                       },
                                       success: function(response) {
                                          $("#destination").html(response); // Populate dropdown
                                       },
                                       error: function(xhr, status, error) {
                                          console.error("AJAX Error:", error);
                                       }
                                    });
                                 } else {
                                    console.error("Error: No travel_pass_id received.");
                                 }
                              });
                           </script>

                           <div class="d-flex justify-content-end">
                              <button class="btn btn-info fw-semibold w-100" type="submit" id="okayButton">Insert</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- For the destination -->

         <!-- For table -->
         <div class="col col-9 pb-3">
            <div class="card shadow-lg">
               <div class="card-body">
                  <div class="row border border-top-0 border-end-0 border-start-0 border-2 mb-4">
                     <div class="col col-9">
                        <div>
                           <p class="fw-semibold fs-5 mb-0">Caltransco</p>
                           <p class="fw-semibold fs-5 ">Travel Pass(Davao)</p>
                        </div>
                     </div>

                     <div class="col">
                        <div class="text-end pt-4">
                           <p><strong>Date: </strong> <?php echo date('M d, Y'); ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col pb-3">
                        <div class="card shadow-lg">
                           <div class="card-body">
                              <form method="POST" action="depart_operation.php">
                                 <div class="row mb-4">
                                    <!-- Card Color -->
                                    <div class="col d-flex gap-3 ">
                                       <label class="fw-semibold">Card Color:</label>
                                       <p><?php echo $travel_pass['card_color'] ?></p>
                                    </div>
                                    <!-- Card Color -->

                                    <!-- Route -->
                                    <div class="col d-flex gap-3 ">
                                       <label class="fw-semibold">Route:</label>
                                       <p><?php echo $travel_pass['route_name'] ?></p>
                                    </div>
                                    <!-- Route -->

                                    <!-- Driver -->
                                    <div class="col d-flex gap-3 ">
                                       <label class="fw-semibold">Driver:</label>
                                       <p><?php echo $travel_pass['driver_name'] ?></p>
                                    </div>
                                    <!-- Driver -->

                                    <!-- Plate Number -->
                                    <div class="col d-flex gap-3 ">
                                       <label class="fw-semibold">Plate Number:</label>
                                       <p><?php echo $travel_pass['platenumber'] ?></p>
                                    </div>
                                    <!-- Plate Number -->

                                    <!-- Cashier -->
                                    <div class="col d-flex gap-3 align-items-center">
                                       <label class="fw-semibold">Cashier:</label>
                                       <p><?php echo $travel_pass['cashier_name'] ?></p>
                                    </div>
                                    <!-- Cashier -->
                                 </div>

                                 <div class="row mt-2">
                                    <div class="col">
                                       <table class="table table-bordered text-center">
                                          <thead class="table-secondary">
                                             <tr>
                                                <th>Destination</th>
                                                <th>FARE</th>
                                                <th>PASSENGERS</th>
                                                <th>TOTAL FARE</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php
                                             // Initialize total counters
                                             $total_passengers = 0;
                                             $total_fare = 0;

                                             // Get the current travel pass ID
                                             $travel_pass_id = isset($_GET['travel_pass_id']) ? $_GET['travel_pass_id'] : null;

                                             if (!$travel_pass_id) {
                                                $query = "SELECT travel_pass_id FROM travel_pass ORDER BY travel_date DESC LIMIT 1";
                                                $result = $conn->query($query);
                                                if ($row = $result->fetch_assoc()) {
                                                   $travel_pass_id = $row['travel_pass_id'];
                                                } else {
                                                   $travel_pass_id = null;
                                                }
                                             }

                                             // Ensure the travel pass exists
                                             if ($travel_pass_id) {
                                                // Query to get destination data for this travel pass
                                                $sql = "SELECT 
                                                            d.destination_name,  
                                                            d.fare, 
                                                            COALESCE(SUM(s.passenger_count), 0) AS total_passengers, 
                                                            COALESCE(SUM(s.fare), 0) AS total_fare
                                                      FROM destinations d
                                                      LEFT JOIN passenger_destination s ON d.destination_id = s.destination_id
                                                      WHERE s.travel_pass_id = ?
                                                      GROUP BY d.destination_name, d.fare";

                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $travel_pass_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                // Loop through the results and calculate total passengers and fare
                                                while ($row = $result->fetch_assoc()) {
                                                   $total_passengers += $row['total_passengers'];
                                                   $total_fare += $row['total_fare'];

                                                   echo "<tr>
                                                      <td>{$row['destination_name']}</td>
                                                      <td>{$row['fare']}</td>
                                                      <td>{$row['total_passengers']}</td>
                                                      <td>{$row['total_fare']}</td>
                                                   </tr>";
                                                }
                                             }

                                             // Display the totals row
                                             echo "<tr>
                                                      <td colspan='2'><strong>TOTAL:</strong></td>
                                                      <td><strong>$total_passengers</strong></td>
                                                      <td><strong>$total_fare</strong></td>
                                                   </tr>";
                                             ?>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>

                                 <div class="row mt-3">
                                    <div class="col col-6 d-flex gap-3 justify-content-end">
                                       <button type="submit" class="btn btn-info w-50 fw-semibold" id="departButton">SAVE</button>
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
         <!-- For table -->
      </div>
   </div>

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

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>