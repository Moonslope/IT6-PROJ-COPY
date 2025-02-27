<!DOCTYPE html>
<html lang="en">
<?php

$title = "Register";
require "../global/head.php";
?>

<body>
    <div class="con-bg container-fluid vh-100">
        <div class="row h-100">

            <div class="col col-12 col-sm-6 border border-top-0 border-bottom-0 border-start-0 border-light border-2 mb-3">
                <div class="row ms-4 mt-4">
                    <div class="d-flex gap-2">
                        <h1 style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);" class="fs-3 mt-2 text-white">CALTRANSCO</h1>
                        <img src="../images/image.png" alt="" class="img-fluid " width="50" height="50">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col d-flex justify-content-center align-items-center">
                        <img src="../images/system-administrator.png" class="img-fluid rounded-pill shadow-lg" alt="" width="400" height="400">
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="container vh-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col col-10">
                            <div>
                                <h1 style="text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);" class="text-center text-white fs-2 mb-5">Register</h1>
                            </div>
                            <div class="card shadow-lg" style="background-color: #e7faff;">
                                <div class="card-body ">
                                    <div class="p-3">
                                        <!-- Login Form -->
                                        <form action="op_register.php" method="POST">
                                            <div class="row mt-2">
                                                <label for="username" class="mb-2 fw-semibold">USERNAME</label>

                                                <div class="col col-12 d-flex ">
                                                    <input type="text" id="username" name="username" class="rounded-pill form-control border-black ">

                                                    <img src="../images/user.png" class="img-fluid" alt="" width="35" height="35">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <label for="password" class="mb-2 fw-semibold">PASSWORD</label>

                                                <div class="col col-12 d-flex align-items-center">
                                                    <input type="password" id="password" name="password" class="rounded-pill form-control border-black">

                                                    <img src="../images/padlock.png" class="img-fluid" alt="" width="35" height="35">
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col col-11">
                                                    <button type="submit" class="btn-c btn text-white rounded-pill w-100 ">Register</button>

                                                    <p class="text-center mt-3">Already have an account? <a class="text-primary" href="Login.php">Login</a></p>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Login Form -->
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