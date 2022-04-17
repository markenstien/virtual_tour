<?php
    include("../config/config.php");

    $post = $_POST['id'];
    $sql = "DELETE FROM pic_tbl WHERE id = '{$_GET['id']}'";

    $res = mysqli_query($connection , $sql);
    return header("Location:{$url}/vrpoi.php");
?>