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

      <div class="row">
         <div class="col col-3 ">
            <div style="height: 615px;" class="card shadow-lg">
               <div class="card-body">
                  <h1 class="card-title fs-4 text-center border border-start-0 border-end-0 border-top-0 border-2 pb-3">Ticket</h1>

                  <div>
                     <form method="POST">
                        <div class="mt-4">
                           <label class="fw-semibold mb-2" for="dd-destination">DESTINATION</label>
                           <select class="form-select mb-3" id="dd-destination" name="dd-destination">
                              <option value="">None</option>
                              <?php
                              try {
                                 $sqll = "SELECT * FROM route";
                                 $resultt = $conn->query($sqll);

                                 while ($roww = $resultt->fetch_assoc()) {
                                    echo '<option value="' . $roww['route'] . '">' . $roww['route'] . '</option>';
                                 }
                              } catch (\Exception $e) {
                                 die($e);
                              }
                              ?>

                           </select>

                        </div>

                        <div>
                           <label for="dd-cardColor" class="fw-semibold mb-2">CARD COLOR</label>
                           <select class="form-select mb-3" id="dd-cardColor" name="dd-cardColor">
                              <option value="">None</option>

                              <?php
                              try {
                                 $sqll = "SELECT * FROM card";
                                 $resultt = $conn->query($sqll);

                                 while ($roww = $resultt->fetch_assoc()) {
                                    echo '<option value="' . $roww['card_color'] . '">' . $roww['card_color'] . '</option>';
                                 }

                                 $conn->close();
                              } catch (\Exception $e) {
                                 die($e);
                              }
                              ?>
                           </select>

                        </div>

                        <div class="d-flex justify-content-end">
                           <button class="btn btn-h fw-semibold" type="submit">Okay</button>
                        </div>
                     </form>
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
                     <div class="row">
                        <div class="col">
                           <p class="fw-semibold">Driver Name:</p>
                           <!-- dropdown ni dre -->
                        </div>

                        <div class="col">
                           <p class="fw-semibold">Plate Number:</p>
                           <!-- dropdown ni dre -->
                        </div>

                        <div class="col">
                           <p class="fw-semibold">Departure Time:</p>
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
                                 <tr>
                                    <td>Mintal</td>
                                    <td>35</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Tugbok</td>
                                    <td>38</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Los Amigos</td>
                                    <td>40</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Quarry</td>
                                    <td>40</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Puting Bato</td>
                                    <td>45</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Riverside</td>
                                    <td>45</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td>Calinan</td>
                                    <td>50</td>
                                    <td></td>
                                    <td></td>
                                 </tr>
                              </tbody>
                              <tfoot class="table-secondary fw-bold">
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
                              <div class="col">
                                 <p class="fw-semibold">Card Color: </p>
                              </div>
                              <div class="col d-flex gap-3 justify-content-end">
                                 <button class="btn btn-outline-info text-dark fw-semibold">On Hold</button>
                                 <button class="btn btn-h fw-semibold">Depart</button>
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