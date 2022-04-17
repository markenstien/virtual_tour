<?php

    class PointOfInterest
    {   

        public $connection;

        private $tbl = 'pic_tbl';

        public function __construct( $connection )
        { 
            $this->connection = $connection;
        }

        public function getPoiArray( $params = [] )
        {
            $retVal = [];
            
            $where = null;
            $order = null;

            if( isset($params['where']) )
                $where = " WHERE {$params['where']}";

            if( isset($params['order']) )
                $where = " ORDER BY {$params['order']}";

            $sql = "
                SELECT poi.* , poic.category_name as cat_name ,
                    poic.poi_order as poi_order 
                    FROM {$this->tbl} as poi 
                    LEFT JOIN poi_categories as poic
                    ON poi.category_id = poic.id
                    {$where} {$order}
            ";
            
            $connection = $this->connection;
            $fetchQuery = mysqli_query($connection, $sql);


            while($pois = mysqli_fetch_object($fetchQuery))
            {
                $pois->images = $this->getImages([
                    'where' => " poi_id = '{$pois->id}'",
                    'order' => " is_default_bg desc"
                ]);

                array_push($retVal , $pois);
            }
            $this->currentPoiList = $retVal;
            return $retVal;
        }

        public function getImages( $params = [])
        {
            if( !isset( $this->poiImageGallery) ) {
                require_once 'PointOfInterestGallery.php';
                $this->poiImageGallery = new PointOfInterestGallery( $this->connection );
            }

            return $this->poiImageGallery->getImages($params);
        }


        public function get($id)
        {
            $poi = $this->getPoiArray([
                'where' => "poi.id = '{$id}'"
            ]);

            if( $poi )
                return $poi[0];
            return $poi;
        }

        /**
         * fetch from current query
         */
        public function getCurrentList($id)
        {
            $retVal = false;
            if( isset($this->currentPoiList) ) {
                foreach( $this->currentPoiList as $key => $row ) {
                    if( $row->id == $id) {
                        $retVal = $row;
                        break;
                    }
                }
            }

            return $retVal;
        }
    }