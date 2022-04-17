<?php

    //  SERVER 
    // ===================================================================================

    // include
    include("../config/config.php");
    // Define Session
    $_SESSION['aUname'] = "";
    $_SESSION['aPword'] = "";



    //  START 
    // ===================================================================================
    // check length
    if (strlen($_POST["formUser"]) < 4 || strlen($_POST["formUser"]) > 50) {
        // redirect
        header("Location: ../index.php?err=1");
        exit();
    }

    // check length
    if (strlen($_POST["formPass"]) < 4 || strlen($_POST["formPass"]) > 50) {
        // redirect
        header("Location: ../index.php?err=1");
        exit();
    }

    // set
    $accountUname = $_POST["formUser"];
    $accountPword = $_POST["formPass"];

    // check activation status - ok
    $sql="select * FROM user_tbl where user_uname = '" . $accountUname . "' and user_pword = '" . $accountPword . "'"; 
    $rsaccount=mysqli_query($connection,$sql);
    while ($rowsaccount = mysqli_fetch_object($rsaccount))
    {
        // set
        $_SESSION['aUname'] = $accountUname;
        $_SESSION['aPword'] = $accountPword;

        // LOGS
        $sql = "insert into log_tbl
                    (
                        log_date,
                        log_detail
                    )
                    values
                    (
                        '" . $dateResult . "',
                        '" . $_SESSION['aUname'] . " logged in'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // redirect
        header("Location: ../vrdashboard.php");
        exit();
    }
    
    // redirect
    header("Location: ../index.php?err=2");
    exit();
?>