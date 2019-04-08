<?php

    class Feedback {
        private $id;
        private $name;
        private $email;
        private $subject;
        private $message;
        private $uploadDate;
        public $isViewed;

        public static function getInstanceByResultSet($result){
            $obj = null;
            if($result->num_rows > 0){
                foreach ($result as $res) {
                    $instance = new self();
                    $instance->id = $res['id'];
                    $instance->name = $res['name'];
                    $instance->email = $res['email'];
                    $instance->subject = $res['subject'];
                    $instance->message = $res['message'];
                    $instance->uploadDate = date("d-M-Y h:i:s A", strtotime($res['upload_date']));
                    $instance->isViewed = $res['is_view'] == 1;
                    $obj[] = $instance;
                }
            }
            return $obj;
        }

        public static function getInstanceOfFeedback($result){
            $instance = new self();
            if($result->num_rows > 0){
                foreach ($result as $res) {
                    $instance->id = $res['id'];
                    $instance->name = $res['name'];
                    $instance->email = $res['email'];
                    $instance->subject = $res['subject'];
                    $instance->message = $res['message'];
                    $instance->uploadDate = date("d-M-Y h:i:s A", strtotime($res['upload_date']));
                    $instance->isViewed = $res['is_view'] == 1;

                }
            }
            return $instance;
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
        public function getEmail() {
            return $this->email;
        }

        /**
         * @return mixed
         */
        public function getSubject() {
            return $this->subject;
        }

        /**
         * @return mixed
         */
        public function getMessage() {
            return $this->message;
        }

        /**
         * @return mixed
         */
        public function getUploadDate() {
            return $this->uploadDate;
        }
    }