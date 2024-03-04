<?php
session_start();
$user_data = $_SESSION;
$role = $user_data['role'];
echo 'ERROR 401: Unauthorized</br>' .
    "This page is unreachable for users with role $role</br>" .
    'Only Product Sellers are authorized to enter.';
?>

<html>
    <head>
        <title>Anauthorized Error</title>
        <link rel="stylesheet" href="../../../css/error_style.css">
    </head>
    <body>
        <div class="login">   <!--Sign Up Link-->
            Back to home Page: </br>
            <a href="../main/welcome.php">Home</a>
        </div>
    </body>
    
</html>