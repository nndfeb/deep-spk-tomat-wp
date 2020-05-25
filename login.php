<?php
require_once 'init.php';

if (isset($_POST['login'])) {
	echo "hallo";
	$email = $_POST['email'];
	$password = $_POST['password'];
	$login->login($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="vendor/images/icons/logo.png" />
    <link rel="stylesheet" type="text/css" href="vendor/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/util.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/main.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="vendor/images/img-02.png" alt="IMG">
                </div>
                <form action="" method="POST" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Form Login
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" name="login" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <div class="text-center p-t-136">
                        <a class="txt2" href="daftar.php">
                            Daftar Akun
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php require_once 'templates/footer.php' ?>