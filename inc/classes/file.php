<?php

class file {

    public static $size = 0;

    static function get_ext($key) {
        $key = strtolower(substr(strrchr($key, "."), 1));
        $key = str_replace("jpeg", "jpg", $key);
        return $key;
    }

    static function get_file_type($format) {
        switch ($format) {
            //image:
            case 'jpg':case 'png':case 'gif':case 'psd':case 'tif':case'tiff':case 'bmp':case 'eps':case 'ico': $folder = 'image';
                break;
            //media:
            //music:
            case 'mp3':case 'wma':case 'ogg':case 'amr':case 'mp2': $folder = 'music';
                break;
            //video:   
            case 'mpeg':case '3gp':case 'mp4':case 'mov':case 'wmv':case 'avi':case 'swf':case 'vob':case 'dat':case 'flv': $folder = 'video';
                break;
            //folder archive:
            case '7z' :case 'tar':case 'tar.gz' :case 'zip':case 'rar': $folder = 'archive';
                break;
            //folder text and document:
            case 'ans' :case 'csv' :case 'doc' :case 'docx':case 'csv' :case 'pdf' :case 'txt' : $folder = 'document';
                break;
            //folder exe and cursors:
            case 'html':case 'htm' :case'xhtml':case 'xml' :case 'php' :case 'asp' :case 'aspx':case 'pl' :case 'js' :case 'css' :case 'sql' :case 'exe' :case 'h' :case 'c' :case 'cs' :case 'd' :case 'egt' :case 'frm' :case 'java':case 'p' :case 'vb' : $folder = 'app';
                break;
            default:$folder = '';
                break;
        }
        return($folder);
    }

    static function remotefsize($url) {
        $sch = parse_url($url, PHP_URL_SCHEME);
        if (($sch != "http") && ($sch != "https") && ($sch != "ftp") && ($sch != "ftps")) {
            return false;
        }
        if (($sch == "http") || ($sch == "https")) {
            $headers = get_headers($url, 1);
            if ((!array_key_exists("Content-Length", $headers))) {
                return false;
            }
            return $headers["Content-Length"];
        }
        if (($sch == "ftp") || ($sch == "ftps")) {
            $server = parse_url($url, PHP_URL_HOST);
            $port = parse_url($url, PHP_URL_PORT);
            $path = parse_url($url, PHP_URL_PATH);
            $user = parse_url($url, PHP_URL_USER);
            $pass = parse_url($url, PHP_URL_PASS);
            if ((!$server) || (!$path)) {
                return false;
            }
            if (!$port) {
                $port = 21;
            }
            if (!$user) {
                $user = "anonymous";
            }
            if (!$pass) {
                $pass = "phpos@";
            }
            switch ($sch) {
                case "ftp":
                    $ftpid = ftp_connect($server, $port);
                    break;
                case "ftps":
                    $ftpid = ftp_ssl_connect($server, $port);
                    break;
            }
            if (!$ftpid) {
                return false;
            }
            $login = ftp_login($ftpid, $user, $pass);
            if (!$login) {
                return false;
            }
            $ftpsize = ftp_size($ftpid, $path);
            ftp_close($ftpid);
            if ($ftpsize == -1) {
                return false;
            }
            return $ftpsize;
        }
    }

    static function sizeConv($size, $type) {
        if ($type == 'mb') {
            return (round($size / 1048576));
        } elseif ($type == 'kb') {
            return (round($size / 1024));
        } elseif ($type == 'byte') {
            return ($size);
        }
    }

    static function getSize($path) {
        if (is_file($path)) {
            return filesize($path);
        } elseif (is_dir($path)) {
            $size = 0;
            $files = self::listDirectory($path);
            foreach ($files as $file) {
                if (is_file($file)) {
                    $size += filesize($file);
                }
            }
            return $size;
        }
    }

    static function listDirectory($dir, $dirs = true, $subdirs = true) {
        $result = array();
        if (substr($dir, strlen($dir) - 1) != '/')
            $dir.='/';
        $root = scandir($dir);
        foreach ($root as $value) {

            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_file("$dir$value")) {
                $result[] = "$dir$value";
                continue;
            }
            if ($dirs) {
                if (is_dir("$dir$value")) {
                    $result[] = "$dir$value/";
                }
            }
            if ($subdirs) {
                foreach (self::listDirectory("$dir$value/", $dirs, $subdirs) as $value) {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }

    static function mkdir_r($dirName, $rights = 0777) {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir.=$part . '/';
            if (!is_dir($dir) && strlen($dir) > 0)
                mkdir($dir, $rights);
        }
    }

    static function zip($source_dir, $zip_file) {
        if (is_dir($source_dir))
            $file_list = self::listDirectory($source_dir);
        elseif (is_file($source_dir))
            $file_list = array($source_dir);
        else
            return false;
        $zip = new ZipArchive();
        if ($zip->open($zip_file, ZIPARCHIVE::CREATE) === true) {
            foreach ($file_list as $file) {
                if ($file !== $zip_file) {
                    $zip->addFile($file, substr($file, strlen($source_dir)));
                }
            }
            $zip->close();
        }
    }

    static function unzip($zip_file, $dir) {
        $zip = new ZipArchive;
        $res = $zip->open($zip_file);
        if ($res === TRUE) {
            $zip->extractTo($dir);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }

    static function Delete($path) {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                self::Delete(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        }
        return false;
    }

    static function copy($src, $dst, $igfiles = null) {

        $dir = opendir($src);
        if (!is_dir($dst)) {
            mkdir($dst);
        }
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    self::copy($src . '/' . $file, $dst . '/' . $file, $igfiles);
                } else {
                    if ($igfiles != null and is_array($igfiles)) {
                        if (in_array($file, $igfiles)) {
                            continue;
                        }
                    }
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    static function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    static function mime_content_type($filename) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mime;
    }

    static function smartReadFile($location, $filename, $mimeType = 'application/octet-stream') {
        if (!file_exists($location)) {
            header("HTTP/1.0 404 Not Found");
            return;
        }

        $size = filesize($location);
        $time = date('r', filemtime($location));

        $fm = @fopen($location, 'rb');
        if (!$fm) {
            header("HTTP/1.0 505 Internal server error");
            return;
        }

        $begin = 0;
        $end = $size;

        if (isset($_SERVER['HTTP_RANGE'])) {
            if (preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)) {
                $begin = intval($matches[0]);
                if (!empty($matches[1]))
                    $end = intval($matches[1]);
            }
        }

        if ($begin > 0 || $end < $size)
            header('HTTP/1.0 206 Partial Content');
        else
            header('HTTP/1.0 200 OK');

        header("Content-Type: $mimeType");
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Accept-Ranges: bytes');
        header('Content-Length:' . ($end - $begin));
        header("Content-Range: bytes $begin-$end/$size");
        header("Content-Disposition: inline; filename=$filename");
        header("Content-Transfer-Encoding: binary\n");
        header("Last-Modified: $time");
        header('Connection: close');

        $cur = $begin;
        fseek($fm, $begin, 0);

        while (!feof($fm) && $cur < $end && (connection_status() == 0)) {
            print fread($fm, min(1024 * 16, $end - $cur));
            $cur += 1024 * 16;
        }
    }

    static function checkrootdir($path) {
        global $options;
        if (substr($options['rootdirmanager'], strlen($options['rootdirmanager']) - 1) != '/')
            $options['rootdirmanager'].='/';
        if (strlen($path) < strlen($options['rootdirmanager']) || substr($path, 0, strlen($options['rootdirmanager'])) != $options['rootdirmanager']) {
            return ($options['rootdirmanager'] . $path);
        } else {
            return $path;
        }
    }

}

?>