<?php 
    include_once('../home/html/config/config.php');

    //**fetch */

    $axisX = $_POST['axisX'];
    $axisXVicinityH = $axisX + 90;
    $axisXVicinityL = $axisX - 90;

    $axisY = $_POST['axisY'];
    $axisYVicinityH = $axisY + 90;
    $axisYVicinityL = $axisY - 90;


    $sql = " SELECT * FROM pic_tbl
        WHERE pic_map_x between {$axisXVicinityL} and {$axisXVicinityH}
            AND pic_map_y between {$axisYVicinityL} and {$axisYVicinityH}
            ";

    $query = mysqli_query($connection , $sql);
    $poi = mysqli_fetch_object($query);

    if($poi) {
        echo json_encode([
            'status' => 'fetched',
            'poi'    => $poi
        ]);
    }else{
        echo json_encode([
            'status' => 'fetched',
            'message' => 'no-poi-found',
            'poi' => null
        ]);
    }
?>
