<?php

class antiDDos {

    static function start() {
        global $options, $giu;
        if ($giu[0] == 'ajax' and ($giu[1] == 'get' or strpos((string) ($giu[1] ?? ''), 'story.') === 0)) {
            return;
        }
        switch ($options['antiDDos_level']) {
            case('medium'):self::medium();
                break;
            case('hard'):self::hard();
                break;
        }
    }

    static function medium() {
        $time = time();
        if (session('last_session_request') > ($time - 5)) {
            $last_request_count = session('last_request_count');
            if (!$last_request_count) {
                session('last_request_count', 1);
            } elseif ($last_request_count < 5) {
                session('last_request_count', $last_request_count + 1);
            } elseif ($last_request_count >= 5) {
                header::to429();
                $theme = 'system';
                include("theme/$theme/antiddos.php");
                exit;
            }
        } else {
            session('last_request_count', 1);
        }
        session('last_session_request', $time);
    }

    static function fullread($sd, $len) {
        $ret = '';
        $read = 0;

        while ($read < $len && ($buf = fread($sd, $len - $read))) {
            $read += strlen($buf);
            $ret .= $buf;
        }

        return $ret;
    }

    static function hard() {
        global $options;
        $time = time();
        $filename = 'inc/ips.ahy';
        $file = file_get_contents($filename);
        ;
        $json = (array) json_decode($file);
        $founded = false;
        foreach ($json as $key => $value) {
            $value = (array) $value;
            $json[$key] = (array) $json[$key];
            //if()
            if ($value['lastrequest'] < ($time - 120)) {
                unset($json[$key]);
            }
            if ($value['ip'] == $_SERVER["REMOTE_ADDR"]) {
                if ($value['lastrequest'] > ($time - 5)) {
                    if ($value['count'] < 5) {
                        $json[$key]['count'] = $value['count'] + 1;
                    } elseif ($value['count'] >= 5) {
                        header::to429();
                        $theme = 'system';
                        include("theme/$theme/antiddos.php");
                        exit;
                    }
                } else {
                    $json[$key]['count'] = 1;
                }
                $json[$key]['lastrequest'] = time();
                $founded = true;
            }
        }
        if ($founded == false) {
            $json[] = array('ip' => $_SERVER["REMOTE_ADDR"], "lastrequest" => $time, 'count' => 1);
        }
        file_put_contents($filename, json_encode($json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
    }

}

?>