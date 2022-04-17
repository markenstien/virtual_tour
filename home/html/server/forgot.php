<?php

    //  SERVER 
    // ===================================================================================

    // include
    include("../config/config.php");

   
    //  START 
    // ===================================================================================


    $formUser = $_POST['formUser'];
    $formEmail = $_POST['formEmail'];

    // check exist
    $sql="select * FROM user_tbl where user_uname = '" . $formUser . "' and user_email = '" . $formEmail . "'"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        // generate code
        $generate = GUID();

        // send email
        $to = $formEmail;
        $subject = "SPCC Admin Panel New Password";
        $txt = "Hi " . $formEmail .  "! Your new password is: "  . $generate;
        $headers = "From: it.manager@saltandlightfusion.com";
        mail($to,$subject,$txt,$headers);

        // update acc
        $sql="update user_tbl set user_pword = '" . $generate . "' where user_uname = '" . $formUser . "'"; 
        $rsupdateacc=mysqli_query($connection,$sql);

        // redirect
        header("Location: ../index.php?oks");
        exit();
    }

    // redirect
    header("Location: ../forgot.php?err");
    exit();




    function mysql_escape_mimic($inp) {
        if(is_array($inp))
            return array_map(__METHOD__, $inp);
    
        if(!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }
    
        return $inp;
    }

    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535));
    }
?>