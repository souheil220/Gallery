<?php

class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array("id", "title", "caption", "description", "file_name", "alternate_text", "type", "size");
    public $id;
    public $title;
    public $caption;
    public $description;
    public $file_name;
    public $alternate_text;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();

    

    public function picture_path()
    {
        return $this->upload_directory . DS . $this->file_name;
    }

    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

    public static function display_side_bar($photo_id)
    {
        $photo   = Photo::find_by_id($photo_id);
        $output  = "<a class='thumbnail' href = '#'><img width=100px src='{$photo->picture_path()}'></a>";
        $output .= "<p>$photo->file_name</p>";
        $output .= "<p>$photo->type</p>";
        $output .= "<p>$photo->size</p>";
        echo $output;
    }
}
