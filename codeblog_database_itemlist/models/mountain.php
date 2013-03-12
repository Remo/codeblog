<?php

defined('C5_EXECUTE') or die('Access Denied.');

class Mountain extends Object {

    protected $mountainID;

    public function __construct($mountainID, $row = null) {
        $this->mountainID = $mountainID;
        if ($row == null) {
            $db = Loader::db();
            $row = $db->GetRow('SELECT * FROM CodeblogMountains WHERE mountainID=?', array($mountainID));
        }
        $this->setPropertiesFromArray($row);
    }

    public function getMountainID() {
        return $this->mountainID;
    }

    public function getMountainName() {
        return $this->mountainName;
    }

    public function getMountainHeight() {
        return $this->mountainHeight;
    }

    public function update($data) {
        $db = Loader::db();
        $db->AutoExecute('CodeblogMountains', $data, 'UPDATE', "mountainID='{$this->mountainID}'");
    }

    public static function add($data) {
        $db = Loader::db();
        $db->AutoExecute('CodeblogMountains', $data, 'INSERT');
        return new Mountain($db->Insert_ID(), $data);
    }

    public function remove() {
        $db = Loader::db();
        $db->Execute('DELETE FROM CodeblogMountains WHERE mountainID=?', array($this->mountainID));
    }

}
