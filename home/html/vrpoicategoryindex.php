<?php include_once('config/config.php')?>
<?php
    if( isset($_GET['action']) )
    {
        $sql = " DELETE FROM poi_categories where id = '{$_GET['cat_id']}' ";
        mysqli_query($connection , $sql);
    }

    $sql = " SELECT * FROM poi_categories ORDER BY poi_order asc ";
    $query = mysqli_query($connection , $sql);
    $categories = [];
    while($poi_cat = mysqli_fetch_object($query) ) {
        $categories[] = $poi_cat;
    }
?>
<?php TMP_HEAD(); ?>
    <div class="card">
        <div class="card-body">
            <h2>Categories</h2>
            <br>
            <a href="vrpoicategorycreate.php" class="btn waves-effect waves-light btn-primary"><i class="fas fa-plus"></i>  Add Category </a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered"  id="default_order">
                    <thead>
                        <th>Category name</th>
                        <th>Order</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($categories as $key => $row) :?>
                            <tr>
                                <td><?php echo $row->category_name?></td>
                                <td><?php echo $row->poi_order?></td>
                                <td>
                                    <a href="vrpoicategorycreate.php?id=<?php echo $row->id?>" class="btn btn-primary btn-sm">Edit</a>
                                    &nbsp;
                                    <a href="vrpoicategoryindex.php?action=delete&cat_id=<?php echo $row->id?>" class="btn btn-danger btn-sm validatejs">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php TMP_FOOTER()?>
    <!-- scripts -->

    <script>
        $( document ).ready( function(){

            $('.validatejs').click(function(e){

                if( !confirm("Are you sure you want to delete this category?") )
                    e.preventDefault();
            })
        });
    </script>
<?php TMP_CLOSE()?>