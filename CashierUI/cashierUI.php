<!DOCTYPE html>
<html lang="en">
<?php

include "../Database/db_connect.php";
$title = 'Cashier';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid vh-100">
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2 mb-3">
         <div class="col col-4 d-flex gap-2 ms-2 mt-2">
            <h1 class="fs-3 mt-2 text-white" style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);">CALTRANSCO</h1>
            <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
         </div>

         <div class="col d-flex gap-5 align-items-center">
            <div>
               <a class="btn btn-nav px-5 fw-semibold" href="#">New
                  <img src="../images/new-document.png" alt="" width="15" height="15">
               </a>
            </div>

            <div>
               <a class="btn btn-nav px-5 fw-semibold" href="#">View
                  <img src="../images/view.png" alt="" width="15" height="15">
               </a>
            </div>

            <div>
               <a class="btn btn-nav px-5 fw-semibold" href="../Login-Register/Login.php">Log out <img src="../images/logout.png" alt="" width="15" height="15"></a>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col col-3">
            <div style="height: 540px;" class="card shadow-lg">
               <div class="card-body mx-3">
                  <h1 class="card-title fs-4 text-center border border-start-0 border-end-0 border-top-0 border-2 pb-3">Ticket</h1>

                  <div>
                     <form method="POST">
                        <div class="mt-4">
                           <label class="fw-semibold mb-2" for="dd-destination">DESTINATION</label>
                           <select class="form-select mb-3" id="dd-destination" name="dd-destination">
                              <option value="">None</option>
                              <?php
                              try {
                                 $sqll = "SELECT * FROM routes";
                                 $resultt = $conn->query($sqll);

                                 if ($resultt->num_rows > 0) {
                                    while ($roww = $resultt->fetch_assoc()) {
                                       echo '<option value="' . $roww['route'] . '">' . $roww['route'] . '</option>';
                                    }
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

                                 if ($resultt->num_rows > 0) {
                                    while ($roww = $resultt->fetch_assoc()) {
                                       echo '<option value="' . $roww['card_color'] . '">' . $roww['card_color'] . '</option>';
                                    }
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

         <div class="col col-9">
            <div class="card shadow-lg">
               <div class="card-body">
                  <p class="card-title fw-semibold fs-5 text-center">Caltransco | Travel Pass(Davao)</p>
                  <div class="container mt-3">
                     <div class="row">
                        <div class="col d-flex gap-2">
                           <p class="fw-semibold">DATE: </p>
                           <p><?php echo date('M d, Y'); ?></p>
                        </div>

                        <div class="col">
                           <p class="fw-semibold">PLATE NUMBER</p>
                           <!-- dropdown ni dre -->
                        </div>

                        <div class="col">
                           <p class="fw-semibold">Departure Time:</p>
                        </div>
                     </div>
                     <div class="row">
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

                           <div class="row">
                              <div class="col">
                                 <p class="fw-semibold">Cashier: </p>
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