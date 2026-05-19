


<?php
require_once(__DIR__ . "/../config/constants.php");

class DBConnection {
    private static $serverName = "localhost"; // o tu instancia
    private static $connectionOptions = array(
        "Database" => "gestion_inmobiliaria",
        "Uid" => "tfi_utn",
        "PWD" => "pringles26"
    );

    public static function query($sql) {
        $conn = sqlsrv_connect(self::$serverName, self::$connectionOptions);

        if ($conn === false) {
            throw new Exception("Error de conexión a SQL Server: " . print_r(sqlsrv_errors(), true), ERROR);
        }

        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            throw new Exception("Error en la consulta SQL: " . print_r(sqlsrv_errors(), true), ERROR);
        }

        $rows = [];
        if (stripos($sql, "SELECT") === 0) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_ASSOC)) {
                $rows[] = $row;
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        return $rows ?: true;
    }
}
?>
