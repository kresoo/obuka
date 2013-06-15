<?php

class databaseObject {

    public static function findById($id = 0) {
        $result = static::findBySql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
        return (!empty($result)) ? array_shift($result) : false;
    }

    public static function findAll() {
        return static::findBySql("SELECT * FROM " . static::$table_name);
    }

    public static function findBySql($sql) {
        global $database;
        $object_array = array();
        $result_set = $database->query($sql);
        while ($row = $database->fetch($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    private static function instantiate($record) {
        $class = get_called_class();
        $object = new $class;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    protected function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes()) ? true : false;
    }

    protected function attributes() {
        $attributes = array();
        foreach (static::$table_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public function insert() {
        global $database;
        $attributes = $this->attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(",", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("','", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;
        $attributes = $this->attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $val) {
            $attribute_pairs[] = "{$key} = '{$val}'";
        }
        $sql = "UPDATE " . static :: $table_name . " SET ";
        $sql .= join(",", $attribute_pairs);
        $sql .= " WHERE id=" . $this->id;
        $database->db->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

}

?>
