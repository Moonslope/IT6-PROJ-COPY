<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$id = $_GET['id'];

// Fetch the vehicle details, including the assigned driver ID
$sql_vehicle = "SELECT * FROM vehicles WHERE vehicle_id = ?";
$stmt_vehicle = $conn->prepare($sql_vehicle);
$stmt_vehicle->bind_param("i", $id);
$stmt_vehicle->execute();
$result_vehicle = $stmt_vehicle->get_result();
$row_vehicle = $result_vehicle->fetch_assoc();
$stmt_vehicle->close();

// Fetch the list of all drivers
$sql_driver = "SELECT driver_id, driver_name FROM drivers";
$result_driver = $conn->query($sql_driver);

$title = 'Vehicle Lists | ' . $row_vehicle['platenumber'];
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
                <div class="card shadow-lg">
                    <div class="card-body">

                        <div class="row border border-top-0 border-start-0 border-end-0 border-2 pb-3 mb-5">
                            <div class="col col-2 d-flex gap-4">
                                <img class="img-fluid border border-2 border-black rounded-pill" src="../images/van.png" alt="" width="100" height="100">
                                <p class="mt-3 fs-2 fw-semibold">VEHICLE</p>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center align-items-center mt-4 ">
                            <div class="col col-10">

                                <div class="card shadow-lg bg-light ">
                                    <div class="card-body">
                                        <form action="../Operations/op_edit_vehicle.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <div class="row">

                                                <div class="col">
                                                    <label for="platenumber" class="fw-semibold mb-3">Plate Number</label>
                                                    <input type="text" id="platenumber" name="platenumber" value="<?php echo $row_vehicle['platenumber'] ?>" class="form-control w-100 border-dark" required>
                                                </div>

                                                <div class="col">
                                                    <label for="driver_id" class="fw-semibold mb-3">Driver</label>
                                                    <select class="form-select border border-dark" name="driver_id" id="driver_id">
                                                        <option value="">None</option>
                                                        <?php
                                                        while ($driver = $result_driver->fetch_assoc()) {
                                                            $selected = ($row_vehicle['driver_id'] == $driver['driver_id']) ? "selected" : "";
                                                        ?>
                                                            <option value="<?php echo $driver['driver_id']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $driver['driver_name']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mt-4 mb-5">
                                                <div class="col">
                                                    <label for="vehicle_model" class="fw-semibold mb-3">Vehicle Model</label>
                                                    <input type="text" id="vehicle_model" name="vehicle_model" value="<?php echo $row_vehicle['vehicle_model'] ?>" class="form-control border-dark" required>
                                                </div>

                                                <div class="col">
                                                    <label for="transmission_type" class="fw-semibold mb-3">Transmission Type</label>
                                                    <select class="form-select border border-dark" name="transmission_type" id="transmission_type" required>
                                                        <option value="Manual" <?php echo ($row_vehicle['transmission_type'] == "Manual") ? "selected" : ""; ?>>Manual</option>
                                                        <option value="Automatic" <?php echo ($row_vehicle['transmission_type'] == "Automatic") ? "selected" : ""; ?>>Automatic</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="vehicle_color" class="fw-semibold mb-3">Vehicle Color</label>
                                                    <input type="text" id="vehicle_color" name="vehicle_color" value="<?php echo $row_vehicle['vehicle_color'] ?>" class="form-control border-dark" required>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col">
                                                    <a href="view_vehicle.php" class="btn btn-outline-info w-100 text-dark fw-semibold">CANCEL</a>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-info w-100 border-dark fw-semibold">Save Changes </button>
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

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorMessage">
                    <!-- Error message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="successModalLabel">Updated</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="successMessage">
                    <!-- Success message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeSuccessModal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorMessage = "<?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?>";
            const successMessage = "<?php echo isset($_GET['success']) ? $_GET['success'] : ''; ?>";

            if (errorMessage) {
                document.getElementById("errorMessage").innerText = errorMessage;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            }

            if (successMessage) {
                document.getElementById("successMessage").innerText = successMessage;
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Redirect to view_vehicle.php after closing the modal
                document.getElementById("closeSuccessModal").addEventListener("click", function() {
                    window.location.href = "view_vehicle.php";
                });
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>