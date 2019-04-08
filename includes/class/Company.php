<?php

    class Company{
        private $id;
        private $name;
        private $logoFile;

        /*
         * Company Constructor.
         */
        public  function __construct() {
            $this->id = null;
            $this->name = null;
            $this->logoFile = null;
        }

        /**
         * @param $result
         * @return Shop[]
         */
        public static function getInstanceByResultSet($result) {
            $obj = null;
            if($result->num_rows > 0){
                foreach ($result as $res) {
                    $instance = new self();
                    $instance->id = $res['id'];
                    $instance->name = $res['comp_name'];
                    $instance->logoFile = $res['logo_file'];
                    $obj[] = $instance;
                }
            }
            return $obj;
        }

        /**
         * @return null
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @return null
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return null
         */
        public function getLogoFile() {
            return $this->logoFile;
        }
    }