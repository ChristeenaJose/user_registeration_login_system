<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<div class="wrapper"><?php
include('functions.php');
if (isset($_GET["id"])) {
    $id = intval(base64_decode($_GET["id"]));

    $chkUserExist = $classVar->chkUserExistById($id);
    if($chkUserExist){
        $resultActivateUser = $classVar->activateUser($id);

        if($resultActivateUser){
            $arrUserInfo = $classVar->getUserInfoById($id);
            session_start();
            $_SESSION['username'] = $arrUserInfo['username'];
            $_SESSION['id'] = $arrUserInfo['id'];
            $_SESSION['token'] = $arrUserInfo['token'];
            $_SESSION['message'] = "Account activation has been done";
            header("Location: dashboard.php");
        }
    }
    else{
        print("<div class='form'>
                  <h3>User account not exist.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>");
    }
}
else{
    header("Location: login.php");
}
?></div><?php
include('module/footer.php');
?>
</body>
</html>