<?php
class DBConnection {
    private static $host = "localhost";
    private static $user = "tfi_utn";
    private static $password = "pringles26";
    private static $database = "gestion_inmobiliaria";
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            self::$connection = mysqli_connect(self::$host, self::$user, self::$password, self::$database);
            if (!self::$connection) {
                die("Error de conexion: " . mysqli_connect_error());
            }
        }
        return self::$connection;
    }

    public static function query($sql) {
        $conn = self::connect();
        return mysqli_query($conn, $sql);
    }

    // Método para limpiar strings (Vital para seguridad)
    public static function escape($value) {
        return mysqli_real_escape_string(self::connect(), $value);
    }

    }
}
?>




