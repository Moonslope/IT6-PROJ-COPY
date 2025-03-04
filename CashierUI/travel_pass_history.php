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
      <!-- para sa view ni -->
   </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>