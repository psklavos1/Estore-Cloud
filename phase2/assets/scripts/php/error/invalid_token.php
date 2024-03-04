<?php
session_start();
$user_data = $_SESSION;
echo'ERROR 404: Forbidden</br>' .
    "The Token used in this session has expired!";
?>

<html>
    <head>
        <title>Invalid Token</title>
        <link rel="stylesheet" href="../../../css/error_style.css">
    </head>
    <body>
        <div class="login">   <!--Sign In Link-->
            Redirect to Login? </br>
            <a href="../../../index.php">Login</a>
        </div>
    </body>
    
</html>