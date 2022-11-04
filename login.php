<?php

include_once('includes/user.php');

$funObj = new user();
if (isset($_POST['submit'])) {
    $emailid = $_POST['email'];
    $password = $_POST['password'];
    $user = $funObj->Login($emailid, $password);
    if ($user) {
        // Registration Success  
        header("location:index.php");
        // echo "done";

    } else {
        // Registration Failed  
        echo "<script>alert('Email / Password Not Match')</script>";
        // echo "error";
    }
} ?>

<?php include 'includes/header.php' ?>
<div class="container w-50 mt-5">
    <h1 class="my-5 text-center">Login</h1>
    <form method="post" name="login">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form2Example1" class="form-control" name="email" required/>
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" name="password" required/>
            <label class="form-label" for="form2Example2">Password</label>
        </div>

        <!-- Submit button -->
        <input type="submit" class="btn btn-primary btn-block mb-4" name="submit" value="login">

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="signup.php">Register</a></p>
        </div>
    </form>
</div>
<?php include 'includes/footer.php' ?>