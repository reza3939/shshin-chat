<?php

class ipbann {

    static function is_enable() {
        global $options;
        $bannwonrglogin = json_decode($options['bannwonrglogin'], true);
        return $bannwonrglogin['active'] == 'true' ? true : false;
    }

    static function check_bann() {
        global $options,$sql;
        $bann = false;
        $bannwonrglogin = json_decode($options['bannwonrglogin'], true);
        if ($bannwonrglogin['ipbann'] == true) {
            $ip = ip();
            $sql->where("ip", $ip);
            $sql->where("endtime", time(), '>');
            $sql->where("worngnum", $bannwonrglogin['numberworng'], '>=');
            if ($sql->has('ipbans')) {
               $bann = true;
            }
        }
        if ($bann != true) {
            if ($bannwonrglogin['cookiebann'] == true) {
                if (isset($_COOKIE['bannlogin'])) {
                    $cookie = safe::number($_COOKIE['bannlogin']);
                    if ($cookie >= $bannwonrglogin['numberworng']) {
                        $bann = true;
                    }
                }
            }
        }
        return $bann;
    }

    static function addworng() {
        global $options, $sql;
        $bannwonrglogin = json_decode($options['bannwonrglogin'], true);
        if ($bannwonrglogin['ipbann'] == true) {
            $sql->where("endtime", time(), '<');
            $sql->delete('ipbans');
            
            $ip = ip();
            $sql->where("ip", $ip);
            if ($bann = $sql->getOne('ipbans')) {
                $sql->where("ip", $ip);
                $sql->update("ipbans", array(
                    'endtime' => time() + $bannwonrglogin['banntime'],
                    'worngnum' => $sql->inc()
                ));
            } else {
                $sql->insert("ipbans", array(
                    'ip' => $ip,
                    'endtime' => time() + $bannwonrglogin['banntime'],
                    'worngnum' => 1
                ));
            }
        }
        if ($bannwonrglogin['cookiebann'] == true) {
            if (isset($_COOKIE['bannlogin'])) {
                $cookie = safe::number($_COOKIE['bannlogin']);
            } else {
                $cookie = 0;
            }
            setcookie('cookiebann', $cookie + 1, time() + $bannwonrglogin['banntime']);
        }
    }

    static function ErrorText() {
        global $options;
        $bannwonrglogin = json_decode($options['bannwonrglogin'], true);
        return ("شما برای {$bannwonrglogin['banntime']} ثانیه اجازه ورود ندارید");
    }

}
?>