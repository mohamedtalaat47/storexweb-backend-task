<?php

include_once('includes/user.php');

$funObj = new user();

if (isset($_POST['submit'])) {

    $username = $_POST['name'];
    $emailid = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $birthday = $_POST['birthday'];
    if ($password == $confirmPassword) {

        if (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $emailid) && !empty($password) && !empty($username) && !empty($birthday)) {

            $email = $funObj->isUserExist($emailid);
            if (!$email) {
                $register = $funObj->UserRegister($username, $emailid, $password, $birthday);
                if ($register) {
                    echo "<script>alert('Registration Successful')</script>";
                    header('Location:login.php');
                } else {
                    echo "<script>alert('Registration Not Successful')</script>";
                }
            } else {
                echo "<script>alert('Email Already Exist')</script>";
            }
        } else {
            echo "<script>alert('Password Not Match')</script>";
        }
    }
} 
?>

<?php include 'includes/header.php' ?>
<div class="container w-50 mt-5">
    <h1 class="my-5 text-center">Sign up</h1>
    <form method="POST" name="register">

        <div class="form-outline mb-4">
            <input type="text" id="form2Example1" class="form-control" name="name" required />
            <label class="form-label" for="form2Example1">Name</label>
        </div>

        <div class="form-outline mb-4">
            <input type="email" id="form2Example1" class="form-control" name="email" required />
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <div class="form-outline mb-4">
            <input type="date" id="form2Example1" class="form-control" name="birthday" required />
            <label class="form-label" for="form2Example1">Birth date</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" name="password" required />
            <label class="form-label" for="form2Example2">Password</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" name="confirm_password" required />
            <label class="form-label" for="form2Example2">Confirm password</label>
        </div>

        <input type="submit" class="btn btn-primary btn-block mb-4" name="submit" value="signup">

        <div class="text-center">
            <p>already a member? <a href="login.php">Login</a></p>
        </div>
    </form>
</div>
<?php include 'includes/footer.php' ?>