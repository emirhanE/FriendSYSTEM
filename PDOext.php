<?php
class PDOext extends \PDO
{
    public function __construct($host, $dbname, $username, $password, $charset = 'utf8')
    {
        parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
        $this->query('SET CHARACTER SET ' . $charset);
        $this->query('SET NAMES ' . $charset);
    }
    public function select($tableName, $type = false, $valueSQL = false)
    {
        if ($type == false || $valueSQL == false)
        {
            $sql = "SELECT * FROM " . $tableName;
            return $this->query($sql);
        }
        else
        {
            $sql = "SELECT * FROM " . $tableName . " $type " . " $valueSQL";
            return $this->query($sql);
        }
    }
    public function insert($tableName, $set)
    {
        $sql = "INSERT INTO " . $tableName . " SET " . $set;
        return $this->query($sql);
    }
    public function update($tableName, $set, $whereSQL)
    {
        $sql = "UPDATE " . $tableName . " SET " . $set . " WHERE " . $whereSQL;
        return $this->query($sql);
    }
    public function delete($tableName,$whereSQL)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE " . $whereSQL;
        return $this->query($sql);
    }
    public static function destroy()
    {
        session_destroy();
    }
}