<?php

class Conf {

    // change debug mode
    private static $debug = false;
    
    // phpMyAdmin on https://grodzilla.fr/pma/
    private static $database = array(
        'hostname' => 'grodzilla.fr',  
        'database' => 'uwe_bristol', 
        'login' => 'uwe_bristol',
        'password' => 'wqMfHVWdbTW9LmMt'
    );
        
    static public function getSeed () {
          return self :: $seed ;
    }
    
    static public function getLogin() {
        return self::$database['login'];
    }

    static public function getHostname() {
        return self::$database['hostname'];
    }

    static public function getDatabase() {
        return self::$database['database'];
    }

    static public function getPassword() {
        return self::$database['password'];
    }
    
    static public function getDebug() {
        return self::$debug;
    }

}

?>
