<?php
include "layout/header.php";

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["email"])) {
    header("location:/login.php");
    exit;
}
?>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Profile</h2>
            <hr />

            <div class="row mb-3">
                <div class="col-sm-4">Fisrt Name</div>
                <div class="col-sm-8"><?= $_SESSION["first_name"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Last Name</div>
                <div class="col-sm-8"><?= $_SESSION["last_name"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Email ID</div>
                <div class="col-sm-8"><?= $_SESSION["email"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Mobile Number</div>
                <div class="col-sm-8"><?= $_SESSION["phone"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Address</div>
                <div class="col-sm-8"><?= $_SESSION["address"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Registered At</div>
                <div class="col-sm-8"><?= $_SESSION["created_at"] ?></div>
            </div>
        </div>
    </div>
</div>



<?php
include "layout/footer.php";
?>