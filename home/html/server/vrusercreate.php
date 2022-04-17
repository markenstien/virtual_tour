<?php

    //  SERVER 
    // ===================================================================================

    // include
    include("../config/config.php");


   
    //  START 
    // ===================================================================================
    // update
    if (isset($_POST['eBUpdate']))
    {
        
        if (strlen($_POST['eName']) > 100 && strlen($_POST['eName']) > 4)
        {
            // redirect
            header("Location: ../vrusercreate.php?err=1");
            exit();
        }

        if (strlen($_POST['eUname']) > 100 && strlen($_POST['eUname']) > 4)
        {
            // redirect
            header("Location: ../vrusercreate.php?err=1");
            exit();
        }

        if (strlen($_POST['ePword']) > 100 && strlen($_POST['ePword']) > 4)
        {
            // redirect
            header("Location: ../vrusercreate.php?err=1");
            exit();
        }

        if (strlen($_POST['eEmail']) > 100 && strlen($_POST['eEmail']) > 4)
        {
            // redirect
            header("Location: ../vrusercreate.php?err=1");
            exit();
        }

        if (strlen($_POST['eContact']) > 100 && strlen($_POST['eContact']) > 4)
        {
            // redirect
            header("Location: ../vrusercreate.php?err=1");
            exit();
        }

        // check
        $sql = "select * from user_tbl where user_uname = '" . $_POST["eUname"] . "'";
        $rsinsertacc = mysqli_query($connection, $sql);
        if (mysqli_num_rows($rsinsertacc))
        {
            // redirect
            header("Location: ../vrusercreate.php?err=2");
            exit();
        }

        // poi insert
        $sql = "insert into user_tbl
            (
                user_uname,
                user_pword,
                user_fname,
                user_email,
                user_contact
            ) values (
                '" . $_POST["eUname"] . "',
                '" . $_POST["ePword"] . "',
                '" . $_POST["eName"] . "',
                '" . $_POST["eEmail"] . "',
                '" . $_POST["eContact"] . "'
            )";
        $rsinsertacc = mysqli_query($connection, $sql);

        /*
        // generate code
        $generate = GUID();

        // send email
        $to = $uEmail;
        $subject = "Trackdown Verification Code";
        $txt = "Hi " . $uEmail .  "! Your Verification code is: "  . $generate;
        $headers = "From: trackdown@sssss.com";
        mail($to,$subject,$txt,$headers);
        */

        // redirect
        header("Location: ../vrusercreate.php?ok");
        exit();
    }

    

    // FUNCTION
    // ===========================================================
    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535));
    }

    function mysql_escape_mimic($inp) {
        if(is_array($inp))
            return array_map(__METHOD__, $inp);
    
        if(!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }
    
        return $inp;
    }
?>