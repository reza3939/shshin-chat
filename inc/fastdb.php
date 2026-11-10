<?php
/*
<--
* @author MahdiLotfi(FastDeveloper.ir)
* @copyright 2019
* @Phone (09029032526)
-->
*/
define('REDIS_CONNECTION', 'localhost');
define('REDIS_CONNECTION_PORT', 6379);
define('REDIS_DB', 1);
define('REDIS_AUTH', '');
define('REDIS_LOG_FILE', 'inc/fastdeveloper/logs/redis.txt');
class redisDB {
    private $Isconnction = false;
	private function connction() {
        if (class_exists('Redis')) {
            try {
                $this->db = new Redis();
                $this->db->connect(REDIS_CONNECTION, REDIS_CONNECTION_PORT);
                if (defined('REDIS_AUTH'))
                $this->db->auth(REDIS_AUTH);
                $this->db->select(REDIS_DB);
                $this->db->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
                $this->db->setOption(Redis::OPT_SCAN, Redis::SCAN_NORETRY);
                $this->Isconnction = true;
            }
            catch (RedisException $e) {
                $line = trim(date("[d/m @ H:i:s]") . "Redis connect Error: " . $e->getMessage()) . "\n";
                error_log($line, 3, REDIS_LOG_FILE);
                return false;
            }
        }
    }
    function __construct() {
        if (!$this->Isconnction) {
             $this->connction();
        }
    }
    function __destruct() {
        unset($this->db);
        $this->Isconnction = false;
    }
    function close() {
     if ($this->Isconnction) {
         $this->db->close();
         $this->db = null;
         $this->Isconnction = false;
       }
     }
    function string($str) {
        $str = trim($str);
        $str = str_replace(array('\\', '\'', '"', '<', '>', '[/url]', '[url]', '[img]', '[/img]', '[/URL]', '[URL]', '[IMG]', '[/IMG]', '[url=', ' '), "", $str);
        $str = htmlentities($str, ENT_QUOTES | ENT_IGNORE, 'UTF-8');
        $str = html_entity_decode($str, ENT_COMPAT | ENT_XHTML, 'utf-8');
        if (preg_match('/\[url\]|\[img\]/i', $str)) {
            return false;
        }
        return ($str);
    }
    function status() {
        return ($this->Isconnction && $this->db->ping() == '+PONG') ? 'IS SERVER REDIS RUN' : false;
    }
	function exists($key) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        return $this->db->exists($key) ? true : false;
    }
    function del($key) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        return $this->db->del($key);
    }
    function get($key) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        $key = $this->string($key);
        return json_decode($this->db->get($key));
    }
    function set($key, $value) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        $key = $this->string($key);
        $value = $this->string($value);
        return $this->db->set($key, json_encode($value));
    }
    function hgetall($hash_key) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        $hash_key = $this->string($hash_key);
        $object = $this->db->hgetall($hash_key);
        foreach ($object as $key => $value) {
            $object[$key] = json_decode($value);
        }
        return $object;
    }
    function hget($hash_key, $field) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        $hash_key = $this->string($hash_key);
        $field = $this->string($field);
        return json_decode($this->db->hget($hash_key, $field));
    }
    function hmset($hash_key, $field_value_array = array()) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        foreach ($field_value_array as $key => $value) {
            $hash_key = $this->string($hash_key);
            $key = $this->string($key);
            //$value = $this->string($value);
            $this->hset($hash_key, $key, $value);
        }
        return;
    }
    function hset($hash_key, $field, $value) {
		if (!$this->Isconnction) {
             $this->connction();
        }
        $hash_key = $this->string($hash_key);
        $field = $this->string($field);
        //$value = $this->string($value);
        return $this->db->hset($hash_key, $field, json_encode($value));
    }
}
?>