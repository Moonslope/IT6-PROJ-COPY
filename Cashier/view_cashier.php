<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$title = "View Cashier Lists";
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
                     <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="#">Vehicle</a>
                  </div>


                  <div class="mx-3">
                     <a href="../Login-Register/Login.php" class="btn btn-h w-100 border border-1 border-dark fw-semibold">Log Out</a>
                  </div>
               </div>
            </div>
         </div>

         <div class="col col-9">
            <div class="card shadow">
               <div style="height: 500px;" class="card-body pt-1">
                  <div class="row rounded-3 border border-1 border-gray shadow  d-flex align-items-center mx-0 p-3 mb-3">
                     <div class="col col-3 d-flex align-items-center">
                        <h1 class="fs-4 pt-2">CASHIER | LISTS</h1>

                     </div>

                     <div class="col col-6 d-flex gap-2  ps-5">
                        <form method="GET" action="view_cashier.php" class="d-flex gap-2 ps-5">
                           <input type="text" name="query" class="form-control" placeholder="Search here" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
                           <button type="submit" class="btn btn-outline-dark"><i class="bi bi-search"></i></button>
                        </form>

                     </div>

                     <div class="col col-3 text-end">
                        <a class="btn btn-success border border-1 border-dark fw-semibold" href="add_cashier.php">ADD
                           <i class="bi fs-5 bi-person-add"></i>
                        </a>

                     </div>
                  </div>

                  <div style="max-height: 400px; overflow-y: auto;">

                     <?php
                     try {
                        $sql = "SELECT * FROM cashier";

                        if (isset($_GET['query']) && !empty($_GET['query'])) {
                           $search = $conn->real_escape_string($_GET['query']);
                           $sql .= " WHERE 
                                       cashier_fname LIKE '%$search%' OR 
                                       cashier_lname LIKE '%$search%' OR 
                                       cashier_address LIKE '%$search%' OR 
                                       cashier_contactNum LIKE '%$search%'";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                           while ($row = $result->fetch_assoc()) {
                     ?>
                              <ul class="list-group mb-1">
                                 <li class="list-group-item d-flex align-items-center justify-content-between border border-2">
                                    <div class="d-flex align-items-center">
                                       <div>
                                          <img src="../images/cashier.png" alt="" class="img-fluid rounded-pill border border-2 border-dark me-3" width="50" height="50">
                                       </div>
                                       <div>
                                          <span><strong>Name : </strong><?php echo $row['cashier_fname'] . ' ' . $row['cashier_lname']; ?></span><br>
                                          <span><strong>Address : </strong><?php echo $row['cashier_address']; ?></span><br>
                                          <span><strong>Contact Number : </strong><?php echo $row['cashier_contactNum']; ?></span>
                                       </div>
                                    </div>
                                    <div class="group-btn">
                                       <a href="../Cashier/edit_cashier.php?id=<?php echo $row['id']; ?>" class="btn"><i class="btn btn-outline-success bi bi-pencil-square"></i></a>
                                       <a href="../Operations/op_delete_cashier.php?id=<?php echo $row['id']; ?>" class="btn"><i class="btn btn-outline-danger bi bi-trash"></i></a>
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
         </div>

      </div>
   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>