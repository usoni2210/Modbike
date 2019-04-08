<?php

class Shop{
    private $id;
    private $name;
    private $owner;
    private $phone;
    private $image;
    private $addr_fline;
    private $addr_sline;
    private $city;
    private $state;
    private $pin_code;

    /*
     * Shop constructor.
     */
    public  function __construct() {
        $this->id = null;
        $this->name = null;
        $this->owner = null;
        $this->phone = null;
        $this->image = null;
        $this->addr_fline = null;
        $this->addr_sline = null;
        $this->city = null;
        $this->state = null;
        $this->pin_code = null;
    }

    /**
     * @param mysqli_result $result
     * @return Shop[]
     */
    public static function getInstanceByResultSet($result) {
        $obj = null;
        if($result->num_rows > 0){
            foreach ($result as $res) {
                $instance = new self();
                $instance->id = $res['id'];
                $instance->name = $res['name'];
                $instance->owner = $res['owner'];
                $instance->phone = $res['phone_no'];
                $instance->image = $res['image'];
                $instance->addr_fline = $res['addr_fline'];
                $instance->addr_sline = $res['addr_sline'];
                $instance->city = $res['city'];
                $instance->state = $res['state'];
                $instance->pin_code = $res['pin_code'];
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
     * @return null
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return null
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @return null
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @return null
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @return null
     */
    public function getAddrFline() {
        return $this->addr_fline;
    }

    /**
     * @return null
     */
    public function getAddrSline() {
        return $this->addr_sline;
    }

    /**
     * @return null
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @return null
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @return null
     */
    public function getPinCode() {
        return $this->pin_code;
    }
}