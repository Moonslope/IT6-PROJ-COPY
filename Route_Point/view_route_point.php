<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$title = "View Route Point Lists";
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
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../AdminUI/adminDashboard.php"><i class="bi bi-house me-2"></i>Dashboard</a>
                  </div>
                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Cashier/view_cashier.php">Cashier</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold mb-2 border border-1 border-dark" href="../Driver/view_driver.php">Driver</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Vehicle/view_vehicle.php">Vehicle</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Route/view_route.php">Route</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Route_Point/view_route_point.php">Route Point</a>
                  </div>

                  <div class="mx-3 mb-3">
                     <a class="btn btn-info w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Card-color/view_card_color.php">Card Color</a>
                  </div>

                  <div class="mx-3">
                     <a href="../Login-Register/Login.php" class="btn btn-info w-100 border border-1 border-dark fw-semibold"><i class="bi bi-box-arrow-left me-2"></i>Log Out</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="col col-9">
            <div class="card shadow">
               <div style="height: 500px;" class="card-body pt-1">
                  <div class="row rounded-3 border border-1 border-gray shadow  d-flex align-items-center mx-0 p-3 mb-3">
                     <div class="col col-4 d-flex align-items-center">
                        <h1 class="fs-4 pt-2">ROUTE POINT | LISTS</h1>
                     </div>

                     <div class="col col-6 d-flex gap-2  ps-5">
                        <form method="GET" action="view_route_point.php" class="d-flex gap-2 ps-5">
                           <input type="text" name="query" class="form-control" placeholder="Search here" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
                           <button type="submit" class="btn btn-outline-dark"><i class="bi bi-search"></i></button>
                        </form>
                     </div>

                     <div class="col col-2 text-end">
                        <a class="btn btn-success border border-1 border-dark fw-semibold" href="add_route_point.php">ADD
                           <i class="bi bi-plus-circle-fill fs-5"></i>
                        </a>
                     </div>
                  </div>

                  <div style="max-height: 360px; overflow-y: auto;">

                     <?php
                     try {
                        $sql = "SELECT route_points.*, routes.route_name 
                        FROM route_points 
                        JOIN routes ON route_points.route_id = routes.route_id";


                        if (isset($_GET['query']) && !empty($_GET['query'])) {
                           $search = $conn->real_escape_string($_GET['query']);
                           $sql .= " WHERE 
                                       route_point_name LIKE '%$search%' OR
                                       fare LIKE '%$search%' OR 
                                       route_name LIKE '%$search%'";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                           while ($row = $result->fetch_assoc()) {
                     ?>
                              <ul class="list-group mb-1">
                                 <li class="list-group-item d-flex align-items-center justify-content-between border border-2">
                                    <div class="d-flex align-items-center">
                                       <div>
                                          <img src="../images/map.png" alt="" class="img-fluid rounded-pill border border-2 border-dark me-3" width="50" height="50">
                                       </div>
                                       <div>
                                          <p class="mb-1"><span><strong>Route Point Name: </strong><?php echo $row['route_point_name']; ?></span><br></p>
                                          <p class="mb-1"><span><strong>Fare : </strong><?php echo $row['fare']; ?></span><br></p>
                                          <p class="mb-1"><span><strong>Route : </strong><?php echo $row['route_name']; ?></span><br></p>
                                       </div>
                                    </div>
                                    <div class="group-btn">
                                       <a href="edit_route_point.php?id=<?php echo $row['route_point_id']; ?>" class="btn"><i class="btn btn-outline-success bi bi-pencil-square"></i></a>
                                       <a href="op_delete_route_point.php?id=<?php echo $row['route_point_id']; ?>" class="btn"><i class="btn btn-outline-danger bi bi-trash"></i></a>
                                    </div>
                                 </li>
                              </ul>
                     <?php
                           }
                        } else {
                           echo '<div class="text-center mt-3"><p class="text-muted fs-5">No route point found.</p></div>';
                        }

                        $conn->close();
                     } catch (\Exception $e) {
                        die($e);
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>

   <!--Update Modal -->
   <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-info text-white">
               <h5 class="modal-title" id="updateModalLabel">Updated</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               New Details has been saved successfully!
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
         </div>
      </div>
   </div>

   <!--Delete Modal -->
   <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-danger text-white">
               <h5 class="modal-title" id="successModalLabel">Deleted</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               Route Point has been deleted successfully!
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

   <!-- Trigger Success Modal if Success Parameter Exists -->
   <?php if (isset($_GET['success']) && $_GET['success'] == 2): ?>
      <script>
         window.addEventListener('load', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Redirect after modal closes
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
               window.location.href = 'view_route_point.php';
            });
         });
      </script>

   <?php elseif (isset($_GET['update']) && $_GET['update'] == 1): ?>
      <script>
         window.addEventListener('load', function() {
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();

            // Redirect after modal closes
            document.getElementById('updateModal').addEventListener('hidden.bs.modal', function() {
               window.location.href = '../Route_Point/view_route_point.php';
            });
         });
      </script>
   <?php endif; ?>
</body>

</html>