<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add New Vehicle";
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
                            <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="../AdminUI/adminDashboard.php"><i class="bi bi-house me-2"></i>Dashboard</a>
                        </div>
                        <div class="mx-3 mb-3">
                            <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Cashier/view_cashier.php">Cashier</a>
                        </div>

                        <div class="mx-3 mb-3">
                            <a class="btn btn-h w-100 fw-semibold mb-2 border border-1 border-dark" href="../Driver/view_driver.php">Driver</a>
                        </div>

                        <div class="mx-3 mb-3">
                            <a class="btn btn-h w-100 fw-semibold  mb-2 border border-1 border-dark" href="../Vehicle/view_vehicle.php">Vehicle</a>
                        </div>

                        <div class="mx-3">
                            <a href="../Login-Register/Login.php" class="btn btn-h w-100 border border-1 border-dark fw-semibold"><i class="bi bi-box-arrow-left me-2"></i>Log Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-9">
                <div class="card shadow-lg">
                    <div style="height: 500px;" class="card-body">

                        <div class="row mt-3 ms-3">
                            <div class="col col-3">
                                <img class="img-fluid border border-2 border-black rounded-pill" src="../images/van.png" alt="" width="150" height="150">
                            </div>

                            <div class="col">
                                <h1 class="mt-3">Vehicle</h1>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center align-items-center mt-4">
                            <div class="col col-10">

                                <div class="card shadow-lg bg-light ">
                                    <div class="card-body">
                                        <form action="../Operations/op_add_vehicle.php" method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="platenumber" class="fw-semibold mb-3">Plate Number</label>
                                                    <input type="text" id="platenumber" name="platenumber" class="form-control border-dark" required>
                                                </div>
                                                <div class="col">
                                                    <label for="vehicle_model" class="fw-semibold mb-3">Vehicle Model</label>
                                                    <input type="text" id="vehicle_model" name="vehicle_model" class="form-control border-dark" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="vehicle_color" class="fw-semibold mb-3">Vehicle Color</label>
                                                    <input type="text" id="vehicle_color" name="vehicle_color" class="form-control border-dark" required>
                                                </div>
                                                <div class="col">
                                                    <label for="transmission_type" class="fw-semibold mb-3">Transmission Type</label>
                                                    <select class="form-select border border-dark" name="transmission_type" id="transmission_type">
                                                        <option value="">None</option>
                                                        <option value="Manual"> <?php echo (isset($_POST['transmission_type']) && $_POST['transmission_type'] == "Manual") ? "Selected" : ""; ?>Manual</option>

                                                        <option value="Automatic"> <?php echo (isset($_POST['transmission_type']) && $_POST['transmission_type'] == "Automatic") ? "Selected" : ""; ?>Automatic</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <a href="../AdminUI/adminDashboard.php" class="btn btn-outline-info w-100 text-dark fw-semibold">CANCEL</a>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-info w-100 border border-dark fw-semibold">SAVE</button>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>