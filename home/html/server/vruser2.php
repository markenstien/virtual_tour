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
            header("Location: ../vraccount.php?id=" . $_GET['id'] . "&err");
            exit();
        }

        if (strlen($_POST['eUname']) > 100 && strlen($_POST['eUname']) > 4)
        {
            // redirect
            header("Location: ../vraccount.php?id=" . $_GET['id'] . "&err");
            exit();
        }

        if (strlen($_POST['ePword']) > 100 && strlen($_POST['ePword']) > 4)
        {
            // redirect
            header("Location: ../vraccount.php?id=" . $_GET['id'] . "&err");
            exit();
        }

        if (strlen($_POST['eEmail']) > 100 && strlen($_POST['eEmail']) > 4)
        {
            // redirect
            header("Location: ../vraccount.php?id=" . $_GET['id'] . "&err");
            exit();
        }

        if (strlen($_POST['eContact']) > 100 && strlen($_POST['eContact']) > 4)
        {
            // redirect
            header("Location: ../vraccount.php?id=" . $_GET['id'] . "&err");
            exit();
        }

        // poi insert
        $sql = "update user_tbl set
                    user_uname = '" . $_POST["eUname"] . "',
                    user_pword = '" . $_POST["ePword"] . "',
                    user_fname = '" . $_POST["eName"] . "',
                    user_email = '" . $_POST["eEmail"] . "',
                    user_contact = '" . $_POST["eContact"] . "'
                where id = '" . $_GET['id'] . "'
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // check
        if ($_SESSION['aUname'] == $_POST["eUname"])
        {
            $_SESSION['aPword'] = $_POST["ePword"];
        }


        // LOGS
        $sql = "insert into log_tbl
                    (
                        log_date,
                        log_detail
                    )
                    values
                    (
                        '" . $dateResult . "',
                        '" . $_SESSION['aUname'] . " updated an admin account'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        /*
        // redirect
        header("Location: ../vruserview.php?id=" . $_GET['id'] . "&ok");
        exit();
        */

        // redirect
        header("Location: ../vraccount.php?id=" . $_GET['id'] . "&ok");
        exit();
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