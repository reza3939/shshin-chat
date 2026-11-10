<?php
class WebRequest{
    static private $options = array('autoreferer' => true, 'referer'=> '','username' => '', 'password' => '', 'coockie' => true);
    private $referer = '';
    private $autoreferer = true;
    static function get($url){
        if(self::$options['coockie']){
            if(!Cookie::is_int()){Cookie::ReadFromFile();}
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url"); 
        if(self::$options['coockie']){
            curl_setopt($ch, CURLOPT_COOKIE, Cookie::export());
        }
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HEADER,true);
        curl_setopt($ch, CURLOPT_POST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
        if(self::$options['username'] != ''){
            curl_setopt($ch, CURLOPT_USERPWD, self::$options['username'].":".self::$options['password']);
        }
        if(self::$options['referer'] != '')curl_setopt($ch, CURLOPT_REFERER, self::$options['referer']);
        $result = curl_exec($ch);
        curl_close($ch);
        if(self::$options['autoreferer'] == true){
            self::$options['referer'] = $url;
        }
        list($headers,$content) = explode("\r\n\r\n",$result,2);
        if(self::$options['coockie']){
            self::splitCookies($headers);
        }
        return(array($headers, $content));
    }
    static function post($url, $data){
        if(self::$options['coockie']){
            if(!Cookie::is_int()){Cookie::ReadFromFile();}
        }
        if(is_array($data)){
            $data = http_build_query($data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if(self::$options['coockie']){
            curl_setopt($ch, CURLOPT_COOKIE, Cookie::export());
        }
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HEADER,true);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        if(self::$options['username'] != ''){
            curl_setopt($ch, CURLOPT_USERPWD, self::$options['username'].":".self::$options['password']);
        }
        if(strpos($url, 'https') !== false){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:23.0) Gecko/20100101 Firefox/23.0"); 
        if(self::$options['referer'] != '')curl_setopt($ch, CURLOPT_REFERER, self::$options['referer']);
        $result = curl_exec($ch);
        curl_close($ch);
        
        if(self::$options['autoreferer'] == true){
            self::$options['referer'] = $url;
        }
        $ex = explode("\r\n\r\n",$result,2);
        if(!isset($ex[1]))$ex[1] = false;
        if(self::$options['coockie']){
            self::splitCookies($ex[0]);
        }
        return($ex);
    }
    static function splitCookies($header){
        $headers = explode("\n", $header);
        foreach($headers as $r){
            if(substr($r, 0, 12) == "Set-Cookie: "){
                $thisc = substr($r, 12);
                $thisc = str_replace(array("\n", "\r"), "", $thisc);
                $thisc = explode(';', $thisc);
                $thisc = explode('=', $thisc[0]);
                if(self::$options['coockie']){
                    Cookie::NewCookie($thisc[0], $thisc[1]);
                }
            }
        }
    }
    static function SetOption($name, $value){
        $temp = self::$options;
        if(isset($temp[$name])){
            self::$options[$name] = $value;
        }
    }
}
?>
