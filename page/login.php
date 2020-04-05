<?php
require_once '../init.php';
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login->login($email, $password);
}
?>

<link rel="stylesheet" href="../assets/css/main.css">

<style>
    /* FORM LOGIN */
    .main-form {
        /* background-color: red; */
        width: 400px;
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 300px;
        border: 1px solid lightgray;
        /*jika ingin melihat posisi div anda lebih jelas */
        background-color: rgba(255, 255, 255, 0.507);
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 45, 248, 0.062), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .header-form {
        text-align: center;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        margin-bottom: 0px;
        margin-top: 15px;
        padding-bottom: 0px;

    }


    input[type=text],
    input[type=password],
    input[type=number],
    input[type=email],
    select {
        width: 100%;
        padding: 3px 3px;
        margin: 3px 0;
        border: 1px solid #ccc;
        height: 40px;
        /* border-radius: 10px; */
        text-align: center;
    }

    /* Set a style for all buttons */
    button {
        background-color: rgb(168, 241, 149);
        color: white;
        padding: 9px 18px;
        margin: 0px 0px;
        /* margin-left: 20px;
  margin-right: 20px; */
        border-radius: 50px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        font-size: 11pt;
    }

    button:hover {
        opacity: 0.8;
    }

    .content-form {
        /* background-color: red; */
        width: 80%;
        margin: auto;
    }

    .btn-center {
        width: 100%;
        margin: 5px auto;
    }
</style>

<div class="main-form">
    <div class="header-form">
        <h2>Form Login</h2>
    </div>
    <div class="content-form">
        <form class="form" action="" method="post">
            <div class="container1">
                <div class="control-group">
                    <input type="email" name="email" placeholder="Email"> <br>
                </div>
                <div class="control-group">
                    <input type="password" name="password" placeholder="Password"> <br>
                </div>
                <div class="btn-center">
                    <button type="submit" name="login" class="btn btn-next">LOGIN</button>
                </div>
            </div>
        </form>
    </div>
</div>