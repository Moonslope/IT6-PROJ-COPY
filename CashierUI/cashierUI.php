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
                        <form method="POST">
                           <div class="mt-4">
                              <label class="fw-semibold mb-2" for="destination">DESTINATION</label>
                              <select class="form-select mb-3" id="destination" name="destination">
                                 <option value="">None</option>
                                 <?php
                                 try {
                                    $sql = "SELECT * FROM routes";
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
                              <button class="btn btn-h fw-semibold w-100" type="submit">Okay</button>
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

                  <div class="container m-0 p-0">
                     <div class="row justify-content-center align-items-center mb-4 ">
                        <div class="col">
                           <div class="d-flex align-items-center">
                              <label class="fw-semibold me-3">Driver:</label>
                              <select class="form-select form-select-sm w-75" name="driver_name" id="driver_name">
                                 <option value="">None</option>
                                 <?php
                                 try {
                                    $sql = "SELECT * FROM driver";
                                    $result = $conn->query($sql);

                                    while ($row = $result->fetch_assoc()) {
                                       echo '<option value="' . $row['driver_name'] .  '">' . $row['driver_name'] .  '</option>';
                                    }
                                 } catch (\Exception $e) {
                                    die($e);
                                 }

                                 ?>
                              </select>
                           </div>
                        </div>

                        <div class="col">
                           <div class="d-flex align-items-center">
                              <label class="fw-semibold w-75">Plate number:</label>
                              <select name="platenumber" id="platenumber" class="form-select form-select-sm w-75">
                                 <option value="">None</option>
                                 <?php
                                 try {
                                    $sql = "SELECT * FROM vehicle";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                       echo '<option value="' . $row['platenumber'] . '"> ' . $row['platenumber'] . '</option>';
                                    }
                                 } catch (\Throwable $th) {
                                    //throw $th;
                                 }
                                 ?>
                              </select>
                           </div>

                        </div>

                        <div class="col">
                           <div class="d-flex align-items-center">
                              <label class="fw-semibold" for="deprat">Departure time:</label>
                           </div>
                        </div>
                     </div>

                     <div class="row mt-2">
                        <div class="col">
                           <table class="table table-bordered table-hover text-center">
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
                                 $sql = "SELECT * FROM routes";
                                 $result = $conn->query($sql);
                                 while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                          <td>{$row['route']}</td>
                                          <td>{$row['fare']}</td>
                                          <td></td>
                                          <td></td>
                                          </tr>";
                                 }
                                 ?>

                              </tbody>
                              <tfoot class="table-secondary fw-semibold">
                                 <tr>
                                    <td colspan="2">TOTAL:</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                              </tfoot>
                           </table>

                           <div class="row mt-4">
                              <div class="col">
                                 <p class="fw-semibold">Cashier: </p>
                              </div>
                              <div class="col d-flex align-items-center">

                                 <label for=" card_color" class="fw-semibold me-3">CARD COLOR</label>
                                 <select class="form-select form-select-sm w-50" id="card_color" name="card_color">
                                    <option value="">None</option>

                                    <?php
                                    try {
                                       $sql = "SELECT * FROM card";
                                       $result = $conn->query($sql);

                                       while ($row = $result->fetch_assoc()) {
                                          echo '<option value="' . $row['card_color'] . '">' . $row['card_color'] . '</option>';
                                       }
                                       $conn->close();
                                    } catch (\Exception $e) {
                                       die($e);
                                    }
                                    ?>
                                 </select>

                              </div>
                              <div class="col d-flex gap-3 justify-content-end">
                                 <button class="btn btn-outline-info text-dark fw-semibold w-100">On Hold</button>
                                 <button class="btn btn-h fw-semibold w-100">Depart</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>