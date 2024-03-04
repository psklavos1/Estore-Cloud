<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';
$user_data = check_login($con);
$role = $user_data['ROLE'];
echo 'ERROR 401: Unauthorized</br>' .
    "This page is unreachable for users with role $role</br>" .
    'Only administrators are authorized to enter.';
?>

<html>
    <head>
        <title>Anauthorized Error</title>
        <link rel="stylesheet" href="../../../css/error_style.css">
    </head>
    <body>
        <div class="login">   <!--Sign Up Link-->
            Back to home Page? </br>
            <a href="../main/welcome.php">Home</a>
        </div>
    </body>
    
</html>