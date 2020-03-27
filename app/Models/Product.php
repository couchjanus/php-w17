<?php
require_once VENDOR.'/framework/Model.php';
require_once VENDOR.'/framework/Connection.php';

class Product extends Model
{
    protected static $table = 'products';
    protected static $primaryKey = 'id';

    public static function getResource() {
        return self::$table;
    }

    public static function getProducts()
    {
        $sql = "SELECT t1.*, t2.picture FROM products t1
                    JOIN (SELECT resource, resource_id, group_concat(filename) picture FROM pictures group by resource_id) as t2
                    ON t2.resource = 'products' 
                    AND t1.id = t2.resource_id
                ";

        $db = Connection::connect();
        $stmt = $db->getPreparedStatment($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
