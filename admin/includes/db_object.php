<?php

class Db_object
{

    public static function find_all()
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " ");
    }

    public static function find_by_id($id)
    {
        $result = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id = $id");

        return !empty($result) ? array_shift($result) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;

        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    public static function instantiation($row)
    {   
        $calling_class = get_called_class();
        $the_object = new $calling_class();

        foreach ($row as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    protected function properties()
    {
        // return  get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $properties  = $this->clean_properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";
        // $sql .= $database->escape_string($this->username) . "','";
        // $sql .= $database->escape_string($this->password) . "','";
        // $sql .= $database->escape_string($this->first_name) . "','";
        // $sql .= $database->escape_string(implode(",",array_values($properties))) . "')";
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $properties  = $this->clean_properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $property_pairs[] = " {$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $property_pairs);
        // $sql .= "username = '" . $database->escape_string($this->username) . "',";
        // $sql .= "password = '" . $database->escape_string($this->password) . "',";
        // $sql .= "first_name = '" . $database->escape_string($this->first_name) . "',";
        // $sql .= "last_name = '" . $database->escape_string($this->last_name) . "' ";
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);


        return $database->connection->affected_rows == 1 ? true : die("Error While updating");
    }

    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " WHERE id = {$database->escape_string($this->id)}";
        $database->query($sql);

        return $database->connection->affected_rows == 1 ? true : die("Error While deleting");
    }
}
