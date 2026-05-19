<?php
require_once(__DIR__ . "/../db/db_connection.php");
require_once(__DIR__ . "/../config/constants.php");
require_once(__DIR__ . "/../Logger.php");

class dao_personas {
    public static function create($nombre, $apellido, $id_tipo_doc, $nro_documento, $email) {
        try {
            $sql = "INSERT INTO personas (nombre, apellido, id_tipo_doc, nro_documento, email) 
                    VALUES ('$nombre', '$apellido', $id_tipo_doc, '$nro_documento', '$email')";
            $result = DBConnection::query($sql);

            if (!$result) {
                throw new Exception("Error al insertar persona", ERROR);
            }

            throw new Exception("Persona creada correctamente: $nombre $apellido", DEBUG);

        } catch (Exception $e) {
            Logger::log($e->getCode() === ERROR ? "ERROR" : "DEBUG", $e->getMessage(), $e->getCode());
            throw $e;
        }
    }

    // Métodos read, update, delete con la misma lógica
}
?>
