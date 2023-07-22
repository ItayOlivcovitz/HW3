<?php
    $key = $_GET['key'];
    $email = $_GET['email'];
?>

<p>
You recently requested to reset your password. Please follow the link below to set a new password for your account:

<a href="set_password.php?key=<?=$key;?>&email=<?=$email;?>">Click Here</a>
</p>