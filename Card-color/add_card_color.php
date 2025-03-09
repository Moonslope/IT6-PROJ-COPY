<!DOCTYPE html>
<html lang="en">

<?php
include "../Database/db_connect.php";

if (isset($_GET['error']) && $_GET['error'] == 'duplicate') {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalErrorMessage').innerText = 'Card color already exists!';
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
    </script>";
}

$title = "Add New Cashier";
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
                    <div style="height: 500px;" class="card-body">

                        <div class="row mt-3 ms-3">
                            <div class="col col-3">
                                <img class="img-fluid border border-2 border-black rounded-pill" src="../images/card.png" alt="" width="150" height="150">
                            </div>

                            <div class="col">
                                <h1 class="mt-3">NEW CARD COLOR</h1>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center align-items-center mt-4">
                            <div class="col col-6">

                                <div class="card shadow-lg bg-light ">
                                    <div class="card-body p-4">

                                        <form action="../Operations/op_add_card_color.php" method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="card_color" class="fw-semibold pt-3 pb-3">Card Color</label>
                                                    <input type="text" id="card_color" name="card_color" class="form-control border-dark mb-2" required>
                                                </div>
                                            </div>

                                            <div class="row mt-4 mb-3">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-info w-100 border border-dark fw-semibold">SAVE</button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <a href="view_card_color.php" class="btn btn-outline-info w-100 text-dark fw-semibold">CANCEL</a>
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

    <!-- duplicate modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="errorModalLabel">Duplicate Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalErrorMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--add Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    New Card Color has been added successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Trigger Success Modal if Success Parameter Exists -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <script>
            window.addEventListener('load', function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Redirect after modal closes
                document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                    window.location.href = '../Card-color/view_card_color.php';
                });
            });
        </script>
    <?php endif; ?>
</body>

</html>