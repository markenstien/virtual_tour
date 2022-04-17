<?php

    // Database
    include("config.php");

    // check
    if (!isset($_GET['mode'])) {
        echo json_encode(array("message" => "Mode Error"));
        exit();
    }

    // 1 - Image Request List
    // ===============================
    if ($_GET['mode'] == '1')
    {
        // update history
        $sql = "select * from pic_tbl order by pic_menu_position asc";
        $rsVr=mysqli_query($connection, $sql);
        while ($rowsVr = mysqli_fetch_object($rsVr))
        {
            echo $rowsVr->id . "@";
            echo $rowsVr->pic_name . "@";
            echo $rowsVr->pic_link . "@";
            echo $rowsVr->pic_linkbg . "@";
            echo $rowsVr->pic_voicescript . "@";
            echo $rowsVr->pic_voicelink . "@";
            echo $rowsVr->pic_menu_position . "@";

            echo $rowsVr->pic_gal1 . "@";
            echo $rowsVr->pic_gal2 . "@";
            echo $rowsVr->pic_gal3 . "@";
            echo $rowsVr->pic_gal4 . "@";
            echo $rowsVr->pic_gal5 . "@";

            echo $rowsVr->pic_map_x . "@";
            echo $rowsVr->pic_map_y . "@";
            echo "?";
        }
    }

    // 3 - Location
     // ===============================
     if ($_GET['mode'] == '3')
     {
        // get
        $data = json_decode($_GET['d']);

        // insert visitor
        $sql = "insert into visitor_tbl
                    (
                        visit_date,
                        visit_poi,
                        visit_ip,
                        visit_location_city,
                        visit_location_region
                    )
                    values
                    (
                        '" . $dateResult . "',
                        '" . $_GET['poi'] . "',
                        '" . $data->ip . "',
                        '" . $data->city . "',
                        '" . $data->region . "'
                    )
        ";
        $rsVr=mysqli_query($connection, $sql);

        // insert counter
        $sql = "update pic_tbl set pic_counter = pic_counter + 1 where id = '" . $_GET['poi'] . "'";
        $rsVr=mysqli_query($connection, $sql);
     }
?>