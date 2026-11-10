<?php

class header {

    static function Go($url, $cache = false) {
        if ($cache == true) {
            header("HTTP/1.0 302 Moved Temporarily");
        }
        header("Location: $url");
        if ($cache == true) {
            header("Cache-Control: private");
            header("Vary: User-Agent, Accept-Encoding");
        }
    }

    static function toxml($charset = "UTF-8") {
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Type: text/xml; charset=$charset");
    }
static function to400(){
        header("HTTP/1.0 400 Bad Request");
    }
    static function to404() {
        header("HTTP/1.0 404 Not Found");
    }
	static function to403(){
        header("HTTP/1.0 403 Forbidden");
    }
    static function to500(){
        header("HTTP/1.0 500 Internal Server Error");
    }
    static function tojson($charset = "utf-8") {
        header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
        header("content-type: application/json; charset=$charset");
    }

    static function to429() {
        header("HTTP/1.1 429 Too Many Requests");
    }

    static function totxt($charset = "UTF-8") {
        header("Content-Type: text/plain; charset=$charset");
    }

    static function toJS($charset = "utf-8") {
        header("Content-Type: application/javascript; charset=$charset");
    }

    static function toJpg() {
        header("Content-Type: image/jpeg");
    }

    static function NoCache() {
        header("Expires: Mon, 26 Jul 1990 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    static function Cache($age) {
        header("Expires: " . gmdate("D, d M Y H:i:s", time() + $age) . " GMT");
        header("Cache-Control: max-age=$age");
        header("Pragma: public");
    }

}

?>