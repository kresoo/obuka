<?php

class Category extends databaseObject {

    public $id;
    public $name;
    public static $table_name = "category";
    public static $table_fields = array("id", "name");

}

