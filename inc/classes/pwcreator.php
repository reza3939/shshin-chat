<?php

class pwcreator {

    static function start($length = 10, $number = true, $az = true, $AZ = true, $special = false) {
        $azChar = "abcdefghijklmnopqrstuvwxyz";
        $AZChar = strtoupper($azChar);
        $numberChar = "0123456789";
        $specialChar = ".-+=_,!@$#*%<>[]{}";
        $chars = "";
        if ($number)
            $chars .= $numberChar;
        if ($az)
            $chars .= $azChar;
        if ($AZ)
            $chars .= $AZChar;
        if ($special)
            $chars .= $specialChar;
        $len = strlen($chars);
        $pw = '';
        for ($i = 0; $i < $length; $i++)
            $pw .= substr($chars, rand(0, $len - 1), 1);
        $pw = str_shuffle($pw);
        return($pw);
    }

}

?>