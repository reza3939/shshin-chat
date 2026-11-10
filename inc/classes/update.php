<?php
class update{
    static function check(){
        global $options,$site_url;
        //include('inc/classes/file.php');
        error_reporting(0);
        if(substr($options['updateserver'], strlen($options['updateserver'])-1) != '/')$options['updateserver'] .='/';
        $q = http_build_query(array('dbname'=>db_name,'chatroom'=>$site_url[0],'password'=>$options['updatePassword']));
        if($serverRespond = file_get_contents($options['updateserver'].'?'.$q)){
            $serverRespond = explode("\n", $serverRespond);
            foreach($serverRespond as $line){
                $line = explode(' ', $line);
                if($line[0] == 'noNewVersion'){
                    return false;;
                }elseif($line[0] == 'newversion'){
                    return true;
                }else{
                    break;
                }
                return false;
            }
            
        }
    }
}
?>