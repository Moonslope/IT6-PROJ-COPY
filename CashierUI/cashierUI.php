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
                c.card_color_name,
                r.route_name,
                v.platenumber,
                u.cashier_name 
              FROM travel_pass tp
              JOIN drivers d ON tp.driver_id = d.driver_id
              JOIN card_colors c ON tp.card_color_id = c.card_color_id
              JOIN routes r ON tp.route_id = r.route_id
              JOIN vehicles v ON tp.vehicle_id = v.vehicle_id
              JOIN cashiers u ON tp.cashier_id = u.cashier_id
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
   <div class="con-bg container-fluid vh-100">

      <!-- Row for logo and buttons -->
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2 mb-3">
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

      <div class="row">
         <!-- For the destination -->
         <div class="col col-3 ">
            <div class="card shadow-lg " style="height: 490px;">
               <div class="card-body">
                  <div class="row border border-start-0 border-end-0 border-top-0 border-2 mb-4">
                     <div class="col d-flex justify-content-center align-items-center gap-3 pb-3">
                        <h1 class="card-title fs-3 pt-1">Ticket</h1>
                        <i class="bi fs-1 bi-ticket-perforated-fill"></i>
                     </div>
                  </div>

                  <div class="row">
                     <!-- Route -->
                     <div class="col d-flex gap-3 mb-2">
                        <label class="fw-semibold">Route:</label>
                        <p><?php echo $travel_pass['route_name'] ?></p>
                     </div>
                     <!-- Route -->

                     <!-- Card Color -->
                     <div class="col d-flex gap-3 ">
                        <label class="fw-semibold">Card Color:</label>
                        <p><?php echo $travel_pass['card_color_name'] ?></p>
                     </div>
                     <!-- Card Color -->
                  </div>

                  <div class="row d-flex justify-content-center align-items-center border border-bottom-0 border-start-0 border-end-0 border-2">
                     <form method="POST" action="op_route_point.php?travel_pass_id=<?php echo $_GET['travel_pass_id']; ?>" onsubmit="return validatePassengers();">
                        <input type="hidden" name="travel_pass_id" value="<?php echo $_GET['travel_pass_id']; ?>">
                        <div class="col">
                           <div class="mt-4">
                              <label class="fw-semibold mb-2" for="route_point">Route Point</label>
                              <select class="form-select mb-3" id="route_point" name="route_point" required>
                                 <option value="">None</option>
                              </select>
                           </div>

                           <div>
                              <label for="passenger_count" class="fw-semibold">Passenger</label>
                              <input type="number" id="passenger_count" name="passenger_count" class="form-control mb-3" required>
                           </div>

                           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                           <script>
                              function loadRoutePoints() {
                                 let travelPassId = new URLSearchParams(window.location.search).get('travel_pass_id'); // Get travel_pass_id from URL

                                 if (travelPassId) {
                                    $.ajax({
                                       url: "get_route_points.php",
                                       method: "GET",
                                       data: {
                                          travel_pass_id: travelPassId
                                       },
                                       cache: false,
                                       success: function(response) {
                                          $("#route_point").html(response); // Populate dropdown
                                       },
                                       error: function(xhr, status, error) {
                                          console.error("AJAX Error:", error);
                                       }
                                    });
                                 } else {
                                    console.error("Error: No travel_pass_id received.");
                                 }
                              }

                              $(document).ready(function() {
                                 loadRoutePoints(); // Load dropdown on page load
                              });
                           </script>

                           <div class="d-flex justify-content-end mt-5">
                              <button class="btn btn-info fw-semibold w-100" type="submit" id="okayButton">Insert <i class="bi bi-arrow-right ms-3"></i></button>
                           </div>
                        </div>
                     </form>
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
                           <p class="fw-semibold fs-5">Travel Pass(Davao)</p>
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
                           <div class="card-body pb-0 mb-0">
                              <form method="POST" action="depart_operation.php">
                                 <input type="hidden" name="travel_pass_id" value="<?php echo $_GET['travel_pass_id']; ?>">
                                 <div class="row mb-2">

                                    <!-- Plate Number -->
                                    <div class="col d-flex gap-3">
                                       <label class="fw-semibold">Plate Number:</label>
                                       <p><?php echo $travel_pass['platenumber'] ?></p>
                                    </div>
                                    <!-- Plate Number -->

                                    <!-- Driver -->
                                    <div class="col d-flex gap-3">
                                       <label class="fw-semibold">Driver:</label>
                                       <p><?php echo $travel_pass['driver_name'] ?></p>
                                    </div>
                                    <!-- Driver -->

                                    <!-- Cashier -->
                                    <div class="col d-flex gap-3">
                                       <label class="fw-semibold">Cashier:</label>
                                       <p><?php echo $travel_pass['cashier_name'] ?></p>
                                    </div>
                                    <!-- Cashier -->
                                 </div>

                                 <div class="row mt-2">
                                    <div class="col" style="max-height: 205px; overflow-y: auto;">
                                       <table class="table table-bordered text-center">
                                          <thead class="table-secondary">
                                             <tr>
                                                <th>Route Points</th>
                                                <th>FARE</th>
                                                <th>PASSENGERS</th>
                                                <th>TOTAL FARE</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php
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
                                                // Query to get route point data for this travel pass
                                                $sql = "SELECT 
                                                                rp.route_point_name,  
                                                                rrp.fare, 
                                                                SUM(rrp.passenger_count) AS total_passengers
                                                            FROM route_points rp
                                                            JOIN route_route_points rrp ON rp.route_point_id = rrp.route_point_id
                                                            WHERE rrp.travel_pass_id = ?
                                                            GROUP BY rp.route_point_name, rrp.fare";

                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $travel_pass_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                // Loop through the results and display
                                                while ($row = $result->fetch_assoc()) {
                                                   $route_point_name = $row['route_point_name'];
                                                   $fare = $row['fare'];
                                                   $passenger_count = $row['total_passengers'];
                                                   $total_fare_per_route = $fare * $passenger_count;

                                                   // Update total counts
                                                   $total_passengers += $passenger_count;
                                                   $total_fare += $total_fare_per_route;

                                                   echo "<tr>
                                                                <td>{$route_point_name}</td>
                                                                <td>{$fare}</td>
                                                                <td>{$passenger_count}</td>
                                                                <td>{$total_fare_per_route}</td>
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

                                 <div class="row mt-4 mb-2">
                                    <div class="col d-flex gap-3 justify-content-end">
                                       <button type="submit" class="btn btn-info w-25 fw-semibold" id="departButton">
                                          SAVE <i class="bi bi-box-arrow-down ms-2"></i>
                                       </button>
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

                     <!-- Plate Number -->
                     <div class="mb-3">
                        <label class="fw-semibold">Plate Number:</label>
                        <select class="form-select" name="vehicle_id" id="platenumber">
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

                     <!-- Driver -->
                     <div class="mb-3">
                        <label class="fw-semibold">Driver:</label>
                        <input type="text" class="form-control form-control-sm" id="driver_name">
                        <input type="hidden" id="driver_id" name="driver_id" value="<?php echo isset($driver_id) ? $driver_id : ''; ?>"> <!-- Added hidden input for driver_id -->
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
   </div>

   <!-- If malapas ug 16 modal -->
   <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-danger text-light">
               <h5 class="modal-title" id="errorModalLabel">Notification</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p id="modalErrorMessage"></p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <script>
      function validatePassengers() {
         var totalPassengers = <?php echo $total_passengers; ?>;
         var newPassengers = parseInt(document.getElementById('passenger_count').value);

         if (totalPassengers + newPassengers > 16) {
            document.getElementById('modalErrorMessage').innerText = "Total number of passengers cannot exceed 16.";
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return false;
         }
         return true;
      }

      // Disable the "Okay" button if total passengers are 16 or more
      window.onload = function() {
         // Get the total number of passengers from the PHP variable
         var totalPassengers = <?php echo $total_passengers; ?>;

         // Check if the total number of passengers is 16 or more
         if (totalPassengers >= 16) {
            // Disable the "Okay" button if the total number of passengers is 16 or more
            document.getElementById('okayButton').disabled = true;
         }

         // Check if the total number of passengers is less than 16
         if (totalPassengers < 16) {
            // Enable the "Depart" button if the total number of passengers is less than 16
            document.getElementById('departButton').disabled = true;
         }
      };


      // Add event listener to the plate number dropdown
      document.getElementById('platenumber').addEventListener('change', function() {
         var vehicle_id = this.value;
         if (vehicle_id) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'get_driver.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
               if (xhr.readyState == 4 && xhr.status == 200) {
                  var response = JSON.parse(xhr.responseText);
                  document.getElementById('driver_name').value = response.driver_name;
                  document.getElementById('driver_id').value = response.driver_id; // Set driver_id value
               }
            };
            xhr.send('vehicle_id=' + vehicle_id);
         }
      });
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>