<?php

class Admin{
    private $name;
    private $email;
    private $user;
    private $phone;
    private $image;
    private $update;

    /*
     * Admin constructor.
     */
    public  function __construct() {
        $this->name = null;
        $this->email = null;
        $this->user = null;
        $this->phone = null;
        $this->image = null;
        $this->update = null;
    }

    /**
     * @param $result
     * @return Admin
     */
    public static function getInstanceByResultSet($result) {
        $instance = new self();
        foreach ($result as $res) {
            $instance->name = $res['admin_name'];
            $instance->user = $res['admin_username'];
            $instance->email = $res['email_id'];
            $instance->phone = $res['phone_no'];
            $instance->image = $res['image'];
            $instance->update = $res['update_profile'];
        }
        return $instance;
    }

    public static function getInstanceByResultSetForBasicInfo($result){
        $instance = new self();
        foreach ($result as $res) {
            $instance->name = $res['admin_name'];
            $instance->image = $res['image'];
        }
        return $instance;
    }

    /**
     * @return null
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return null
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return null
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * @return null
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * @return null
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * @return null
     */
    public function getUpdate(){
        return $this->update;
    }
}