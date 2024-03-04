<?php
echo 'ERROR 401: Unauthorized</br>';
echo 'Login required to enter this page.</br>';
?>

<html>
    <head>
        <title>Anauthorized Error</title>
        <link rel="stylesheet" href="../../../css/error_style.css">
    </head>
    <body>
        <div class="login"> 
            Redirect to Login? </br>
            <a href="../helper_scripts/logout.php">Login</a>
        </div>
    </body>
    
</html>