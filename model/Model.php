<?php


class Model {

    public static $pdo;

    public static function set_static() {
        $host = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $pass = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
                die('Error while connecting to database');
            } else {
                echo 'An error occured while processing your request. :(';
            }
            die();
        }
    }

    public static function selectAll() {
        try {
            $sql = "SELECT * FROM " . static::$table;
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while searching all objects from table " . static::$table);
        }
    }

    public static function select($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "SELECT * FROM $table WHERE $table.$primary = :$primary";
            $req = self::$pdo->prepare($sql);
            $req->execute($data);

            if ($req->rowCount() != 0){
                return $req->fetch(PDO::FETCH_OBJ);
            }
            else return null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while selecting in table " . static::$table);
        }
    }

    public static function selectWhere($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $where = "";
            foreach ($data as $key => $value)
                $where .= " $table.$key=:$key AND";
            $where = rtrim($where, 'AND');
            $sql = "SELECT * FROM $table WHERE $where";
            $req = self::$pdo->prepare($sql);
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while selecting <i>where</i> in table  " . static::$table);
        }
    }
    
    public static function delete($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "DELETE FROM $table WHERE $table.$primary = :$primary";
            $req = self::$pdo->prepare($sql);
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while deleting in table  " . static::$table);
        }
    }

    public static function insert($data) {
        try {
            $table = static::$table;
            $indices = "";
            $values = "";
            foreach ($data as $key => $value) {
                $indices .= "$key, ";
                $values .= ":$key, ";
            }
            $indices = '(' . rtrim($indices, ', ') . ')';
            $values = '(' . rtrim($values, ', ') . ')';
            $sql = "INSERT INTO $table $indices VALUES $values";
            $req = self::$pdo->prepare($sql);
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while inserting into table " . static::$table);
        }
    }

    public static function update($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
                    
            $update = "";
            foreach ($data as $key => $value)
                $update .= "$key=:$key, ";
            $update = rtrim($update, ', ');
            $sql = "UPDATE $table SET $update WHERE $primary=:$primary";           
            echo $sql;
            $req = self::$pdo->prepare($sql);
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while updating the database " . static::$table);
        }
    }

}

Model::set_static();
