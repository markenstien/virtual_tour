<?php include_once('config/config.php')?>

<?php TMP_HEAD(); ?>

<?php
    $message  = '';
    $res = null;
    $action_type = null;

    $errors = [];

    $recentOrder = orderMaker();


    $sql = " SELECT * FROM poi_categories ORDER BY poi_order asc ";
    $query = mysqli_query($connection , $sql);
    $categories = [];
    while($poi_cat = mysqli_fetch_object($query) ) {
        $categories[] = $poi_cat;
    }

    if( isset($_GET['action']) )
    {
        switch( strtolower($_GET['action']) )
        {
            case 'delete_image':
                $sql = "DELETE FROM poi_image_galleries  where id = '{$_GET['img_id']}'";
                if($res = mysqli_query($connection , $sql)) {
                    $message = " IMAGE DELETED SUCCESSFULLY";
                }
            break;

            case 'set_default_image':
                $sql ="call setPoiImageDefault({$_GET['img_id']});";
                if($res = mysqli_query($connection , $sql)) {
                    $message = " Default Image Selected";
                }
            break;

            case 'delete_music':
                $sql = " UPDATE pic_tbl set pic_voicelink = '' 
                    where id = '{$_GET['id']}' ";
                if($res = mysqli_query($connection , $sql)) {
                    $message = " Voicelink mesage removed. ";
                }    
            break;
        }
    }

    if( isset($_POST['btn_save_poi']) )
    {
        $post = $_POST;
        cleanParams($post);
        $files = $_FILES;

        if( empty($post['eMapX']) || empty($post['eMapY']) )
        {
            $errors [] = " You must select POI point to the map to continue your action";
            $res = false;
        }

        if( empty($errors) )
        {
            /**
             * check what type of operation
             */
            if( isset($_POST['id']) )
            {
                $sql = " UPDATE pic_tbl
                    SET 
                        pic_menu_position = '{$post['pic_menu_position']}',
                        pic_name = '{$post['pic_name']}',
                        pic_voicescript = '{$post['pic_voicescript']}',
                        pic_map_x = '{$post['eMapX']}',
                        pic_map_y = '{$post['eMapY']}',
                        category_id = '{$post['category_id']}'

                        WHERE id = '{$post['id']}'
                    ";
                $res = mysqli_query($connection , $sql);

                if($res) 
                    $message = " POI updated successfully ";

                $poi_id = $_POST['id'];
            }else
            {
                //do-create
                $sql = " INSERT INTO pic_tbl(pic_menu_position , pic_name , pic_voicescript ,pic_map_x , pic_map_y,category_id)VALUES";
                $sql .= "
                    (
                    '{$post['pic_menu_position']}' ,
                    '{$post['pic_name']}',
                    '{$post['pic_voicescript']}',
                    '{$post['eMapX']}',
                    '{$post['eMapY']}',
                    '{$post['category_id']}'
                    )
                ";
                $res = mysqli_query($connection , $sql);

                if($res) {
                    $message = " POI created successfully ";
                    $action_type = 'insert';
                }
                    
                $poi_id = mysqli_insert_id($connection);
            }

            orderMaker($post['pic_menu_position']);

            /**
             * IMPORTING VOICE 
             */
            $poi_voice_link = $files['pic_voicelink'];

            if( $poi_voice_link['size'] > 0 ) 
            {
                //upload something
                $file_type =  strtolower($poi_voice_link['type']);
                $file_name = cleanParams($poi_voice_link['name']);

                if( !in_array($file_type , ['mp3' , 'wav']) ) {
                    //fire-error
                }
                $is_ok = move_uploaded_file($poi_voice_link['tmp_name'] , '../../server/vrMusic/'.$poi_voice_link['name']);
                
                if($is_ok) {
                    //insert or update to database
                    $sql = " UPDATE pic_tbl SET pic_voicelink = '{$file_name}'
                        WHERE id = '{$poi_id}' ";
                    $res = mysqli_query($connection , $sql);

                    if($res) 
                        $message .= " POI music has been uploaded successfully ";
                }
            }


            /**
             * IMPORTING PICTURES
             */

            $poi_pic_items = $files['poi_pic_items'];

            if( sizeof($poi_pic_items['name']) < 5 ){
                //throw error
            }

            $is_default_bg = true;
            $upload = 0;
            $allowedImageExtensions = ['png','jpg','bitmap','jpeg','image/jpeg' , 'image/png'];

            $sql = "SELECT * FROM poi_image_galleries where poi_id = '{$poi_id}'";
            $images = mysqli_query($connection , $sql);
            $images = mysqli_fetch_object($images);

            foreach($poi_pic_items['name'] as $key => $file_name) 
            {
                $size = $poi_pic_items['size'][$key];
                $tmp_name = $poi_pic_items['tmp_name'][$key];
                $type = $poi_pic_items['type'][$key];

                if( $size < 1 )
                    continue;

                if( !in_array($type , $allowedImageExtensions) )
                {
                    $message .= "{$file_name} extension is invalid '{$type}' only (".implode(',' , $allowedImageExtensions).") is allowed to be uploaded.";
                    $res = false;
                    break;
                }else
                {
                    $file_name = "poi_{$poi_id}{$file_name}";
                    $is_ok = move_uploaded_file($tmp_name , '../../server/vrGallery/'.$file_name);
                    
                    if($is_ok) 
                        $upload++;

                    //if first upload
                    if($images) {
                        $is_default_bg = false;
                    }else{
                        $is_default_bg = $upload == 1 ? true : false;
                    }
                    
                    $sql = " INSERT INTO poi_image_galleries(poi_id , file_name , is_default_bg) VALUES";
                    $sql .= "('{$poi_id}' , '{$file_name}' , '{$is_default_bg}')";

                    
                    $res = mysqli_query($connection , $sql);

                    if($res) 
                        $message .= " POI gallery has been uploaded successfully ";
                }

                
            }
        }else{
            $message = implode(',' , $errors);
        }
    }

    if( isset($_GET['id']) )
    {
        require_once '../../server/vrClass/PointOfInterest.php';
        $pointOfInterest= new PointOfInterest($connection);
        $poi = $pointOfInterest->get($_GET['id']);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <?php TMP_MSG($res , $message) ?>
    <?php if( isset($_GET['id']) && !empty($_GET['id'])) :?>
        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']?>">
    <?php endif?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row form-group">
                                <div class="col-md-8">
                                    <label for="#" class="text-dark">POI Name</label>
                                    <input type="text" class="form-control" name="pic_name" value="<?php echo $poi->pic_name ?? ''?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="#" class="text-dark">Order</label>
                                    <input type="number" class="form-control" name="pic_menu_position" value="<?php echo $poi->pic_menu_position ?? $recentOrder?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="#">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">NA</option>
                                    <?php foreach($categories as $key => $row) :?>
                                        <option value="<?php echo $row->id?>"
                                            <?php echo ($poi->category_id ?? '') == $row->id ? 'selected' : '' ?>><?php echo $row->category_name?> POS ( <?php echo $row->poi_order ?>) </option>
                                    <?php endforeach?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="#">Text to Speech</label>
                                <textarea id="" cols="30" rows="10" class="form-control" name="pic_voicescript"><?php echo $poi->pic_voicescript ?? ''?></textarea>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="#">Voice Over</label>
                                    <input type="file" class="form-control" name="pic_voicelink">
                                </div>

                                <div class="col-md-6">
                                    <label for="#">Gallery</label>
                                    <input type="file" class="form-control" name="poi_pic_items[]" multiple>
                                    <small>First Picture Will be The Default Picture</small>
                                </div>
                            </div>
                        </div>
                        <?php if( isset($poi) ) :?>
                        <div class="col-md-7">
                            <?php if( $poi->pic_voicelink ) :?>
                            <small>Text To Speech Will not work if there is voice-over</small>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Voice Over</td>
                                    <td><?php echo $poi->pic_voicelink?></td>
                                    <td style="width: 15%;"> <a href="<?php echo $_SERVER['REQUEST_URI']?>&action=delete_music">Delete</a></td>
                                </tr>
                            </table>
                            <?php endif?>
                            <h3>Gallery</h3>
                            <?php foreach($poi->images as $key => $row) :?>
                                <div style="display: inline-block;">
                                    <div>
                                        <img src="<?php echo '../../server/vrGallery/'.$row->file_name?>" alt=""
                                        style="width:250px">
                                    </div>
                                    <?php if( !$row->is_default_bg) :?>
                                        <a href="<?php echo $_SERVER['REQUEST_URI']?>&action=set_default_image&img_id=<?php echo $row->id?>">Set as Default</a>  &nbsp; | 
                                    <?php endif?>
                                    <a href="<?php echo $_SERVER['REQUEST_URI']?>&action=delete_image&img_id=<?php echo $row->id?>">Delete</a>
                                </div>
                            <?php endforeach?>
                        </div>
                        <?php endif?>
                    </div>

                    <!-- MAP LOCATOR -->
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-lg-12 bg-white d-flex justify-content-center">
                            <div id="maps" style="position: relative; min-width: 1200px !important; min-height: 600px !important; max-width: 1200px !important; max-height: 600px !important;">
                                <img src="../assets/images/map.png" width="1200px" height="600px">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <h4 class="text-danger"><B>Note:</b> Please pin the location of POI on the map</h4>
                        </div>
                    </div>
                    <div class="row" style="display: none">
                        <div class="col-lg-12 bg-white">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-dark" for="uname">x</label>
                                            <input class="form-control" id="eMapX" name="eMapX" type="text" value="<?php echo $poiArr[0]->pic_map_x ?? '' ?>"
                                                >
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-dark" for="uname">y</label>
                                            <input class="form-control" id="eMapY" name="eMapY" type="text" value="<?php echo $poiArr[0]->pic_map_y ?? '' ?>"
                                                >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary btn-sm" value="Save POI" name="btn_save_poi">
                    <?php if( isset($poi) ) :?>
                        <a href="server/vrpoidelete.php?id=<?php echo $poi->id?>" class="btn btn-danger btn-sm">Delete</a>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php TMP_FOOTER()?>

<script>

document.getElementById('maps').onclick = function clickEvent(e) {
    // e = Mouse click event.
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left; //x position within the element.
    var y = e.clientY - rect.top;  //y position within the element.
    loadMarker(x , y);
}
// Load existing marker

<?php if( isset($poi)) :?>
    loadMarker(<?php echo $poi->pic_map_x; ?>, <?php echo $poi->pic_map_y; ?>);
<?php endif?>
function loadMarker(mapx, mapy)
{
    var x = mapx;
    var y = mapy;

    $(".marker").remove();      // remove all existing markers
    $("#maps").append(            
        $('<div class="marker"></div>').css({       // include a class
            position: 'absolute',
            top: (y - 70) + 'px',
            left: (x - 25) + 'px',
            width: '50px',
            height: '70px',
            "background-image": "url('../assets/images/pinmap.png')",
            "background-repeat": "stretch",
            "background-size": "cover",
        })              
    );

    $("#eMapX").val(x);
    $("#eMapY").val(y);
}
</script>

<?php
    function orderMaker( $order = null )
    {
        global $connection;
        //fetch latest order
        if( is_null($order) ) {

            $sql = " SELECT pic_menu_position FROM pic_tbl
                ORDER BY pic_menu_position desc LIMIT 1";
            $query = mysqli_query($connection , $sql);
            $order = mysqli_fetch_object($query);

            $order_position = $order->pic_menu_position;
            if( is_null($order_position) )
                return 1;

            return $order_position + 1;
        }

        /**
         * there is already order 5 and user entered 3 then poi-cat should be adjusted
         */
        $greaterPOIS = [];
        
        $sql = "SELECT * FROM pic_tbl
            WHERE pic_menu_position >= '{$order}'";
        $query = mysqli_query($connection , $sql);

        while($poi_position  = mysqli_fetch_object($query) ) {
            $greaterPOIS [] = $poi_position;
        }

        if( $greaterPOIS ) 
        {
            $newOrder = $order;
            foreach($greaterPOIS as $key => $row) 
            {
                $newOrder++;
                $sql = " UPDATE pic_tbl set pic_menu_position = '{$newOrder}'
                    WHERE id = '{$row->id}' ";
                $query = mysqli_query($connection , $sql);
            }
        }
    }
?>
<?php TMP_CLOSE()?>