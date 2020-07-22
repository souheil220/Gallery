<?php
class User
{

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
        $confirm = new self;
        $result = $database->query($sql);
        $confirm->confirm_query($result);
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

    private function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed " . $this->connection->error);
        }
    }

    public function create()
    {
        global $database;
        $sql = "INSERT INTO users (username,password,first_name,last_name) ";
        $sql .= "VALUES ('";
        $sql .= $database->escape_string($this->username) . "','";
        $sql .= $database->escape_string($this->password) . "','";
        $sql .= $database->escape_string($this->first_name) . "','";
        $sql .= $database->escape_string($this->last_name) . "')";

        //    $confirm = new self;
        //    $confirm->confirm_query($database->query($sql));

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }
} //End user Class
