<?php

class ModelUser extends Model {
    
    protected static $table = "User";
    protected static $primary_index = "IDUser";
    
    public static function selectAllTeachers() {
        try {
            $sql = "SELECT * FROM " . static::$table
                 . " WHERE Role = 'staff';";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }

    public static function selectAllStudents() {
        try {
            $sql = "SELECT * FROM " . static::$table
                 . " WHERE Role = 'student' ORDER BY LastName ASC;";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
}

?>
