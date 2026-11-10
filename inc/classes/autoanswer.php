<?php
class autoanswer{
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
			'question' => $data['question'],
			'answer' => $data['answer']
			);
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeToArray   = isset($storeFile) ? json_decode($storeFile, true) : array();
        $storeToArray[] = $insert_data;
        $storableJSON   = json_encode($storeToArray);
        file_put_contents('socket/autoanswer.json', $storableJSON, LOCK_EX);
		file_put_contents('inc/autoanswer.json', $storableJSON, LOCK_EX);
	}
	static function update($id, $updateable) {
		$storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                foreach ($updateable as $keys => $values) {
                        $storeObjects[$key][$keys] = $values;
                }
            }
        }
		file_put_contents('socket/autoanswer.json', json_encode($storeObjects), LOCK_EX);
		file_put_contents('inc/autoanswer.json', json_encode($storeObjects), LOCK_EX);
    }
    static function delete($id) {
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                unset($storeObjects[$key]);
            }
        }
        file_put_contents('socket/autoanswer.json', json_encode($storeObjects), LOCK_EX);
		file_put_contents('inc/autoanswer.json', json_encode($storeObjects), LOCK_EX);
    }
	static function getCount($question, $id = null) {
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		$found = false;
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['question'] == $question && ($id != null && $storeObjects[$key]['id'] != $id)) {
                $found = true;
				break;
            }
        }
        return $found == true ? true : false;
    }
	static function found($id) {
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		$found = false;
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                $found = true;
				break;
            }
        }
        return $found == true ? true : false;
    }
	static function fetch() {
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		return $storeObjects;
    }
	static function fetchOne($id) {
        $storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		$found = "";
        foreach ($storeObjects as $key => $value) {
            if ($storeObjects[$key]['id'] == $id) {
                $found = $storeObjects[$key];
            }
        }
        return $found;
    }
	static function countAll() {
		$storeFile      = file_get_contents('inc/autoanswer.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
        if (empty($storeObjects)) return '0';
		return count($storeObjects);
	}
	static function clearAll() {
		file_put_contents('socket/autoanswer.json', json_encode(array()), LOCK_EX);
		file_put_contents('inc/autoanswer.json', json_encode(array()), LOCK_EX);
	}
}
?>
