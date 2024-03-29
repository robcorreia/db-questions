<?php
include("config.php");
if (!empty($_SESSION['uid'])) {
    header("Location: device_confirmations.php");
}

include('class/userClass.php');
$userClass = new userClass();

require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();

$errorMsgReg = '';
$errorMsgLogin = '';
if (!empty($_POST['loginSubmit'])) {
    $usernameEmail = $_POST['usernameEmail'];
    $password = $_POST['password'];
    if (strlen(trim($usernameEmail)) > 1 && strlen(trim($password)) > 1) {
        $uid = $userClass->userLogin($usernameEmail, $password, $secret);
        if ($uid) {
            $url = BASE_URL . 'device_confirmations.php';
            header("Location: $url");
        } else {
            $errorMsgLogin = "E-mail ou Senha Errada.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Banco de Questões - SENAI/CTAI</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" charset="utf-8" />
</head>

<body>
    <div id="container">
        <h1>Banco de Questões - SENAI/CTAI</h1>
        <div id="login">
            <h3>Login</h3>
            <form method="post" action="" name="login">
                <label>E-mail</label>
                <input type="email" name="usernameEmail" autocomplete="off" />
                <label>Senha</label>
                <input type="password" name="password" autocomplete="off" />
                <div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
                <input type="submit" class="button" name="loginSubmit" value="Login">
            </form>
        </div>

    </div>

</body>

</html>