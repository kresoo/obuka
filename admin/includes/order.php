<?php

class Order extends databaseObject {

    public $id;
    public $total_price;
    public $items;
    public $customer_info;
    public $shipping_info;
    public $payment_info;
    public $user_id;
    public static $table_name = "orders";
    public static $table_fields = array("id", "total_price", "items", "customer_info", "shipping_info", "payment_info", "user_id");

    public function attachObjectProperties($values) {
        foreach ($values as $key => $value) {
            if ($key = "items" || $key = "customer_info") {
                serialize($key);
            }
            if ($this->has_attribute($key)) {
                $this->$key = $value;
            }
        }
    }

    public static function findOrdersByUserId($user_id) {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id = " . $user_id;
        return static::findBySql($sql);
    }

}

?>
