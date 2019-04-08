<?php

    class PartCategory {
        private $id;
        private $name;
        private $tableName;

        /*
         * PartCategory Constructor.
         */
        public  function __construct() {
            $this->id = null;
            $this->name = null;
            $this->tableName = null;
        }

        /**
         * @param $result
         * @return PartCategory[]
         */
        public static function getInstanceByResultSet($result) {
            $obj = null;
            if($result->num_rows > 0){
                foreach ($result as $res) {
                    $instance = new self();
                    $instance->id = $res['id'];
                    $instance->name = $res['cat_name'];
                    $instance->tableName = $res['table_name'];
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
         * @return mixed
         */
        public function getTableName() {
            return $this->tableName;
        }
    }