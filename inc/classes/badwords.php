<?php
class badwords{
    private static function getId() {
      $counterPath = 'inc/_cnt.sdb';
      if (file_exists($counterPath)) {
        $counter = (int) file_get_contents( $counterPath );
      } else {
        $counter = 0;
      }
      $counter++;
      file_put_contents( $counterPath, $counter );
      return $counter;
    }
	static function add(array $data) {
		$insert_data = array(
			'id' => self::getId(),
			'word' => $data['word'],
			'replace' => $data['replace'],
			'general' => $data['general'],
			'private' => $data['private'],
			'profile' => $data['profile'],
			'offlinemsg' => $data['offlinemsg'],
			'tablighat' => $data['tablighat']
			);
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeToArray   = isset($storeFile) ? json_decode($storeFile, true) : array();
        $storeToArray[] = $insert_data;
        $storableJSON   = json_encode($storeToArray);
        if ($storableJSON === false)
            throw new \Exception('Unable to encode the data array, 
        please provide a valid PHP associative array');
        $insert = file_put_contents('inc/badwords.json', $storableJSON);
        if (!$insert) {
            throw new \Exception("Unable to write the object file! Please check if PHP has write permission.");
        }
		self::reload();
        return $insert ? true : false;
	}
	static function update($id, $updateable) {
		$storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                foreach ($updateable as $keys => $values) {
                        $storeObjects[$key][$keys] = $values;
                }
            }
        }
        $storePath = 'inc/badwords.json';
        if (file_exists($storePath)) {
            file_put_contents($storePath, json_encode($storeObjects), LOCK_EX);
			self::reload();
        }
        return true;
    }
    static function delete($id) {
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                unset($storeObjects[$key]);
            }
        }
        $storePath = 'inc/badwords.json';
        if (file_exists($storePath)) {
            file_put_contents($storePath, json_encode($storeObjects), LOCK_EX);
			self::reload();
        }
        return true;
    }
	static function getCount($word, $id = null) {
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
		$found = false;
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['word'] == $word && ($id != null && $storeObjects[$key]['id'] != $id)) {
                $found = true;
				break;
            }
        }
        return $found == true ? true : false;
    }
	static function fetch() {
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
		return $storeObjects;
    }
	static function fetchOne($id) {
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
		$found = "";
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                $found = $storeObjects[$key];
            }
        }
        return $found;
    }
	static function reload() {
        $storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects))
            return false;
		$main = array();
		$private = array();
		foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['general'] == '1') {
                $main[] = $storeObjects[$key];
            } 
            if ($storeObjects[$key]['private'] == '1') {
                $private[] = $storeObjects[$key];
            }
        }
        file_put_contents('socket/badwords_main.json', json_encode($main), LOCK_EX);
		file_put_contents('socket/badwords_private.json', json_encode($private), LOCK_EX);
    }
	static function countAll() {
		$storeFile      = file_get_contents('inc/badwords.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		return count($storeObjects);
	}
	static function clearAll() {
		file_put_contents('inc/badwords.json', json_encode(array()), LOCK_EX);
		file_put_contents('socket/badwords_main.json', json_encode(array()), LOCK_EX);
		file_put_contents('socket/badwords_private.json', json_encode(array()), LOCK_EX);
	}
}
?>
