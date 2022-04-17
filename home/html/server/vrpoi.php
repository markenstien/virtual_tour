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
        // check image
        $fileFinal = $_POST["eVFileOrig"];
        if (file_exists($_FILES['eVFile']['tmp_name']) || is_uploaded_file($_FILES['eVFile']['tmp_name'])) {
            $targetDir = "../../../server/vrMusic/" . $_FILES["eVFile"]["name"];

            // size
            if (filesize($_FILES['eVFile']['tmp_name']) > 6000000)
            {
                // redirect
                header("Location: ../vrpoicreate.php?err=99");
                exit();
            }

            // upload
            echo $_FILES["eVFile"]["name"];
            $fileFinal = $_FILES["eVFile"]["name"];
            move_uploaded_file($_FILES["eVFile"]["tmp_name"], $targetDir);
        }

        // check image
        $imageFinal1 = $_POST["ePicMainOrig"];
        if (file_exists($_FILES['ePicMain']['tmp_name']) || is_uploaded_file($_FILES['ePicMain']['tmp_name'])) {
            $targetDir = "../../../server/vrImage/" . $_FILES["ePicMain"]["name"];
            $check = getimagesize($_FILES["ePicMain"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['ePicMain']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoiview.php?id=" . $_GET['id'] . "&err=99");
                    exit();
                }

                // upload
                echo $_FILES["ePicMain"]["name"];
                $imageFinal1 = $_FILES["ePicMain"]["name"];
                move_uploaded_file($_FILES["ePicMain"]["tmp_name"], $targetDir);
            }
        }

        // check image
        $imageFinal2 = $_POST["ePicbgOrig"];
        if (file_exists($_FILES['ePicbg']['tmp_name']) || is_uploaded_file($_FILES['ePicbg']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["ePicbg"]["name"];
            $check = getimagesize($_FILES["ePicbg"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['ePicbg']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoiview.php?id=" . $_GET['id'] . "&err=99");
                    exit();
                }

                // upload
                $imageFinal2 = $_FILES["ePicbg"]["name"];
                move_uploaded_file($_FILES["ePicbg"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal1 = $_POST["eGalOrig1"];
        if (file_exists($_FILES['eGal1']['tmp_name']) || is_uploaded_file($_FILES['eGal1']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["eGal1"]["name"];
            $check = getimagesize($_FILES["eGal1"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['eGal1']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinalGal1 = $_FILES["eGal1"]["name"];
                move_uploaded_file($_FILES["eGal1"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal2 = $_POST["eGalOrig2"];
        if (file_exists($_FILES['eGal2']['tmp_name']) || is_uploaded_file($_FILES['eGal2']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["eGal2"]["name"];
            $check = getimagesize($_FILES["eGal2"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['eGal2']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinalGal2 = $_FILES["eGal2"]["name"];
                move_uploaded_file($_FILES["eGal2"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal3 = $_POST["eGalOrig3"];
        if (file_exists($_FILES['eGal3']['tmp_name']) || is_uploaded_file($_FILES['eGal3']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["eGal3"]["name"];
            $check = getimagesize($_FILES["eGal3"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['eGal3']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinalGal3 = $_FILES["eGal3"]["name"];
                move_uploaded_file($_FILES["eGal3"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal4 = $_POST["eGalOrig4"];
        if (file_exists($_FILES['eGal4']['tmp_name']) || is_uploaded_file($_FILES['eGal4']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["eGal4"]["name"];
            $check = getimagesize($_FILES["eGal4"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['eGal4']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinalGal4 = $_FILES["eGal4"]["name"];
                move_uploaded_file($_FILES["eGal4"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal5 = $_POST["eGalOrig5"];
        if (file_exists($_FILES['eGal5']['tmp_name']) || is_uploaded_file($_FILES['eGal5']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["eGal5"]["name"];
            $check = getimagesize($_FILES["eGal5"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['eGal5']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinalGal5 = $_FILES["eGal5"]["name"];
                move_uploaded_file($_FILES["eGal5"]["tmp_name"], $targetDir);
            }
        }

        if ($imageFinal1 == "no-image.jpg" || $imageFinal2 == "no-image.jpg")
        {
            // redirect
            header("Location: ../vrpoiview.php?id=" . $_GET['id']);
            exit();
        }

        // check x y
        if (!is_numeric($_POST["eMapX"]) || !is_numeric($_POST["eMapY"]))
        {
            // redirect
            header("Location: ../vrpoicreate.php?err");
            exit();
        }

        // poi insert
        $sql = "update pic_tbl set
                    pic_name = '" . $_POST["eName"] . "',
                    pic_menu_position = '" . $_POST["eDesc"] . "',
                    pic_link = '" . $imageFinal1 . "',
                    pic_linkbg = '" . $imageFinal2 . "',
                    pic_voicelink = '" . $fileFinal . "',
                    pic_voicescript = '" . mysql_escape_mimic($_POST["eVScript"]) . "',
                    pic_gal1 = '" . $imageFinalGal1 . "',
                    pic_gal2 = '" . $imageFinalGal2 . "',
                    pic_gal3 = '" . $imageFinalGal3 . "',
                    pic_gal4 = '" . $imageFinalGal4 . "',
                    pic_gal5 = '" . $imageFinalGal5 . "',
                    pic_map_x = '" . $_POST["eMapX"] . "',
                    pic_map_y = '" . $_POST["eMapY"] . "'
                where id = '" . $_GET['id'] . "'";
        $rsinsertacc = mysqli_query($connection, $sql);

        // LOGS
        $sql = "insert into log_tbl
                    (
                        log_date,
                        log_detail
                    )
                    values
                    (
                        '" . $dateResult . "',
                        '" . $_SESSION['aUname'] . " updated a POI'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // redirect
        header("Location: ../vrpoiview.php?id=" . $_GET['id'] . "&ok");
        exit();
    }

    // delete
    if (isset($_POST['eBDelete']))
    {
        // poi insert
        $sql = "delete from pic_tbl where id = '" . $_GET['id'] . "'";
        $rsinsertacc = mysqli_query($connection, $sql);

        // poi delete
        $sql = "delete from visitor_tbl where visit_poi = '" . $_GET['id'] . "'";
        $rsinsertacc = mysqli_query($connection, $sql);

        // LOGS
        $sql = "insert into log_tbl
                    (
                        log_date,
                        log_detail
                    )
                    values
                    (
                        '" . $dateResult . "',
                        '" . $_SESSION['aUname'] . " deleted a POI'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // redirect
        header("Location: ../vrpoi.php?ok");
        exit();
    }

    if (isset($_GET['img']))
    {
        if ($_GET['img'] == '1')
        {
            // poi insert
            $sql = "update pic_tbl set
                        pic_gal1 = ''
                    where id = '" . $_GET['id'] . "'";
            $rsinsertacc = mysqli_query($connection, $sql);
        }

        if ($_GET['img'] == '2')
        {
            // poi insert
            $sql = "update pic_tbl set
                        pic_gal2 = ''
                    where id = '" . $_GET['id'] . "'";
            $rsinsertacc = mysqli_query($connection, $sql);
        }

        if ($_GET['img'] == '3')
        {
            // poi insert
            $sql = "update pic_tbl set
                        pic_gal3 = ''
                    where id = '" . $_GET['id'] . "'";
            $rsinsertacc = mysqli_query($connection, $sql);
        }

        if ($_GET['img'] == '4')
        {
            // poi insert
            $sql = "update pic_tbl set
                        pic_gal4 = ''
                    where id = '" . $_GET['id'] . "'";
            $rsinsertacc = mysqli_query($connection, $sql);
        }

        if ($_GET['img'] == '5')
        {
            // poi insert
            $sql = "update pic_tbl set
                        pic_gal5 = ''
                    where id = '" . $_GET['id'] . "'";
            $rsinsertacc = mysqli_query($connection, $sql);
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
                        '" . $_SESSION['aUname'] . " updated a POI'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // redirect
        header("Location: ../vrpoiview.php?id=" . $_GET['id'] . "&ok");
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