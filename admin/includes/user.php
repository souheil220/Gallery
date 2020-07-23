<?php
class User
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users()
    {
        return self::find_this_query("SELECT * FROM users");
    }

    public static function find_user_by_id($user_id)
    {
        $result = self::find_this_query("SELECT * FROM users where id = $user_id");

        return !empty($result) ? array_shift($result) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;

        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }

    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";

        $result = self::find_this_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }

    public static function instantiation($row)
    {
        $the_object = new self;

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
        foreach (self::$db_table_fields as $db_field) {
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
        $sql = "INSERT INTO " . self::$db_table . " (" . implode(",", array_keys($properties)) . ") ";
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
        print_r($properties);
        print_r($property_pairs);
        $sql = "UPDATE " . self::$db_table . " SET ";
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
        $sql = "DELETE FROM " . self::$db_table . " WHERE id = {$database->escape_string($this->id)}";
        $database->query($sql);

        return $database->connection->affected_rows == 1 ? true : die("Error While deleting");
    }
} //End user Class
