<?php
require_once "config.php";
include "class/Admin.php";
include "class/Shop.php";
include "class/Image.php";
include "class/Feedback.php";
include "class/Company.php";
include "class/PartCategory.php";
include "function.php";

error_reporting(0);

class Connection{
    private $conn = null;
    public function __construct(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->conn->connect_error)
            header("location:/error.php?code=1001&msg=Database Connection Failed");
    }
    public function __destruct() {
        if($this->conn != null)
            $this->conn->close();
    }

    /*
    * Dashboard Functions
    */
    public function countNewImages() {
        $qry = "SELECT COUNT(*) FROM `images` WHERE approved_by IS NULL";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0];
    }
    public function countTotalParts() {
        $qry = "SELECT COUNT(*) FROM parts";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0];
    }
    public function countTotalShops() {
        $qry = "SELECT COUNT(*) FROM shoppes";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0];
    }
    public function countTotalBikes() {
        $qry = "SELECT COUNT(*) FROM `bikes`";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0];
    }

    /*
     * Admin Functions
     */
    public function validateAdmin($user, $pwd){
        $qry = "SELECT `admin_id`,`admin_name`,`image` FROM `admin` WHERE admin_username LIKE '$user' AND password LIKE '$pwd'";
        $result = $this->conn->query($qry);
        $id = null;
        if($result->num_rows == 1) {
            foreach ($result as $res)
                $id = $res['admin_id'];
        }
        return $id;
    }
    public function getBasicDetails($id){
        $qry = "SELECT `admin_name`,`image` FROM `admin` WHERE `admin_id` = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows == 1 ? Admin::getInstanceByResultSetForBasicInfo($res) : null;
    }
    public function getAdminDetails($id){
        $qry = "SELECT `admin_name`,`admin_username`,`email_id`,`phone_no`,`image`,`update_profile` FROM `admin` WHERE `admin_id` = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows == 1 ? Admin::getInstanceByResultSet($res) : null;
    }
    public function updateProfile($id, $name, $email, $phone){
        $qry = "UPDATE `admin` SET `admin_name` = '$name', `email_id` = '$email', `phone_no` = '$phone' WHERE `admin`.`admin_id` = $id";
        return $this->conn->query($qry) === TRUE;
    }
    public function updatePassword($id, $new, $old){
        $old = md5($old);
        $new = md5($new);
        $qry = "SELECT `admin_id` FROM `admin` WHERE `admin_id` LIKE '$id' AND `password` LIKE '$old'";
        if($this->conn->query($qry)){
            $qry2 = "UPDATE `admin` SET `password` = '$new' WHERE `admin`.`admin_id` = $id";
            return $this->conn->query($qry2);
        } else
            return false;
    }

    /*
     *  Image Functions
     */
    public function imageMaxPage() {
        $query = "SELECT COUNT(*) as count FROM `images` WHERE approved_by Is NOT NULL AND disable_by IS NULL";
        $result = $this->conn->query($query);
        foreach($result as $res)
            $max = (($res['count']-1) / MAX_IMAGE_ON_PAGE) + 1;
        settype($max, "integer");
        return $max;
    }
    public function getImages($page) {
        $start = MAX_IMAGE_ON_PAGE * ($page - 1);
        $qry = "SELECT `image_id`,`image_name`,`file_name`,`email_id`,`make_private` FROM `images` WHERE approved_by IS NOT NULL AND disable_by IS NULL LIMIT $start," .MAX_IMAGE_ON_PAGE;
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Image::getInstanceByResultSet($res) : null;
    }
    public function getImageFileName($id) {
        $qry = "SELECT `file_name` FROM `images` WHERE `image_id` = $id";
        $result = $this->conn->query($qry);
        $filename = "";
        foreach($result as $res)
            $filename = $res['file_name'];
        return $filename;
    }
    public function saveImage($image, $email, $private){
        $file = $image['name'];
        $filename_arr = explode(".",$file);
        $file_ext = $filename_arr[count($filename_arr)-1];
        $name = removeExt($file);

        $qry = "INSERT INTO `images` (`image_name`, `file_name`, `email_id`, `make_private`, `upload_date`) VALUES ('$name', NULL, '$email', '$private', CURRENT_TIMESTAMP)";

        if($this->conn->query($qry)) {
            $id = $this->conn->insert_id;
            $filename = $id . "." . $file_ext;
            $original_file = MODIFIED_BIKE_IMAGE_PATH . $filename;
            $thumb_file = MODIFIED_BIKE_THUMBNAIL_PATH . $filename;

            $update = "UPDATE `images` SET `file_name` = '$filename' WHERE `images`.`image_id` = $id";
            if ($this->conn->query($update)) {
                move_uploaded_file($image['tmp_name'],$original_file);
                createThumb($original_file, $file_ext, $thumb_file, 400, 300);
                return true;
            }else
                return false;
        }else {
            return false;
        }
    }
    public function getNewlyUploadedImages(){
        $qry = "SELECT `image_id`,`image_name`,`file_name`,`email_id`,`make_private` FROM `images` WHERE approved_by IS NULL";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Image::getInstanceByResultSet($res) : null;
    }
    public function getAllImages(){
        $qry = "SELECT `image_id`,`image_name`,`file_name`,`email_id`,`make_private`,`disable_by` FROM `images` WHERE approved_by IS NOT NULL";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Image::getInstanceByResultSet($res) : null;
    }
    public function allowImage($id, $aid){
        $update = "UPDATE `images` SET approved_by = '$aid' WHERE `images`.`image_id` = '$id'";
        return $this->conn->query($update);
    }
    public function deleteImage($id){
        $update = "DELETE FROM `images` WHERE `images`.`image_id` LIKE $id ";
        return $this->conn->query($update);
    }
    public function disableImage($id, $aid){
        $update = "UPDATE `images` SET `disable_by` = '$aid' WHERE `images`.`image_id` = '$id'";
        return $this->conn->query($update);
    }
    public function enableImage($id){
        $update = "UPDATE `images` SET `disable_by` = NULL WHERE `images`.`image_id` = '$id'";
        return $this->conn->query($update);
    }

    /*
     * Feedback Functions
     */
    public function saveFeedback($name, $email, $subject, $msg){
        $query = "INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`, `upload_date`, `is_view`) VALUES (NULL, '$name', '$email', '$subject', '$msg', CURRENT_TIMESTAMP, '0')";
        $this->conn->query($query);
        return $this->conn->affected_rows == 1;
    }
    public function getUnreadFeedbackCount(){
        $query = "SELECT * FROM `feedback` WHERE `is_view` = 0;";
        return $this->conn->query($query)->num_rows;
    }
    public function getFeedbackList(){
        $query = "SELECT * FROM feedback ORDER BY `upload_date` DESC;";
        $res = $this->conn->query($query);
        return $res->num_rows > 0 ? Feedback::getInstanceByResultSet($res) : null;
    }
    public function getFeedback($id) {
        $query = "SELECT * FROM feedback WHERE id LIKE $id";
        $res = $this->conn->query($query);
        return $res->num_rows == 1 ? Feedback::getInstanceOfFeedback($res) : null;
    }
    public function setFeedbackViewed($id) {
        $update = "UPDATE `feedback` SET `is_view` = '1' WHERE `feedback`.`id` = '$id'";
        return $this->conn->query($update);
    }
    public function deleteFeedback($id){
        $update = "DELETE FROM `feedback` WHERE `feedback`.`id` LIKE $id ";
        return $this->conn->query($update);
    }

    /*
     *  Shops Function
     */
    public function getShopList($city) {
        $qry = "SELECT `id`, `name`, `owner`, `phone_no`, `image`, `addr_fline`, `addr_sline`, `city`, `state` ,`pin_code` FROM shoppes WHERE `city` LIKE '$city'";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Shop::getInstanceByResultSet($res) : null;
    }
    public function getAllShop() {
        $qry = "SELECT `id`, `name`, `owner`, `phone_no`, `image`, `addr_fline`, `addr_sline`, `city`, `state` ,`pin_code` FROM shoppes";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Shop::getInstanceByResultSet($res) : null;
    }
    public function getShopInfo($id){
        $qry = "SELECT `id`, `name`, `owner`, `phone_no`, `image`, `addr_fline`, `addr_sline`, `city`, `state` ,`pin_code` FROM shoppes WHERE `id` LIKE $id";
        $result = $this->conn->query($qry);
        $shop = null;
        foreach($result as $res){
            $shop = $res;
        }
        return $shop;
    }
    public function getShopForPart($id){
        $qry = "SELECT `id`, `name`, `owner`, `phone_no`, `image`, `addr_fline`, `addr_sline`, `city`, `state` ,`pin_code` FROM `shoppes`, `shop_sales` WHERE `shop_sales`.`pid` LIKE $id AND `shop_sales`.`sid` = `shoppes`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Shop::getInstanceByResultSet($res) : null;
    }
    public function  getShopIdForPart($id){
        $qry = "SELECT `id` FROM `shoppes`, `shop_sales` WHERE `shop_sales`.`pid` LIKE $id AND `shop_sales`.`sid` = `shoppes`.`id`";
        $result = $this->conn->query($qry);
        $ids = Array();
        foreach($result as $res){
            $ids[] = $res['id'];
        }
        return count($ids) > 0 ? $ids : null;
    }
    public function getShopForParts($parts){
        $shoppes = $this->getShopIdForPart($parts[0]);
        foreach($parts as $id){
            $shop = $this->getShopIdForPart($id);
            $shoppes = array_intersect($shoppes, $shop);
        }
        return count($shoppes) > 0 ? $shoppes : null;
    }
    public function saveShop($shopImage, $ownerName, $contactNo, $shopName, $fLineAddr, $sLineAddr, $city, $state, $pinCode) {
        $file = $shopImage['name'];
        $filename_arr = explode(".",$file);
        $file_ext = $filename_arr[count($filename_arr)-1];

        $qry = "INSERT INTO shoppes (`name`, `owner`, `phone_no`, `addr_fline`, `addr_sline`, `city`, `state`, `pin_code`) VALUES ('$shopName', '$ownerName', '$contactNo', '$fLineAddr', '$sLineAddr', '$city', '$state', '$pinCode')";
        if($this->conn->query($qry)) {
            $id = $this->conn->insert_id;
            $filename = $id . "." . $file_ext;
            $original_file = SHOP_IMAGE_PATH . $filename;
            $update = "UPDATE shoppes SET `image` = '$filename' WHERE shoppes.`id` = $id";
            if ($this->conn->query($update)) {
                move_uploaded_file($shopImage['tmp_name'], $original_file);
                return true;
            } else
                return false;
        }
        else
            return  false;
    }
    public function getShopFileName($id) {
        $qry = "SELECT `image` FROM shoppes WHERE `id` = $id";
        $result = $this->conn->query($qry);
        $filename = "";
        foreach($result as $res)
            $filename = $res['image'];
        return $filename;
    }
    public function deleteShop($id){
        $update = "DELETE FROM `shoppes` WHERE `shoppes`.`id` LIKE $id ";
        return $this->conn->query($update);
    }

    /*
     *  Company Functions
     */
    public function getCompanyList(){
        $qry = "SELECT * FROM `company`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? Company::getInstanceByResultSet($res) : null;
    }
    public function saveCompany($companyName, $companyLogo) {
        $file = $companyLogo['name'];
        $filename_arr = explode(".",$file);
        $file_ext = $filename_arr[count($filename_arr)-1];

        $qry = "INSERT INTO `company` (comp_name) VALUES ('$companyName')";
        if($this->conn->query($qry)) {
            $id = $this->conn->insert_id;
            $filename = $id . "." . $file_ext;
            $original_file = COMPANY_LOGO_PATH . $filename;
            $update = "UPDATE `company` SET `logo_file` = '$filename' WHERE `company`.`id` = $id";

            if ($this->conn->query($update)) {
                move_uploaded_file($companyLogo['tmp_name'], $original_file);
                return true;
            } else
                return false;
        }
        else
            return  false;
    }
    public function getCompanyFileName($id){
        $qry = "SELECT `logo_file` FROM `company` WHERE `id` = $id";
        $result = $this->conn->query($qry);
        $filename = "";
        foreach($result as $res)
            $filename = $res['logo_file'];
        return $filename;
    }
    public function deleteCompany($id) {
        $update = "DELETE FROM `company` WHERE `company`.`id` LIKE $id ";
        return $this->conn->query($update);
    }

    /*
     *  Bikes Functions
     */
    public function saveBike($bikeName, $releaseYear, $bikeType, $companyId) {
        $query = "INSERT INTO `bikes` (`name`, `comp_id`, `type`, `release_year`) VALUES ('$bikeName', '$companyId', '$bikeType', '$releaseYear')";
        $this->conn->query($query);
        return $this->conn->affected_rows == 1;
    }
    public function getAllBike(){
        $qry = "SELECT b.id, b.name, b.release_year, b.type, c.comp_name FROM bikes b, company c WHERE b.comp_id = c.id ORDER BY release_year DESC";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function deleteBike($id) {
        $update = "DELETE FROM `bikes` WHERE `bikes`.`id` LIKE $id ";
        return $this->conn->query($update);
    }

    /*
     * Part Category Functions
     */
    public function getPartCategory() {
        $qry = "SELECT * FROM `part_category`";
        $res = $this->conn->query($qry);
        return PartCategory::getInstanceByResultSet($res);
    }
    public function getCategoryName($id){
        $qry = "SELECT `cat_name` FROM `part_category` WHERE id Like $id";
        $result = $this->conn->query($qry);
        $name = null;
        if($result->num_rows == 1) {
            foreach ($result as $res)
                $name = $res['cat_name'];
        }
        return $name;
    }
    public function getPartCategoryId($id){
        $qry = "SELECT `cid` FROM `parts` WHERE `id` LIKE  $id";
        $res = $this->conn->query($qry)->fetch_array();
        return $res[0];

    }

    /*
     * Part Functions
     */
    public function savePart($image, $name, $category, $price){
        $file = $image['name'];
        $filename_arr = explode(".",$file);
        $file_ext = $filename_arr[count($filename_arr)-1];

        $qry = "INSERT INTO parts(`name`, `cid`, `price`) VALUES ('$name','$category','$price')";
        if($this->conn->query($qry)) {
            $id = $this->conn->insert_id;
            $filename = $id . "." . $file_ext;
            $original_file = PARTS_IMAGE_PATH. $filename;

            $update = "UPDATE parts SET `image` = '$filename' WHERE `parts`.`id` = $id";
            if ($this->conn->query($update)) {
                move_uploaded_file($image['tmp_name'], $original_file);
                return $id;
            } else
                return 0;

        }else
            return 0;
    }
    public function saveSilencer($id, $weight, $dim, $mat){
        $qry = "INSERT INTO `tbl_silencer` (`id`, `weight`, `dimension`, `material`) VALUES ('$id', '$weight', '$dim', '$mat')";
        $this->conn->query($qry);
    }
    public function saveTailLight($id, $mat, $dim, $color){
        $qry = "INSERT INTO `tbl_tail_light` (`id`, `material`, `dimension`, `color`) VALUES ('$id', '$mat', '$dim', '$color')";
        $this->conn->query($qry);
    }
    public function saveFuelTank($id, $cap, $color){
        $qry = "INSERT INTO `tbl_fuel_tank` (`id`, `capacity`, `color`) VALUES ('$id', '$cap', '$color')";
        $this->conn->query($qry);
    }
    public function saveHeadLight($id, $mat, $dim, $color){
        $qry = "INSERT INTO `tbl_head_light` (`id`, `material`, `dimension`, `color`) VALUES ('$id', '$mat', '$dim', '$color')";
        $this->conn->query($qry);
    }
    public function saveSeat($id, $type, $mat, $color){
        $qry = "INSERT INTO `tbl_seat` (`id`, `type`, `material`, `color`) VALUES ('$id', '$type', '$mat', '$color')";
        $this->conn->query($qry);
    }
    public function getSilencerList(){
        $qry = "SELECT * FROM `parts`, `tbl_silencer` WHERE `parts`.id = `tbl_silencer`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getTailLightList(){
        $qry = "SELECT * FROM `parts`, `tbl_tail_light` WHERE `parts`.id = `tbl_tail_light`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getFuelTankList(){
        $qry = "SELECT * FROM `parts`, `tbl_fuel_tank` WHERE `parts`.id = `tbl_fuel_tank`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getHeadLightList(){
        $qry = "SELECT * FROM `parts`, `tbl_head_light` WHERE `parts`.id = `tbl_head_light`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getSeatList(){
        $qry = "SELECT * FROM `parts`, `tbl_seat` WHERE `parts`.id = `tbl_seat`.`id`";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getPartFileName($id){
        $qry = "SELECT `image` FROM `parts` WHERE `id` = $id";
        $result = $this->conn->query($qry);
        $filename = "";
        foreach($result as $res)
            $filename = $res['image'];
        return $filename;
    }
    public function deletePart($id) {
        $update = "DELETE FROM `parts` WHERE `parts`.`id` LIKE $id ";
        return $this->conn->query($update);
    }
    public function getPartBasicInfo($id){
        $qry = "SELECT name, image FROM `parts` WHERE `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows == 1 ? $res->fetch_array() : null;
    }

    /*
     *  Relation Function (Shop, Bike, Parts)
     */
    public function savePartHave($bid, $pid){
        $query = "INSERT INTO `bike_have` VALUES ($bid, $pid)";
        $this->conn->query($query);
        return $this->conn->affected_rows == 1;
    }
    public function savePartSupport($bid, $pid){
        $query = "INSERT INTO `part_support` VALUES ($bid, $pid)";
        $this->conn->query($query);
        return $this->conn->affected_rows == 1;
    }
    public function savePartSales($sid, $pid){
        $query = "INSERT INTO `shop_sales` VALUES ($sid, $pid)";
        $this->conn->query($query);
        return $this->conn->affected_rows == 1;
    }

    public function isRelationAvailable(){
        $qry = "SELECT COUNT(*) FROM `bike_have`";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0] != 0;
    }
    public function isPartSupport(){
        $qry = "SELECT COUNT(*) FROM `part_support`";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0] != 0;
    }
    public function isShopSales(){
        $qry = "SELECT COUNT(*) FROM `shop_sales`";
        $result = $this->conn->query($qry)->fetch_array();
        return $result[0] != 0;
    }

    public function getBikePartList($id){
        $qry = "SELECT p.id, p.name, c.cat_name FROM `parts` p,`part_category` c WHERE p.cid = c.id AND c.id NOT IN (SELECT p.cid FROM `parts` p,`bike_have` b WHERE p.id = b.pid && b.bid = $id) ORDER BY c.cat_name";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getShopPartList($id){
        $qry = "SELECT p.id, p.name, c.cat_name FROM `parts` p,`part_category` c WHERE p.cid = c.id AND p.id NOT IN (SELECT p.id FROM `parts` p,`shop_sales` s WHERE p.id = s.pid && s.sid = $id) ORDER BY c.cat_name";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getBikeUnSupportPart($id) {
        $qry = "SELECT p.id, p.name, c.cat_name FROM `parts` p,`part_category` c WHERE p.cid = c.id AND p.id NOT IN (SELECT p.id FROM `parts` p,`part_support` b WHERE p.id = b.pid && b.bid = $id) ORDER BY c.cat_name";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }

    public function getRelatedPart($id){
        $qry = "SELECT c.cat_name, p.name FROM `bike_have` b, `parts` p, `part_category` c WHERE b.bid = $id AND b.pid = p.id ANd p.cid = c.id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getBikeSupportedPart($id){
        $qry = "SELECT c.cat_name, p.name FROM `part_support` s, `parts` p, `part_category` c WHERE s.bid = $id AND s.pid = p.id ANd p.cid = c.id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getSellingPart($id){
        $qry = "SELECT c.cat_name, p.name FROM `shop_sales` s, `parts` p, `part_category` c WHERE s.sid = $id AND s.pid = p.id ANd p.cid = c.id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }

    public function deleteBikeRelation($id){
        $update = "DELETE FROM `bike_have` WHERE `bike_have`.`bid` LIKE $id ";
        return $this->conn->query($update);
    }
    public function deletePartSupport($id){
        $update = "DELETE FROM `part_support` WHERE `part_support`.`bid` LIKE $id ";
        return $this->conn->query($update);
    }
    public function deleteShopSelling($id){
        $update = "DELETE FROM `shop_sales` WHERE `shop_sales`.`sid` LIKE $id ";
        return $this->conn->query($update);
    }

    /*
     *  Find Part Functions
     */
    public function getBikeList($id){
        $qry = "SELECT b.id, b.name, b.release_year, b.type FROM bikes b WHERE b.comp_id = $id ORDER BY release_year DESC";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getBikeSupportedPartCategory($id){
        $qry = "SELECT c.id, c.cat_name FROM `part_support` s, `parts` p, `part_category` c, `shop_sales` ss WHERE s.bid = $id AND s.pid = p.id ANd p.cid = c.id AND ss.pid = p.id GROUP BY c.id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getBikePart($bid, $cid){
        $qry = "SELECT p.id FROM `parts` p, `part_support` ps, `shop_sales` s WHERE p.cid = $cid AND ps.bid = $bid AND p.id = ps.pid AND p.id = s.pid GROUP BY p.id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res : null;
    }
    public function getSilencerInfo($id){
        $qry = "SELECT * FROM `parts`, `tbl_silencer` WHERE `parts`.id = `tbl_silencer`.`id` AND  `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }
    public function getTailLightInfo($id){
        $qry = "SELECT * FROM `parts`, `tbl_tail_light` WHERE `parts`.id = `tbl_tail_light`.`id` AND  `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }
    public function getSeatInfo($id){
        $qry = "SELECT * FROM `parts`, `tbl_seat` WHERE `parts`.id = `tbl_seat`.`id` AND  `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }
    public function getHeadLightInfo($id){
        $qry = "SELECT * FROM `parts`, `tbl_head_light` WHERE `parts`.id = `tbl_head_light`.`id` AND  `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }
    public function getFuelTankInfo($id){
        $qry = "SELECT * FROM `parts`, `tbl_fuel_tank` WHERE `parts`.id = `tbl_fuel_tank`.`id` AND  `parts`.id = $id";
        $res = $this->conn->query($qry);
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }

}