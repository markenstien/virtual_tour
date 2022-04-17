<?php 

    class PointOfInterestGallery
    {   

        public $connection;
        private $tbl = 'poi_image_galleries';

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getImages($params = [])
        {
            $retVal = [];

            $where = null;
            $order = null;

            if( isset($params['where']) )
                $where = " WHERE {$params['where']}";

            if( isset($params['order']) )
                $order = " ORDER BY {$params['order']}";


            $sql = "
                SELECT * FROM {$this->tbl} {$where} {$order}
            ";

            $fetchQuery = mysqli_query($this->connection , $sql);

            while($pois = mysqli_fetch_object($fetchQuery))
            {
                //get image-gallery
                array_push($retVal , $pois);
            }

            return $retVal;
        }
    }