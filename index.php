<?php include_once('home/html/config/config.php')?>

<?php

    require_once('server/vrClass/PointOfInterest.php');
    $pointOfInterest = new PointOfInterest($connection);
    $pointOfInterests = $pointOfInterest->getPoiArray([
        'order' => " pic_menu_position asc "
    ]);

    $poi_id = null;

    if( isset($_GET['poi']) ) {
        $poi = $pointOfInterest->getCurrentList($_GET['poi']);
        $poi_id = $poi->id;
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
    <link rel="stylesheet" href="home/style.css">
</head>
<body>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-body">
                    <div style="text-align: right;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <img src="#" alt="" id="id_modal_img" style="width: 100%;">
                </div>
                </div>
            </div>
        </div>
        <!-- -->
        <!-- MAP MODAL -->
        <?php if( isset($poi) ) :?>
            <div class="modal fade bd-example-modal-lg" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleMapModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <div style="text-align: right;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-lg-12 bg-white d-flex justify-content-center">
                                <div id="maps" style="position: relative; min-width: 1200px !important; min-height: 600px !important; max-width: 1200px !important; max-height: 600px !important;">
                                    <img src="home/assets/images/map.png" width="100%" height="600px">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <?php endif?>
        <!-- -->
    <div class="flex">
        <div id="id_main_navigation">
            <div id="id_logo">
                <img src="home/assets/spcc-logo.png" alt="">
            </div>

            <div id="id_navigation_a" class="navigation-pane">
                <i data-feather="map-pin" class="navi-icons" data-open="#id_poi_nav_container"></i>
                <i data-feather="image" class="navi-icons" data-open="#id_poi_gal_nav_container"></i>
                <i data-feather="info" class="navi-icons" data-open="#id_text_to_speech"></i>
            </div>

            <div id="id_navigation_b" class="navigation-pane">
                <i data-feather="volume-2" id="id_music_test" style="<?php echo empty($poi->pic_voicelink) == true ? 'color:grey;cursor:none': ''?>"></i>
                <?php if( isset($poi) ) :?>
                    <i data-feather="map" data-toggle="modal" data-target="#mapModal"></i>
                <?php endif?>
            </div>
        </div>

        <div id="id_sub_navigation" style="<?php echo isset($poi) == true ? 'display:block': ''?>">
            <section id="id_poi_nav_container">
                <h5 class="title">Point Of Interest</h5>
                <div id="id_category_items">
                    <?php if( $navigation['categorized']) :?>
                        <?php foreach($navigation['categorized'] as $key => $categorized ) :?>
                            <div class="category">
                                <label for="#"> <i data-feather="chevron-down"></i> <?php echo $navigation['categorized'][$key][0]['name']?></label>
                                <div class="cat-items">
                                    <?php foreach($navigation['categorized'][$key] as $catItemKey => $catItem ) :?>
                                        <a href="?poi=<?php echo $catItem['poi']->id?>" class="<?php echo $poi_id ==  $catItem['poi']->id ? 'active' : ''?>">
                                            <img src="<?php echo 'server/vrGallery/'.$catItem['poi']->images[0]->file_name?>" style="width:100%">
                                        </a>
                                        <label for="#"><?php echo $catItem['poi']->pic_name?></label>
                                    <?php endforeach?>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach?>
                    <?php endif?>

                    <?php if( $navigation['no_categories']) :?>
                        <?php foreach($navigation['no_categories'] as $key => $row ) :?>
                            <div class="category">
                                <a href="?poi=<?php echo $row->id?>" class="<?php echo $poi_id  ==  $row->id ? 'active' : ''?>">
                                    <img src="<?php echo 'server/vrGallery/'.$row->images[0]->file_name?>"
                                        style="width:100%">
                                </a>
                                <label for="#"><?php echo $row->pic_name?></label>
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                </div>
            </section>
            <section id="id_poi_gal_nav_container" style="<?php echo isset($poi) == true ? 'display:block': ''?>">
                <h5 class="title">Gallery</h5>
                <?php if(isset($poi)) :?>
                    <?php foreach( $poi->images as $key => $row) :?>
                        <div class="image-tile" <?php echo $row->is_default_bg == true ? "data-default='server/vrGallery/{$row->file_name}'" : ''?>>
                            <img src="<?php echo 'server/vrGallery/'.$row->file_name?>" alt="POI tiles"
                                data-source="<?php echo 'server/vrGallery/'.$row->file_name?>"
                                style="width:100%" data-toggle="modal" data-target="#exampleModal">
                        </div>
                    <?php endforeach?>
                <?php endif?>
            </section>
            <?php if( isset($poi ) ) :?>
                <section id="id_text_to_speech">
                    <h5 class="title">Info</h5>
                    <p id="message"> <?php echo $poi->pic_voicescript?> </p>
                    <a href="#" id="play_message">Read It Loud</a>
                    <?php if( !empty($poi->pic_voicelink)) :?>
                    <audio controls id="id_audio" style="display: none;"> 
                        <source src="server/vrMusic/<?php echo $poi->pic_voicelink?>" type="audio/ogg"> 
                        <source src="server/vrMusic/<?php echo $poi->pic_voicelink?>" type="audio/mpeg"> 
                    </audio>
                    <?php endif?>
                </section>
            <?php endif?>
        </div>

        <div id="id_main">
            <?php if( isset($poi) ) :?> 
            <div id="id_container_360_container" class="section">
                <h3><?php echo $poi->pic_name?></h3>
                <div id="id_container_360"></div>
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
        </div>
    </div>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js" 
        integrity="sha512-uWKImujbh9CwNa8Eey5s8vlHDB4o1HhrVszkympkm5ciYTnUEQv3t4QHU02CUqPtdKTg62FsHo12x63q6u0wmg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>                           
    <script src="server/panolens.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        /**
         * PanoJS
         */
        var panorama , viewer , panoImageContainer , photo , defaultTile;
        /**
         * Speach Syntehesis
         */
        var text , msg, voices , isPlayingAudio = false , isSpeechActive = false;
        var url = 'http://spccvtour.info';
        
        let hasPanoRama = false;     
        
        panoImageContainer =  document.getElementById('id_container_360');

        viewer = new PANOLENS.Viewer( { container: panoImageContainer , indicatorSize: 5 , cameraFov:95 , autoRotate:true , autoRotateSpeed:0.2 } );
        // let photo = 'server/vrImage/fb360-mpk-clean-rotated-sample.jpg';
        function panoRun(photo)
        {
            hasPanoRama = true;
            panorama = new PANOLENS.ImagePanorama( photo );
            viewer.add( panorama );
        }

       $( document ).ready( function() 
       {
        $("#id_navigation_b").on('click', function(e) {
            if($(e.target).attr('id') == 'id_music_test') 
            {
                if(isPlayingAudio == false) 
                {
                    $('#id_audio').trigger('play');
                    $("#id_audio").prop("muted" , false);
                    isPlayingAudio = true;
                }else{
                    $("#id_audio").prop("muted" , true);
                    isPlayingAudio = false;
                }

                console.log(isPlayingAudio);
            }
        });

        
        $(window).on('beforeunload', function(){
            speechSynthesis.cancel();
        });

        $("div.image-tile").each( function(index , element) 
        {
            defaultTile = $(element).data('default');
            if( defaultTile ) {
                panoRun(defaultTile);
            }
        });
        

        $(".image-tile img").click( function() {
            $("#id_modal_img").attr('src' , $(this).data('source'));
        });

        $("#id_category_items .category label").on('click' , function(e)
        {
            let value = $(this).text();
            
            $(this).next('.cat-items').toggle();
        });

        function disposePanorama () {
            panorama.dispose();
            viewer.remove( panorama );
            panorama = null;
        }

        if ('speechSynthesis' in window) 
        {   
            $("#play_message").click( function() 
            {
                if( !isSpeechActive )
                {
                    text = $('#message').text();
                    msg = new SpeechSynthesisUtterance();
                    voices = window.speechSynthesis.getVoices();

                    msg.voice = voices[2];
                    msg.rate = 11 / 10;
                    msg.pitch = 2;
                    msg.text = text;

                    speechSynthesis.speak(msg);
                    isSpeechActive = true;
                }else
                {
                    speechSynthesis.cancel();
                    isSpeechActive = false;
                }
            });
        } else {
            alert('Speech Synthesis in not available');
        }
       });
        
    </script>

    <script>
        $( document ).ready( function() 
        {
            feather.replace();

            var recentPointer;
            var lastSecondNavOpen;

            $('.border label').click( function() 
            {
                $(this).parent().find('.item').toggle();
            });

            $(".marker").click( function() {

                let dataLink = $(this).data('link');

                alert(dataLink);
            });

            $(".navi-icons").click( function() {
                let target = $(this).data('open');
                toggleSecondNav(target);
            });

            $(".navi-icons").dblclick( function() {
                let target = $(this).data('open');
                $("#id_sub_navigation").show();
                $(target).show();
            });

            function toggleSecondNav( target )
            {
                $("#id_sub_navigation section").hide();

                if(  lastSecondNavOpen != target)
                {
                    $("#id_sub_navigation").show();
                    $(target).show();
                }else{
                    $("#id_sub_navigation").hide();
                }
                lastSecondNavOpen = target;
            }

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
                dataLink = url+"?poi="+poi;

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
                    "background-size": "cover"
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
                        window.location = url+'?poi='+responseData.poi.id;
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