<?php
/**
 * Model base class
 */
require_once VENDOR.'/framework/Connection.php';

abstract class Model
{
    protected static $table = '';
    protected static $primaryKey = '';
    protected $columns;

    public function __construct()
    {
        $this->columns = array();
    }

    /**
     * Create an instance of this Model from the database row
     */
    protected function createFromDb($columns){
        foreach ($columns as $key => $value) {
            $this->columns[$key] = $value;
        }
    }

    public function __get($key) { 
        return $this->columns[$key];
    }
      
    public function __set($key, $value) { 
        return $this->columns[$key] = $value;
    }
    
    /**
     * Get all items
     * Conditions are combined by logical AND
     * @example getAll(array(name=>'Bond', 'status'=>1),'name DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND status=1 ORDER BY name DESC LIMIT 0,25
     */
    public static function all($condition=array(), $order=NULL, $startIndex=NULL, $count=NULL)
    {
        $query = "SELECT * FROM " . static::$table;
        if(!empty($condition)){
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:".$key." AND ";
            }
        }
        $query = rtrim($query,' AND ');
        if($order){
            $query .= " ORDER BY " . $order;
        }
        if($startIndex !== NULL){
            $query .= " LIMIT " . $startIndex;
            if($count){
                $query .= "," . $count;
            }
        }
        return self::get($query, $condition);
    }
    
    /**
     * Pass a custom query and condition
     * @example get('SELECT * FROM TABLE WHERE name=:user OR status=:status',array(name=>'Bond',status=>1))
     */
    public static function get($query, $condition=array()){
        $db = Connection::connect();
        $stmt = $db->getPreparedStatment($query);
        
        foreach ($condition as $key => $value) {
            $condition[':'.$key] = $value;
            unset($condition[$key]);
        }
        $stmt->execute($condition);
        $className = get_called_class();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $collection = array();
        
        foreach($result as $row){
            $item = new $className();
            $item->createFromDb($row);
            array_push($collection, $item);
        }
        return $collection;
    }

    /**
     * Save or update the item data in database
     */
    public function store()
    {
        $class = get_called_class();
        $query =  "REPLACE INTO " . static::$table . " (" . implode(",", array_keys($this->columns)) . ") VALUES(";
        $keys = array();
        foreach ($this->columns as $key => $value) {
            $keys[":".$key] = $value;
        }
        $query .= implode(",", array_keys($keys)).")";
        $db = Connection::connect();
        $stmt = $db->getPreparedStatment($query);
        $stmt->execute($keys);
    }

    public static function lastId() 
    {
        $query = "SELECT id FROM " . static::$table . " ORDER BY id DESC LIMIT 1";
        $db = Connection::connect();
        $stmt = $db->getPreparedStatment($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
}