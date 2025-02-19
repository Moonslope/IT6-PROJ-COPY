<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Cashier';
require  "../global/head.php";
?>

<body>
   <div class="con-bg container-fluid h-100">
      <div class="row border border-top-0 border-end-0 border-start-0 border-light border-2 pb-2">
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
         <div class="col col-4 py-4 px-4">
            <div class="card shadow-lg">
               <div class="card-body">
                  <h1 class="card-title fs-4 text-center border border-start-0 border-end-0 border-top-0 border-2 pb-3">Ticket</h1>

                  <div>
                     <form method="POST">
                        <div>
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
                           <button class="btn btn-primary w-25" type="submit">Okay</button>
                        </div>

                     </form>
                  </div>

                  <div>
                     <h1 class="card-title fs-4 text-center border border-start-0 border-end-0 border-bottom-0 border-2 my-3 pt-2">Receipt</h1>

                     <div class="row mb-3">
                        <div class="col">
                           <p>Date:</p>
                        </div>
                        <div class="col">
                           <p>Time:</p>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col">
                           <p>Destination:</p>
                        </div>
                        <div class="col">
                           <p>Amount:</p>
                        </div>
                     </div>

                     <div class="row border border-start-0 border-end-0 border-bottom-0 border-2">
                        <div class="col mt-3">
                           <p>Total:</p>
                        </div>
                     </div>

                     <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary w-25">Insert</button>
                     </div>

                  </div>
               </div>
            </div>
         </div>

         <div class="col col-8 py-4 pe-4">
            <div class="card shadow-lg">
               <div class="card-body">
                  <p class="card-title fw-semibold fs-5 text-center">Caltransco | Travel Pass(Davao)</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>