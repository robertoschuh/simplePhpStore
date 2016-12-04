<?php

namespace store\Entities;

use \Mysqli;

class Connect {

    const SERVER = 'localhost';
    const USER = 'root';
    const PWD = 'nubi';
    const DB = 'wwwglor_gloria';

    /**
     * Db constructor.
     * Create the Db connection.
     */
    public function __construct()
    {
        try {
            $this->conn = New Mysqli(self::SERVER, self::USER, self::PWD, self::DB);

            }
        catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public function query($sql){

        $result = $this->conn->query($sql);
        if (!$result) {
            echo "<h4>debuging..</h4>";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
        }

        return $result;

    }
}