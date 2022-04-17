<?php include_once('home/html/config/config.php')?>

<?php

    require_once('server/vrClass/PointOfInterest.php');
    $pointOfInterest = new PointOfInterest($connection);
    $pointOfInterests = $pointOfInterest->getPoiArray([
        'order' => " pic_menu_position asc "
    ]);

    if( isset($_GET['poi']) ) {
        $poi = $pointOfInterest->getCurrentList($_GET['poi']);
        visitorCounter($_GET['poi']);
    }

    $navigation = categorizePOI($pointOfInterests);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    <style>
        .image-tile{
            width: 170px;
            display: inline-block;
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-size: .80em;
        }
        .image-tile img{
            display: block;
            cursor: pointer;
        }
        #id_pois{
            margin-right: 15px;
        }
        .poi {
            border: 1px solid #000;
            margin-bottom: 5px;
            padding: 5px;
            text-align: center;

            text-transform: uppercase;
            font-size: .87em;
            font-weight: bold;
        }
        .poi img {
            display: block;
        }

        .player-container{
            display: flex;
            flex-direction: row;
            align-content: center;
            align-items: baseline;
        }

        #id_container_360{
            height: 80vh;
        }

        .player-container .section {
            padding: 10px;
        }

        .player-container .image-spills{
            flex: 1;
        }

        .player-container #id_container_360_container{
            flex: 8;
        }

        /** 
        *CSS KALAHATI
        */
        body{
            background: rgb(9,9,121);
            background: linear-gradient(180deg, rgba(9,9,121,1) 11%, rgba(0,212,255,1) 100%);
        }
        .player-container{
            background-color: #fff;
        }
        div.border{
            border: 2px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }

        .border .item{
            display: none;
        }

        .marker{
            cursor: pointer;
        }

        
        #id_speech_container{
            display: none;
        }

        /* Portrait */
        @media only screen 
        and (min-device-width: 320px) 
        and (max-device-width: 480px)
        and (-webkit-min-device-pixel-ratio: 2)
        and (orientation: portrait) {
            body{
                padding: 0px;
                height: 100vh;
            }
            .player-container{
                padding: 0px;
                margin: 0px;
                height: 50vh;
            }
            .image-spills{
                display: none;
            }
            #id_container_360_container{
                width: 500px;
                height: 50vh;
            }
        }

        @media screen 
        and (device-width: 320px) 
        and (device-height: 640px) 
        and (-webkit-device-pixel-ratio: 2) 
        and (orientation: portrait) {

        }

        /* Portrait and Landscape */
        @media 
        (min-device-width: 800px) 
        and (max-device-width: 1280px) {

        }

        /* Portrait */
        @media 
        (max-device-width: 800px) 
        and (orientation: portrait) { 

        }


    </style>
</head>
<body>
    <div class="container-fluid" id="main">
        <div class="jumbtron">
            <h1 class="text-center; text-white">Systems Plus Computer College- Caloocan</h1>
        </div>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="#" alt="" id="id_modal_img" style="width: 100%;">
            </div>
            </div>
        </div>
        </div>
        <!-- -->
        <div class="player-container">
            <div class="image-spills section">
                <h3>Locations</h3>
                <div id="id_pois">
                    <?php if( $navigation['categorized']) :?>
                        <?php foreach($navigation['categorized'] as $key => $categorized ) :?>
                            <div class="border">
                                <label for="#" style="font-weight: bold;font-size:9pt;cursor:pointer">
                                    <?php echo $navigation['categorized'][$key][0]['name']?>
                                </label>
                                <div class="item">
                                    <?php foreach($navigation['categorized'][$key] as $catItemKey => $catItem ) :?>
                                        <div class="poi">
                                            <?php if($catItem['poi']->images) :?>
                                                <a href="?poi=<?php echo $catItem['poi']->id?>">
                                                <img src="<?php echo 'server/vrGallery/'.$catItem['poi']->images[0]->file_name?>"
                                                        style="width:100%">
                                                </a>
                                            <?php endif?>
                                            <label for="#"><?php echo $catItem['poi']->pic_name?></label>
                                        </div>
                                    <?php endforeach?>
                                </div>
                            </div>
                        <?php endforeach?>
                    <?php endif?>

                    <?php if( $navigation['no_categories']) :?>
                        <?php foreach($navigation['no_categories'] as $key => $row ) :?>
                            <div class="poi">
                                <?php if($row->images) :?>
                                    <a href="?poi=<?php echo $row->id?>">
                                    <img src="<?php echo 'server/vrGallery/'.$row->images[0]->file_name?>"
                                            style="width:100%">
                                    </a>
                                <?php endif?>
                                <label for="#"><?php echo $row->pic_name?></label>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                </div>
            </div>

            <?php if( isset($poi) ) :?> 
            <div id="id_container_360_container" class="section">
                <h3 style="background-color: #090979; color:#fff;padding:3px; padding-left:15px;text-transform:uppercase"><?php echo $poi->pic_name?></h3>
                <div id="id_container_360"></div>

                <i class="fas fa-volume-up"></i>
                <?php if(isset($poi)) :?>
                <div class="card-footer">
                    <h5>POI Items</h5>
                    <div id="id_poi_tiles">
                        <?php foreach( $poi->images as $key => $row) :?>
                            <div class="image-tile" <?php echo $row->is_default_bg == true ? "data-default='server/vrGallery/{$row->file_name}'" : ''?>>
                                <img src="<?php echo 'server/vrGallery/'.$row->file_name?>" alt="POI tiles"
                                    data-source="<?php echo 'server/vrGallery/'.$row->file_name?>"
                                    style="width:100%" data-toggle="modal" data-target="#exampleModal">
                                <label for="#"><?php echo $row->file_name?></label>
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
                <?php endif?>
            </div>
            <?php else:?>
                <div class="card-footer mt-4">
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-lg-12 bg-white d-flex justify-content-center">
                            <div id="maps" style="position: relative; min-width: 1200px !important; min-height: 600px !important; max-width: 1200px !important; max-height: 600px !important;">
                                <img src="home/assets/images/map.png" width="100%" height="600px">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif?>
            
            <?php if( isset($poi) ) : ?>
            <div id="id_speech_container" class="section">
                <h3>Speech</h3>
                <div>
                   <a href="#" id="close">Close</a>
                   <a href="#" id="pause">Pause</a>
                   <a href="#" id="resume">Resume</a>
                </div>
                <hr>
                <p style="margin: 0px;">Click the text are to play speech</p>
                <textarea 
                name="" 
                id="message" 
                cols="30" 
                rows="10"
                readonly
                class="form-control"><?php echo $poi->pic_voicescript?></textarea>

                
                <?php if( $poi->pic_voicelink )  :?>
                <hr>
                <section>
                    <h5>Music</h5>
                    <audio  controls loop autostart>
                        <source src="server/vrMusic/<?php echo $poi->pic_voicelink?>" type="audio/ogg">
                        <source src="server/vrMusic/<?php echo $poi->pic_voicelink?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </section>
                <?php endif?>
            </div>
            <?php endif?>

        </div>

        <?php if( isset($poi) ) :?>
        <div class="card-footer mt-4">
            <div class="row" style="margin-top: 50px;">
                <div class="col-lg-12 bg-white d-flex justify-content-center">
                    <div id="maps" style="position: relative; min-width: 1200px !important; min-height: 600px !important; max-width: 1200px !important; max-height: 600px !important;">
                        <img src="home/assets/images/map.png" width="1200px" height="600px">
                    </div>
                </div>
            </div>
        </div>
        <?php endif?>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js" 
        integrity="sha512-uWKImujbh9CwNa8Eey5s8vlHDB4o1HhrVszkympkm5ciYTnUEQv3t4QHU02CUqPtdKTg62FsHo12x63q6u0wmg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>                           
    <script src="server/panolens.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        window.BeforeUnloadEvent
        /**
         * PanoJS
         */
        var panorama , viewer , panoImageContainer , photo , defaultTile;
        /**
         * Speach Syntehesis
         */
        var text , msg, voices;

        let hasPanoRama = false;                   
        
        panoImageContainer =  document.getElementById('id_container_360');
       
        viewer = new PANOLENS.Viewer( { container: panoImageContainer } );
        // let photo = 'server/vrImage/fb360-mpk-clean-rotated-sample.jpg';
        function panoRun(photo)
        {
            hasPanoRama = true;
            panorama = new PANOLENS.ImagePanorama( photo );
            viewer.add( panorama );
        }
       $(function()
       {

        $(window).on('beforeunload', function(){
            speechSynthesis.cancel();
        });

        $("#id_poi_tiles div.image-tile").each( function(index , element) 
        {
            defaultTile = $(element).data('default');
            if( defaultTile ) {
                panoRun(defaultTile);
            }
        });
        

        $(".image-tile img").click( function() {
            $("#id_modal_img").attr('src' , $(this).data('source'));
        });

        function disposePanorama () {
            panorama.dispose();
            viewer.remove( panorama );
            panorama = null;
        }

        if ('speechSynthesis' in window) 
        {   
            $("#message").click( function() 
            {
                text = $('#message').val();
                msg = new SpeechSynthesisUtterance();
                voices = window.speechSynthesis.getVoices();

                msg.voice = voices[2];
                msg.rate = 11 / 10;
                msg.pitch = 2;
                msg.text = text;

                speechSynthesis.speak(msg);
            });
            $("#close").click( function() {
                speechSynthesis.cancel();
            });

            $("#pause").click( function() {
                speechSynthesis.pause();
            });

            $("#resume").click( function() {
                speechSynthesis.resume();
            });

        } else {
            alert('Speech Synthesis in not available');
        }
        });

        
    </script>

    <script>
        $( document ).ready( function() 
        {
            var recentPointer;
            $('.border label').click( function() 
            {
                $(this).parent().find('.item').toggle();
            });

            $(".marker").click( function() {

                let dataLink = $(this).data('link');

                alert(dataLink);
            });

            document.getElementById('maps').onclick = function clickEvent(e) 
            {

                let target = $(e.target);

                if( target.hasClass('marker') )
                {
                    let link =  target.data('link');

                    if( link != '' )
                        window.location = link;
                }
            }

            <?php if( isset( $poi ) ) : ?>
                loadMarker(<?php echo $poi->pic_map_x; ?>, <?php echo $poi->pic_map_y; ?> , <?php echo $poi->id; ?>);
            <?php endif?>

            <?php foreach( $pointOfInterests as $key => $row) :?>
                loadMarker(<?php echo $row->pic_map_x; ?>, <?php echo $row->pic_map_y; ?> , <?php echo $row->id; ?>);
            <?php endforeach?>
        });
        
        // Load existing marker
        
        function loadMarker(mapx, mapy , poi = null)
        {
            recentPointer = guidGenerator();
            
            var dataLink = '';

            if( poi != null )
                dataLink = "http://localhost/virtual_tour?poi="+poi;

            var x = mapx;
            var y = mapy;    // remove all existing markers
            $("#maps").append(            
                $(`<div class="marker map${recentPointer}" data-link='${dataLink}'></div>`).css({       // include a class
                    position: 'absolute',
                    top: (y - 50) + 'px',
                    left: (x - 50) + 'px',
                    width: '50px',
                    height: '70px',
                    "background-image": "url('home/assets/images/pinmap.png')",
                    "background-repeat": "stretch",
                    "background-size": "cover",
                })              
            );
        }

        function mapAutoLocation(locationX , locationY, recentPointer)
        {
            $.ajax({
                type: 'POST',
                url: 'server/api_poi_location.php',
                data:{
                    axisX: locationX,
                    axisY: locationY
                },
                success: function(response) 
                {
                    let responseData = JSON.parse(response);

                    if(responseData.poi !== null) 
                    {
                        alert("POI FOUND");
                        window.location = 'http://localhost/virtual_tour?poi='+responseData.poi.id;
                    }else{
                        remove(recentPointer);
                    }
                    
                }
            })
        }

        function remove(recentPointer) {
            $('.map'+recentPointer).remove();
        }
        function guidGenerator() {
            var S4 = function() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
            };
            return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
        }
    </script>
</body>
</html>

<?php
    function visitorCounter( $poi_id )
    {
       global $connection;

       $user_ip = userIP(); 
       $session = $_SESSION['visitor_session'] ?? genRandomString(15);
       cleanParams($session);

       $location = getLocation( $user_ip );

       $date = date('Y-m-d');

       $regionName = $location['regionName'] ?? '';
       $city = $location['city'] ?? '';

       if(  !isset($_SESSION['visitor_session']) ) 
        $_SESSION['visitor_session'] = $session;

       /**
        * check for visitors
        */
        $sql = " SELECT count(id) as total 
            FROM visitor_tbl
            WHERE visit_session = '{$session}'
            AND visit_poi = '{$poi_id}' ";
        
        $query = mysqli_query($connection , $sql);

        $result = mysqli_fetch_object($query);

        if( $result->total == 0 )
        {
            //new visit then insert

            $sql = " INSERT INTO visitor_tbl(visit_date,
            visit_poi,
            visit_ip,
            visit_location_city,
            visit_location_region,
            visit_session)
            
            VALUES('{$date}' , 
            '{$poi_id}' , 
            '{$user_ip}',
            '{$city}',
            '{$regionName}',
            '{$session}')";

            $query = mysqli_query($connection , $sql);
        }

    }
?>

<?php

    function categorizePOI($pois) 
    {
        /**
         * [
         *  'order' => '',
         *  'name'  => ''
         * ]
         */
        $categorized = [];

        $no_categories = [];


        foreach($pois as $key => $row) 
        {
            if( is_null($row->category_id)  || empty($row->category_id) ) {
                $no_categories[] = $row;
            }else
            {
                if( !isset($categorized[$row->cat_name]) )
                    $categorized[$row->cat_name] = [];

                array_push($categorized[$row->cat_name] , [
                    'poi' => $row,
                    'name' => $row->cat_name,
                    'order' => $row->poi_order
                ]);
            }
        }

        return [
            'categorized' => $categorized,
            'no_categories' => $no_categories
        ];
    }
?>