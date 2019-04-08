<?php
    function removeExt($path){
        $basename = basename($path);
        return strpos($basename, '.') === false ? $path : substr($path, 0, - strlen($basename) + strlen(explode('.', $basename)[0]));
    }

    function createThumb($image,$file_ext, $thumbnail, $thumb_width, $thumb_height){
        list($width,$height) = getimagesize($image);
        $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
        switch($file_ext){
            case 'jpg':
                $source = imagecreatefromjpeg($image);
                break;
            case 'jpeg':
                $source = imagecreatefromjpeg($image);
                break;

            case 'png':
                $source = imagecreatefrompng($image);
                break;
            case 'gif':
                $source = imagecreatefromgif($image);
                break;
            default:
                $source = imagecreatefromjpeg($image);
        }

        imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
        switch($file_ext){
            case 'jpg' || 'jpeg':
                imagejpeg($thumb_create,$thumbnail,100);
                break;
            case 'png':
                imagepng($thumb_create,$thumbnail,100);
                break;

            case 'gif':
                imagegif($thumb_create,$thumbnail);
                break;
            default:
                imagejpeg($thumb_create,$thumbnail,100);
        }
    }

    function setCookies($user, $pass){
        setcookie("cookie_user", $user, time()+(30 * 24 * 60 * 60), "/");
        setcookie("cookie_pass", $pass, time()+(30 * 24 * 60 * 60), "/");
    }

    function deleteCookie(){
        setcookie("cookie_user", "", time() - 3600, "/");
        setcookie("cookie_pass", "", time() - 3600, "/");
    }