<!DOCTYPE html>
<html lang="en">
<?php
include "../Database/db_connect.php";
$title = 'Cashier';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid">
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2 mb-3">
         <div class="col col-4 d-flex gap-2 ms-2 mt-2">
            <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
            <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
         </div>

         <div class="col d-flex gap-5 align-items-center justify-content-end me-5   ">
            <a class="btn btn-nav" href="">New <i class="bi bi-plus"></i></a>
            <a class="btn btn-nav" href="">View <i class="bi bi-eye"></i></a>
            <a class="btn btn-nav" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right"></i></a>
         </div>
      </div>

      <div class="row ">
         <div class="col col-3">
            <div style="height: 630px;" class="card shadow-lg">
               <div class="card-body">
                  <div class="row  border border-start-0 border-end-0 border-top-0 border-2">
                     <div class="col d-flex justify-content-center align-items-center gap-3 pb-3">
                        <h1 class="card-title fs-3 pt-1">Ticket</h1>
                        <i class="bi fs-1 bi-ticket-perforated-fill"></i>
                     </div>
                  </div>

                  <div class="row d-flex justify-content-center align-items-center">
                     <div class="">
                        <form method="POST" action="process_ticket.php">
                           <div class="mt-4">
                              <label class="fw-semibold mb-2" for="destination">DESTINATION</label>
                              <select class="form-select mb-3" id="destination" name="destination">
                                 <option value="">None</option>
                                 <?php
                                 try {
                                    $sql = "SELECT * FROM route";
                                    $result = $conn->query($sql);

                                    while ($row = $result->fetch_assoc()) {
                                       echo '<option value="' . $row['route'] . '">' . $row['route'] . '</option>';
                                    }
                                 } catch (\Exception $e) {
                                    die($e);
                                 }
                                 ?>

                              </select>
                           </div>

                           <div class="d-flex justify-content-end">
                              <button class="btn btn-h fw-semibold w-100" type="submit" id="okayButton">Okay</button>
                           </div>
                        </form>
                     </div>
                  </div>

               </div>
            </div>
         </div>

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
                                    <div class="col d-flex gap-3 align-items-center">
                                       <label class="fw-semibold">Driver:</label>
                                       <input type="text" class="form-control form-control-sm" id="driver_name" readonly>
                                    </div>
                                    <div class="col d-flex gap-3 align-items-center">
                                       <label class="fw-semibold">Plate Number:</label>
                                       <select class="form-select w-50 form-select-sm" name="vehicle_id" id="platenumber">
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

                                    <div class="col d-flex gap-3 align-items-center">
                                       <label class="fw-semibold">Card Color:</label>
                                       <select class="form-select w-50 form-select-sm" name="card_id">
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
                                 </div>

                                 <div class="row mt-2">
                                    <div class="col">
                                       <table class="table table-bordered text-center">
                                          <thead class="table-secondary">
                                             <tr>
                                                <th>DESTINATION</th>
                                                <th>FARE</th>
                                                <th>TOTAL PASSENGERS</th>
                                                <th>TOTAL FARE</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php
                                             $total_passengers = 0;
                                             $total_fare = 0;
                                             $sql = "SELECT r.route, r.fare, COALESCE(t.total_passengers, 0) AS total_passengers, COALESCE(t.total_fare, 0) AS total_fare FROM route r LEFT JOIN ticket t ON r.route_id = t.route_id";
                                             $result = $conn->query($sql);
                                             while ($row = $result->fetch_assoc()) {
                                                $total_passengers += $row['total_passengers'];
                                                $total_fare += $row['total_fare'];
                                                echo "<tr><td>{$row['route']}</td><td>{$row['fare']}</td><td>{$row['total_passengers']}</td><td>{$row['total_fare']}</td></tr>";
                                             }
                                             ?>
                                          </tbody>
                                          <tfoot class="table-secondary fw-semibold">
                                             <tr>
                                                <td colspan="2">TOTAL:</td>
                                                <td><?php echo $total_passengers; ?></td>
                                                <td><?php echo number_format($total_fare, 2); ?></td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                       <input type="hidden" name="total_passengers" value="<?php echo $total_passengers; ?>">
                                       <input type="hidden" name="total_fare" value="<?php echo $total_fare; ?>">
                                    </div>
                                 </div>
                                 <div class="row mt-3">
                                    <div class="col d-flex gap-3 align-items-center">
                                       <label class="fw-semibold">Cashier:</label>
                                       <select class="form-select w-50 form-select-sm" name="cashier_id">
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

                                    <div class="col col-6 d-flex gap-3 justify-content-end">
                                       <button type="submit" class="btn btn-outline-info">On Hold</button>
                                       <button type="submit" class="btn btn-info">Depart</button>
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

   <script>
      // Function to validate the number of passengers before form submission
      function validatePassengers() {
         // Get the total number of passengers from the PHP variable
         var totalPassengers = <?php echo $total_passengers; ?>;
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
                  document.getElementById('driver_name').value = xhr.responseText;
               }
            };
            xhr.send('vehicle_id=' + vehicle_id);
         }
      });
   </script>
</body>

</html>