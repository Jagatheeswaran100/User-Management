<?php
include "layout/header.php";

// check if the user is logged in, if yes then redirect them to the home page
if (isset($_SESSION["email"])) {
    header("location:/index.php");
    exit;
}


$email = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $error = "Email and Password are required!";
    } else {
        include "tools/db.php";
        $dbConnection = getDatabaseConnection();

        $statement = $dbConnection->prepare(
            "SELECT id, first_name, last_name, phone, address, password, created_at FROM users WHERE email = ?"
        );

        // Bind variables to the prepared statement as parameters
        $statement->bind_param('s', $email);

        // execute statement
        $statement->execute();

        // bind result variables
        $statement->bind_result($id, $first_name, $last_name, $phone, $address, $stored_password, $created_at);

        // fetch values
        if ($statement->fetch()) {
            if (password_verify($password, $stored_password)) {
                // Password is correct

                // Store data in session variables
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                $_SESSION["address"] = $address;
                $_SESSION["created_at"] = $created_at;

                // Redirect user to the home page
                header("location:/index.php");
                exit;
            }
        }

        $statement->close();

        $error = "Email or Password is invalid";
    }
}
?>


<div class="container py-5">
    <div class="mx-auto border-bottom shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">LOGIN</h2>
        <hr />

        <!-- error alert -->
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Email ID</label>
                <input type="email" name="email" value="<?= $email ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
                <div class="col d-grid">
                    <a href="/index.php" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
        </form>


    </div>
</div>


<?php
include "layout/footer.php";
?>