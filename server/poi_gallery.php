<?php 

    //api request

    require_once '../home/html/config/config.php';
    require_once 'vrClass/PointOfInterestGallery.php';

    $pointOfInterestGallery = new PointOfInterestGallery($connection);


    $images = $pointOfInterestGallery->getImages([
        'where' => 'poi_id = 1'
    ]);

    
    echo json_encode( $images );