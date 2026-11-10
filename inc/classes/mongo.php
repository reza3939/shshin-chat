<?php
class Database {
    protected $database = '';
    protected $mo;
    public function __construct($database) {
       $mongo = $this->getInstance('localhost');
       $this->database = $mongo->$database;
    }
    private function getInstance($server,$port = 27017) {
        if (isset($this->mo)) {
            return $this->mo;
        } else {
            $this->mo = new Mongo("mongodb://{$server}:{$port}");     
            return $this->mo;
        }
    }
    public function getAll($table, $where = array(), $sort = array(), $limit = '', $skip = '') {
        if (!empty($where)) {
            $data = $this->database->$table->find($where);
        } else {
            $data = $this->database->$table->find();
        }
        if (!empty($sort)) {
            $data = $data->sort($sort);
        }
        if (!empty($limit)) {
            $data = $data->limit($limit);
        }
        if (!empty($skip)) {
            $data = $data->skip($skip);
        }
        $newData = array();
        while ($data->hasNext()) {
            $newData[] = $data->getNext();
        }
        if (count($newData) == 0) {
            return 0;
        }
		$this->close();
        return $newData;
    }
    public function getOne($table, $where = array()) {
        if (!empty($where)) {
            $data = $this->database->$table->findOne($where);
        } else {
            $data = $this->database->$table->findOne();
        }
		$this->close();
        return $data;
    }
    public function getCount($table, $where = array()) {
        if (!empty($where)) {
            $data = $this->database->$table->find($where)->count();
        } else {
            $data = $this->database->$table->find()->count();
        }
		$this->close();
        return $data;
    }
    public function toExcute($sql) {
        $result = $this->database->execute($sql);
        return $result;
    }
    public function groupCount($table, $where, $field) {
        $cond = array(
            array(
                '$match' => $where
            ),
            array(
                '$group' => array(
                    '_id' => '$' . $field,
                    'count' => array(
                        '$sum' => 1
                    )
                )
            ),
            array(
                '$sort' => array(
                    "count" => -1
                )
            )
        );
        $this->database->$table->aggregate($cond);
    }
    public function toDelete($table, $where) {
        $re = $this->database->$table->remove($where);
		$this->close();
        return $re;
    }
    public function toInsert($table, $data) {
        $re = $this->database->$table->insert($data);
		$this->close();
        return $re;
    }
    public function toUpdate($table, $where, $data) {
        $re = $this->database->$table->update($where, array(
            '$set' => $data
        ));
		$this->close();
        return $re;
    }
	public function toDrop($table) {
        $re = $this->database->$table->drop();
		$this->close();
        return $re;
    }
    public function distinctData($table, $key, $query = array()) {
        if (!empty($query)) {
            $where = array(
                'distinct' => $table,
                'key' => $key,
                'query' => $query
            );
        } else {
            $where = array(
                'distinct' => $table,
                'key' => $key
            );
        }
        $data = $this->database->command($where);
		$this->close();
        return $data['values'];
    }
	public function close() {
		if (isset($this->mo)) {
            $this->mo->close();
			$this->mo = null;
        }
	}
}
$db = new Database('injac781_xaikw');
?>