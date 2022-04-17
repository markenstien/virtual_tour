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
        $fileFinal = "no-image.jpg";
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
        $imageFinal1 = "no-image.jpg";
        if (file_exists($_FILES['ePicMain']['tmp_name']) || is_uploaded_file($_FILES['ePicMain']['tmp_name'])) {
            $targetDir = "../../../server/vrImage/" . $_FILES["ePicMain"]["name"];
            $check = getimagesize($_FILES["ePicMain"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['ePicMain']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                echo $_FILES["ePicMain"]["name"];
                $imageFinal1 = $_FILES["ePicMain"]["name"];
                move_uploaded_file($_FILES["ePicMain"]["tmp_name"], $targetDir);
            }
        }

        // check image
        $imageFinal2 = "no-image.jpg";
        if (file_exists($_FILES['ePicbg']['tmp_name']) || is_uploaded_file($_FILES['ePicbg']['tmp_name'])) {
            $targetDir = "../../../server/vrBg/" . $_FILES["ePicbg"]["name"];
            $check = getimagesize($_FILES["ePicbg"]["tmp_name"]);
            if ($check)
            {
                // size
                if (filesize($_FILES['ePicbg']['tmp_name']) > 6000000)
                {
                    // redirect
                    header("Location: ../vrpoicreate.php?err=99");
                    exit();
                }

                // upload
                $imageFinal2 = $_FILES["ePicbg"]["name"];
                move_uploaded_file($_FILES["ePicbg"]["tmp_name"], $targetDir);
            }
        }

        // check image gallery
        $imageFinalGal1 = "";
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
        $imageFinalGal2 = "";
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
        $imageFinalGal3 = "";
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
        $imageFinalGal4 = "";
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
        $imageFinalGal5 = "";
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
            header("Location: ../vrpoicreate.php?err");
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
        $sql = "insert into pic_tbl
            (
                pic_name,
                pic_menu_position,
                pic_link,
                pic_linkbg,
                pic_voicelink,
                pic_voicescript,
                pic_gal1,
                pic_gal2,
                pic_gal3,
                pic_gal4,
                pic_gal5,
                pic_map_x,
                pic_map_y
            ) values (
                '" . $_POST["eName"] . "',
                '" . $_POST["eDesc"] . "',
                '" . $imageFinal1 . "',
                '" . $imageFinal2 . "',
                '" . $fileFinal . "',
                '" . mysql_escape_mimic($_POST["eVScript"]) . "',
                '" . $imageFinalGal1 . "',
                '" . $imageFinalGal2 . "',
                '" . $imageFinalGal3 . "',
                '" . $imageFinalGal4 . "',
                '" . $imageFinalGal5 . "',
                '" . $_POST["eMapX"] . "',
                '" . $_POST["eMapY"] . "'
            )";
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
                        '" . $_SESSION['aUname'] . " created a POI'
                    )
        ";
        $rsinsertacc = mysqli_query($connection, $sql);

        // redirect
        header("Location: ../vrpoicreate.php?ok");
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