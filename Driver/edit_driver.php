<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM driver WHERE driver_id=" . $id;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$title = 'Driver Lists | ' . $row['driver_fname'] . ' ' . $row['driver_lname'];
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
                                <img class="img-fluid border border-2 border-black rounded-pill" src="../images/driver.png" alt="" width="100" height="100">
                                <p class="mt-3 fs-2 fw-semibold">DRIVER</p>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center align-items-center mt-4 mb-4">
                            <div class="col col-10">

                                <div class="card shadow-lg bg-light ">
                                    <div class="card-body">
                                        <form action="../Operations//op_edit_driver.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label for="driver_fname" class="fw-semibold mb-3">First Name</label>
                                                    <input type="text" id="driver_fname" name="driver_fname" value="<?php echo $row['driver_fname'] ?>" class="form-control border-dark" required>
                                                </div>

                                                <div class="col">
                                                    <label for="driver_lname" class="fw-semibold mb-3">Last Name</label>
                                                    <input type="text" id="driver_lname" name="driver_lname" value="<?php echo $row['driver_lname'] ?>" class="form-control border-dark" required>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="driver_address" class="fw-semibold mb-3">Address</label>
                                                    <input type="text" id="driver_address" name="driver_address" value="<?php echo $row['driver_address'] ?>" class="form-control border-dark" required>
                                                </div>

                                                <div class="col">
                                                    <label for="driver_contactNum" class="fw-semibold mb-3">Contact Number</label>
                                                    <input type="text" id="driver_contactNum" name="driver_contactNum" value="<?php echo $row['driver_contactNum'] ?>" class="form-control border-dark" required>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <a href="view_driver.php" class="btn btn-outline-info w-100 text-dark fw-semibold">CANCEL</a>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-info w-100 border border-dark fw-semibold">UPDATE</button>
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