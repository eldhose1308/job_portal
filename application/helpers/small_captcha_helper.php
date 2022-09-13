<?php


function createCaptchaImage($captcha_code = 1234)
    {
        $img_path = './captcha/';
        $expiration = 240;
        $length    = strlen($captcha_code);
        $img_height = 28;
        $img_width = 72;
        $angle    = ($length >= 6) ? mt_rand(- ($length - 6), ($length - 6)) : 0;
        
        $grid = 5333134;
        // -----------------------------------
        // Remove old images
        // -----------------------------------

        $now = microtime(TRUE);

        $current_dir = @opendir($img_path);
        while ($filename = @readdir($current_dir)) {
            if (
                in_array(substr($filename, -4), array('.jpg', '.png'))
                && (str_replace(array('.jpg', '.png'), '', $filename) + $expiration) < $now
            ) {
                @unlink($img_path . $filename);
            }
        }

        @closedir($current_dir);



        $target_layer = imagecreatetruecolor($img_width, $img_height);
        $captcha_background = imagecolorallocate($target_layer, 233, 236, 239);

        $x_axis    = mt_rand(6, (360 / $length) - 16);
        $y_axis = ($angle >= 0) ? mt_rand($img_height, $img_width) : mt_rand(6, $img_height);





        imagefill($target_layer, 0, 0, $captcha_background);
        $captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
        imagestring($target_layer, 5, 10, 5, $captcha_code, $captcha_text_color);

        $imageData = $target_layer;

        // -------------------
        // Make background pattern
        // -----------------------------------

        $theta        = 1;
        $thetac        = 7;
        $radius        = 16;
        $circles    = 20;
        $points        = 32;

        for ($i = 0, $cp = ($circles * $points) - 1; $i < $cp; $i++) {
            $theta += $thetac;
            $rad = $radius * ($i / $points);
            $x = ($rad * cos($theta)) + $x_axis;
            $y = ($rad * sin($theta)) + $y_axis;
            $theta += $thetac;
            $rad1 = $radius * (($i + 1) / $points);
            $x1 = ($rad1 * cos($theta)) + $x_axis;
            $y1 = ($rad1 * sin($theta)) + $y_axis;
            imageline($imageData, $x, $y, $x1, $y1, $grid);
            $theta -= $thetac;
        }


        if (function_exists('imagepng')) {
            $img_filename = $now . '.png';
            imagepng($imageData, $img_path . $img_filename);
        } elseif (function_exists('imagejpeg')) {
            $img_filename = $now . '.jpg';
            imagejpeg($imageData, $img_path . $img_filename);
        }

        $img = $img_path. $img_filename;
        $img = str_replace('./','',$img);
        $img = base_url(). $img;

        $img_tag = '<img src="'.$img.'" alt="Captcha" />';
        return $img_tag;
    }

    ?>