<?php

class db {

    private static $link;
    public static $id;
    public static $contected = false;

    static function link() {
        return self::$link;
    }

    static function connect() {
        if (self::$contected == false) {
            self::$link = mysqli_connect(db_server, db_user, db_pass, db_name);
            if (mysqli_connect_errno()) {
                die("cannot connect to mysql");
            }
            self::$contected = true;
            self::query("SET CHARACTER SET utf8");
        }
    }

    static function get($tabel, $columns, $if = '1', $loop = 0) {
        $return = false;
        if ($columns == '*') {
            $query = self::query("SELECT * FROM `{prefix}$tabel` WHERE $if");
            if ($rows = mysqli_fetch_array($query))
                $return = $rows;
        } elseif (substr($columns, 0, 1) == '`') {
            $query = self::query("SELECT $columns FROM `{prefix}$tabel` WHERE $if");
            $return = mysqli_fetch_array($query);
        } else {
            $query = self::query("SELECT `$columns` FROM `{prefix}$tabel` WHERE $if LIMIT 0,1");
            $rows = mysqli_fetch_array($query);
            $return = $rows ? $rows[0] : false;
        }
        if ($query instanceof mysqli_result) {
            mysqli_free_result($query);
        }
        return $return;
    }

    static function num($tabel, $if = '1', $DISTINCT = null) {
        $query = $DISTINCT == null ? self::query("SELECT * FROM `{prefix}$tabel` WHERE $if") : self::query("SELECT $DISTINCT FROM `{prefix}$tabel` WHERE $if");
        $num = mysqli_num_rows($query);
        mysqli_free_result($query);
        return ($num);
    }

	static function onlines($tabel, $if = '1', $DISTINCT = null) {
		$num=0;
		$query = $DISTINCT == null ? self::query("SELECT * FROM `{prefix}$tabel` WHERE $if") : self::query("SELECT $DISTINCT FROM `{prefix}$tabel` WHERE $if");
			$visualTime=jdate::start('H:i',time());
				while($row=mysqli_fetch_assoc($query)){
					if($row['time']==0 && isJson($row['inputs'])){
						$inputsVisual=json_decode($row['inputs'],true);
						if(isset($inputsVisual['firstTime']) && isset($inputsVisual['lastTime']) && $inputsVisual['firstTime']!=0 && $inputsVisual['lastTime']!=0){
							if(!(($visualTime>=$inputsVisual['firstTime']) && ($visualTime<$inputsVisual['lastTime']))){
								continue;
							}
						}
					}
					$num++;
				}
        mysqli_free_result($query);
        return ($num);
    }
	
    static function update($tabel, $values, $if = '1') {
        $query = self::query("UPDATE `{prefix}$tabel` SET $values WHERE $if");
        return ($query);
    }

    static function query($query) {
        if (self::$contected == false) {
            self::connect();
        }
        $query = str_replace(array(
            '{prefix}',
            '{db_name}'
                ), array(
            db_prefix,
            db_name
                ), $query);
        $query = mysqli_query(self::$link, $query);
        return ($query);
    }

    static function multi_query($queries) {
        if (self::$contected == false) {
            self::connect();
        }
        $queries = str_replace(array(
            '{prefix}',
            '{db_name}'
                ), array(
            db_prefix,
            db_name
                ), $queries);
        $queries = mysqli_multi_query(self::$link, $queries) or die(mysqli_error(self::$link));
        return ($queries);
    }

    static function delete($tabel, $if = '1') {
        $query = self::query("DELETE FROM `{prefix}$tabel` WHERE $if");
        return ($query);
    }

    static function insert($tabel, $columns, $values) {
        $query = self::query("INSERT INTO `{prefix}$tabel` ($columns) VALUES ($values)");
        self::$id = mysqli_insert_id(self::$link);
        return ($query);
    }

    static function close() {
        if (self::$contected) {
            mysqli_close(self::$link);
            self::$contected = false;
        }
    }

    static function emptty($table) {
        self::query("TRUNCATE TABLE `{prefix}$table`");
    }

    static function size($table = null) {
        if ($table == null) {
            $resulet = array();
            $query = self::query("SELECT round(((`data_length` + `index_length`) /1024 ) , 2) 'Size in KB', `table_name` FROM information_schema.TABLES WHERE table_schema = '{db_name}'");
            while ($row = mysqli_fetch_array($query)) {
                $resulet[$row['table_name']] = $row[0];
            }
        } else {
            $query = self::query("SELECT round(((`data_length` + `index_length`) /1024 ) , 2) 'Size in KB' FROM information_schema.TABLES WHERE table_schema = '{db_name}' AND table_name = '{prefix}$table' LIMIT 0 , 1");
            $resulet = mysqli_fetch_array($query);
            $resulet = $resulet[0];
        }
        mysqli_free_result($query);
        return $resulet;
    }

    static function check($table) {
        $query = self::query("CHECK TABLE `{prefix}$table`");
        return (mysqli_fetch_array($query));
    }

    static function repair($table) {
        $query = self::query("REPAIR TABLE `{prefix}$table`");
        return (mysqli_fetch_array($query));
    }
    static function optimize($table) {
        $query = self::query("OPTIMIZE TABLE `{prefix}$table`");
        return (mysqli_fetch_array($query));
    }
static function escape($text){
      if(self::$contected == false)self::connect();
      return mysqli_real_escape_string(self::$link, $text);
    }

}

?>