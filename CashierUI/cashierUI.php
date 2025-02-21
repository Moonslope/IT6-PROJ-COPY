<!DOCTYPE html>
<html lang="en">
<?php
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
            <a class="btn btn-nav" href="">New <i class="bi bi-plus"></i></a>
            <a class="btn btn-nav" href="">View <i class="bi bi-eye"></i></a>
            <a class="btn btn-nav" href="../Login-Register/Login.php">Log out <i class="bi bi-box-arrow-right"></i></a>
         </div>
      </div>

      <div class="row">
         <div class="col col-3">
            <div style="height: 550px;" class="card shadow-lg">
               <div class="card-body mx-3">
                  <h1 class="card-title fs-4 text-center border border-start-0 border-end-0 border-top-0 border-2 pb-3">Ticket</h1>

                  <div>
                     <form method="POST">
                        <div class="mt-4">
                           <label class="fw-semibold" for="dd-destination">DESTINATION</label>
                           <select id="dd-destination" name="dd-destination" onchange="this.form.submit()">
                              <option value="">None</option>

                              <option value="Mintal" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Mintal") ? "selected" : ""; ?>>Mintal</option>
                              <option value="Tugbok" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Tugbok") ? "selected" : ""; ?>>Tugbok</option>
                              <option value="Los Amigos" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Los Amigos") ? "selected" : ""; ?>>Los Amigos</option>
                              <option value="Quarry" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Quarry") ? "selected" : ""; ?>>Quarry</option>
                              <option value="Puting Bato" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Puting Bato") ? "selected" : ""; ?>>Puting Bato</option>
                              <option value="Riverside" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Riverside") ? "selected" : ""; ?>>Riverside</option>
                              <option value="Calinan" <?php echo (isset($_POST['dd-destination']) && $_POST['dd-destination'] == "Calinan") ? "selected" : ""; ?>>Calinan</option>
                           </select>

                           <input class="form-control form-control-sm text-center my-3" type="text" id="inputField" name="inputField" value="<?php echo isset($_POST['dd-destination']) ? $_POST['dd-destination'] : ''; ?>" readonly>
                        </div>

                        <div>
                           <label for="dd-cardColor" class="fw-semibold">CARD COLOR</label>
                           <select id="dd-cardColor" name="dd-cardColor" onchange="this.form.submit()">
                              <option value="">None</option>

                              <option value="Blue" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Blue") ? "selected" : ""; ?>>Blue</option>
                              <option value="Red" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Red") ? "selected" : ""; ?>>Red</option>
                              <option value="Pink" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Pink") ? "selected" : ""; ?>>Pink</option>
                              <option value="Orange" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Orange") ? "selected" : ""; ?>>Orange</option>
                              <option value="Black" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Black") ? "selected" : ""; ?>>Black</option>
                              <option value="Violet" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Violet") ? "selected" : ""; ?>>Violet</option>
                              <option value="Yellow" <?php echo (isset($_POST['dd-cardColor']) && $_POST['dd-cardColor'] == "Yellow") ? "selected" : ""; ?>>Yellow</option>
                           </select>

                           <input class="form-control form-control-sm text-center my-3" type="text" id="inputField" name="inputField" value="<?php echo isset($_POST['dd-cardColor']) ? $_POST['dd-cardColor'] : ''; ?>" readonly>
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
            <div style="height: 550px;" class="card shadow-lg">
               <div class="card-body">
                  <p class="card-title fw-semibold fs-5 text-center border border-top-0 border-end-0 border-start-0 border-2 pb-2">Caltransco | Travel Pass(Davao)</p>
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