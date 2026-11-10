<?php
class safe{
    static function string($str){
        $str = (string) $str;
        $str = trim($str);
		$str = str_replace(array('\\', '\'', '"', '<', '>', '[/url]', '[url]', '[img]', '[/img]', '[/URL]', '[URL]', '[IMG]', '[/IMG]', '[url=', ' '), "", $str);
		$str = htmlentities($str ,  ENT_QUOTES |ENT_IGNORE, 'UTF-8');
        $str = html_entity_decode($str, ENT_COMPAT | ENT_XHTML, 'utf-8');
		if(preg_match('/\[url\]|\[img\]/i', $str)){
			return false;
		}
        return($str);
    }
    static function number($num){
        $num = (string) $num;
        preg_match_all('!\d+!', $num, $matches);
        return(isset($matches[0][0]) ? $matches[0][0] : '');
    }
    static function date($str){
        $str = (string) $str;
        $str = trim($str);
        return(preg_match('/(\d{4})\/(\d{2})\/(\d{2})/', $str, $matches) ? array('year' => $matches[1],'month' => $matches[2],'day' => $matches[3]) :  '');
    }
    static function is_date($str){
        
    }
    static function url($str){
        $str = (string) $str;
        $str = trim($str);
        $str = str_replace(array('\\', '\'', '"', '<', '>'), "", $str);
        return($str);
    }
    static function is_email($address){
        $address = (string) $address;
        return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
    }
    static function latin($str){
        $str = (string) $str;
        $str = trim($str);
        return preg_replace('/([^a|^b|^c|^d|^e|^f|^g|^h|^i|^j|^k|^l|^m|^n|^o|^p|^q|^r|^s|^t|^u|^v|^w|^x|^y|^z|^.|^1|^2|^3|^4|^5|^6|^7|^8|^9])/', '', $str);
    }
    static function is_md5($str){
        $str = (string) $str;
        return   preg_match('/^[a-f0-9]{32}$/', $str);
    }
    static function filename($str){
        $str = (string) $str;
        for($i=0;$i<=1000;$i++){
            $str=str_replace(array('../','./','\'','"','<','>'),'',$str);
        }
        if(preg_match('/\.\.\/|\.\/|\'|\"|\<|\>/i',$str)){
            return false;
        }
        return $str;
    }
    static function arrayString($array){
        foreach($array as $key=>$value){
            $array[$key] = self::string($value);
        }
        return($array);
    }
    static function arrayNumber($array){
        foreach($array as $key=>$value){
            $array[$key] = (int)self::number($value);
        }
        return($array);
    }
    static function hexColor($str){
        $str = self::string($str);
        if(substr($str, 0, 1) != '#')$str = '#'.$str;
        return(substr($str, 0, 7));
    }
    static function bool($value){
        if(is_string($value)){
            return $value == 'true';
        }elseif(is_int($value)){
            return $value > 0;
        }
    }
    static function is_cellphone($cellphone){
        $cellphone = (string) $cellphone;
        if((strlen($cellphone) == 11 and substr($cellphone, 0, 2) == '09') or (strlen($cellphone) == 13 and substr($cellphone, 0, 4) == '+989')){
            if(strlen($cellphone) == 11)$sub4 = substr($cellphone, 0, 4);//0913
            elseif(strlen($cellphone) == 13)$sub4 = '0'.substr($cellphone, 3, 3);//+98913
            $error = false;
            
            switch($sub4){
            	case('0910'):case('0911'):case('0912'):case('0913'):case('0914'):case('0915'):case('0916'):case('0917'):case('0918'):case('0919')://TCI
            	case('0932')://Taliya && Spadan
            	case('0934')://TKC
            	case('0901'):case('0902'):case('0930'):case('0933'):case('0935'):case('0936'):case('0937'):case('0938'):case('0939')://IranCell
            	case('0920'):case('0921')://RighTel
            		$error = false;
            		break;
            	default:
            		$error = true;
            		break;
            }
            return $error ? false:true;
        }else{
            return false;
        }
    }
}
?>