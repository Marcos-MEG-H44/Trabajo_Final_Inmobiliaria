<?php
class DBConnection {
    private static $host = "localhost";
    private static $user = "tfi_utn";
    private static $password = "pringles26";
    private static $database = "gestion_inmobiliaria";
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            self::$connection = new mysqli(self::$host, self::$user, self::$password, self::$database);
            if(self::$connection->connect_error){
                die("Error de conexion: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }

    public static function query($sql) {
        $conn = self::connect();
        return $conn->query($sql);
    }

    public static function close() {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }

    }
}
?>




