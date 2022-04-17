<?php include_once('config/config.php')?>

<?php
    $query = null;
    $message = '';
    if( isset($_POST['save_category']) )
    {
        $post = $_POST;

        if( isset($post['id']) )
        {
            $sql = " UPDATE poi_categories
                    SET category_name ='{$post['category_name']}',
                    poi_order = '{$post['poi_order']}'
                    WHERE id = '{$post['id']}' ";
            $query = mysqli_query($connection , $sql);
            $query = true;
            $message = "POI Updated";
            //do update
        }else
        {
            $sql = "INSERT INTO poi_categories(category_name , poi_order)
                VALUES('{$post['category_name']}' , '{$post['poi_order']}')";

            $query = mysqli_query($connection , $sql);

            $message = "POI Created";
        }
    }

    if( isset($_GET['id']) )
    {
        $sql = " SELECT * FROM poi_categories
            where id = '{$_GET['id']}' ";

        $query = mysqli_query($connection , $sql);
        $poi_category = mysqli_fetch_object($query);
        $query = true;
    }
    
?>
<?php TMP_HEAD(); ?>
    <div class="row container-fluid">
        <div class="col-6">
            <h3>POI Category</h3>
            <?php TMP_MSG($query , $message) ?>
            <form action="" method="post">
                <?php if( isset($poi_category) ) :?>
                    <input type="hidden" name="id" value="<?php echo $poi_category->id?>">
                <?php endif?>
                <div class="form-group">
                    <label for="#">Name</label>
                    <input type="text" name="category_name" class="form-control" value="<?php echo $poi_category->category_name ?? ''?>">
                </div>

                <div class="form-group">
                    <label for="#">Order</label>
                    <input type="number" name="poi_order" class="form-control" value="<?php echo $poi_category->poi_order ?? ''?>">
                </div>

                <input type="submit" class="btn btn-primary" value="Save Category" name="save_category">
            </form>
        </div>
    </div>
<?php TMP_FOOTER()?>
    <!-- scripts -->
<?php TMP_CLOSE()?>