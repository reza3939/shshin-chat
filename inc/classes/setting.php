<?php
class setting{
	static function update($name, $value) {
		$storeFile      = file_get_contents('socket/setting.json');
        $storeObjects   = isset($storeFile) ? json_decode($storeFile, true) : array();
		$storeObjects[$name] = $value;
        $storePath = 'socket/setting.json';
        if (file_exists($storePath)) {
            file_put_contents($storePath, json_encode($storeObjects), LOCK_EX);
        }
        return true;
    }
}
?>
