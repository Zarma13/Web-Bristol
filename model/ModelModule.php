<?php

class ModelModule extends Model {
    
    protected static $table = "Module";
    
    public static function selectAll() {
        try {
            $sql = "SELECT * FROM " . static::$table;
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function selectModuleDetails() {
        try {
            $sql = "SELECT m.*, u.FirstName, u.LastName "
                 . "FROM " . static::$table . " m, User u "
                 . "WHERE m.IDTeacher = u.IDUser;";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function selectModuleExamDates() {
        try {
            $sql = "SELECT m.Name, e.DateExam "
                 . "FROM " . static::$table . " m, Exam e "
                 . "WHERE m.Name = e.ModuleName;";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function selectModuleNbParticipants() {
        try {
            $sql = "SELECT m.Name, count(mp.IDStudent) AS nb "
                 . "FROM " . static::$table . " m, ModuleParticipant mp "
                 . "WHERE m.Name = mp.ModuleName "
                 . "GROUP BY m.Name;";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }

}