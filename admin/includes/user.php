<?php
class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name','file_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $file_name;
    public $upload_directory = "user_images";
    public $image_place_holder = "http://placehold.it/400x400&text=image";

    public function image_path_and_placeholder()
    {
        return empty($this->file_name) ? $this->image_place_holder : $this->upload_directory .DS.$this->file_name;
    }

    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '$username' AND password = '$password' LIMIT 1";

        $result = self::find_this_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }

    

    public function delete_user()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
 
} //End user Class
