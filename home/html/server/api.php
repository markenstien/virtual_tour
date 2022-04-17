<?php

    //require_once '../vendor/autoload.php';
    //use Phpml\Regression\LeastSquares;

    // Database
    include("../config/config.php");

    // check
    if (!isset($_GET['mode'])) {
        echo json_encode(array("message" => "Mode Error"));
        exit();
    }


    // 20 - Visitor 7D
    // ===============================
    if ($_GET['mode'] == '20')
    {
        // set
        $jsonArr = array();

        $targetDateFrom = $_GET['dateFrom'];
        $targetDateTo = $_GET['dateTo'];

        $dateMax = dateDiffInDays($targetDateFrom, $targetDateTo);

        // dates
        for ($x = 0; $x <= $dateMax; $x++)
        {
            // get date
            $dateResultWeek = $date->format(date('Y-m-d', strtotime($targetDateFrom . " + " . $x . " days")));
            $jsonArr["date"][] = $dateResultWeek;

            // get report 
            $sql="select count(DISTINCT(visit_ip)) as results FROM visitor_tbl where visit_date like '%" . $dateResultWeek . "%'"; 
            $rs=mysqli_query($connection,$sql);
            while ($rows = mysqli_fetch_object($rs))
            {
                $jsonArr["value"][] = $rows->results;
            }
        }
        
        // output
        echo json_encode($jsonArr);
    }

    // 21 - Visitor POI 7D
    // ===============================
    if ($_GET['mode'] == '21')
    {
        // set
        $jsonArr = array();

        $targetDateFrom = $_GET['dateFrom'];
        $targetDateTo = $_GET['dateTo'];

        // get report 
        $sql = "select *, count(DISTINCT(visit_ip)) as result FROM `visitor_tbl` where (visit_date BETWEEN '" . $targetDateFrom . "' and '" . $targetDateTo . "') GROUP by visit_poi order by result desc limit 3";
        $rs=mysqli_query($connection,$sql);
        while ($rows = mysqli_fetch_object($rs))
        {
            $jsonArr["value"][] = $rows->result;

            // name
            $sql = "select * from pic_tbl where id = '" . $rows->visit_poi . "'";
            $rsName=mysqli_query($connection,$sql);
            while ($rowsName = mysqli_fetch_object($rsName))
            {
                $jsonArr["text"][] = $rowsName->pic_name;
            }

        }
        
        // output
        echo json_encode($jsonArr);
    }

    // 22 - Visitor City 7D
    // ===============================
    if ($_GET['mode'] == '22')
    {
        // set
        $jsonArr = array();

        $targetDateFrom = $_GET['dateFrom'];
        $targetDateTo = $_GET['dateTo'];

        // get report 
        $sql = "select *, count(DISTINCT(visit_ip)) as result from visitor_tbl where (visit_date BETWEEN '" . $targetDateFrom . "' and '" . $targetDateTo . "') group by visit_location_city order by result desc limit 5";
        $rs=mysqli_query($connection,$sql);
        while ($rows = mysqli_fetch_object($rs))
        {
            $jsonArr["value"][] = $rows->result;
            $jsonArr["text"][] = $rows->visit_location_city . ", " . $rows->visit_location_region;
        }
        
        // output
        echo json_encode($jsonArr);
    }



    if ($_GET['mode'] == '100')
    {
        echo dateDiffInDays("2022-03-1", "2022-03-30");
    }


    function dateDiffInDays($date1, $date2) 
    {
        // Calculating the difference in timestamps
        $diff = strtotime($date2) - strtotime($date1);
    
        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }
?>