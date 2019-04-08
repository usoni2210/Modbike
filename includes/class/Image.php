<?php
    /**
     * Created by PhpStorm.
     * User: Umesh
     * Date: 19-02-2019
     * Time: 12:01 AM
     */

    class Image {
        private $id;
        private $name;
        private $fileName;
        private $email;
        public $is_disable = false;

        public static function getInstanceByResultSet($result){
            $obj = null;
            if($result->num_rows > 0){
                foreach ($result as $res) {
                    $instance = new self();
                    $instance->id = $res['image_id'];
                    $instance->name = $res['image_name'];
                    $instance->fileName = $res['file_name'];
                    $instance->email = $res['make_private'] ? "Anonymous" : $res['email_id'];
                    if(isset($res['disable_by']))
                        $instance->is_disable = !empty($res['disable_by']);
                    $obj[] = $instance;
                }
            }
            return $obj;
        }

        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return mixed
         */
        public function getFileName() {
            return $this->fileName;
        }

        /**
         * @return mixed
         */
        public function getEmail() {
            return $this->email;
        }
    }