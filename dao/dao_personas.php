<?php
require_once(__DIR__ . "/../db/db_connection.php");

class dao_personas {
    public static function create($nombre, $apellido, $id_tipo_doc, $nro_documento, $email) {
        $sql = "INSERT INTO personas (nombre, apellido, id_tipo_doc, nro_documento, email) 
                VALUES ('$nombre', '$apellido', $id_tipo_doc, '$nro_documento', '$email')";
        return DBConnection::query($sql);
    }

    public static function read($id_persona) {
        $sql = "SELECT * FROM personas WHERE id_persona = $id_persona";
        return DBConnection::query($sql);
    }

    public static function update($id_persona, $nombre, $apellido, $id_tipo_doc, $nro_documento, $email) {
        $sql = "UPDATE personas 
                SET nombre='$nombre', apellido='$apellido', id_tipo_doc=$id_tipo_doc, 
                    nro_documento='$nro_documento', email='$email' 
                WHERE id_persona=$id_persona";
        return DBConnection::query($sql);
    }

    public static function delete($id_persona) {
        $sql = "DELETE FROM personas WHERE id_persona=$id_persona";
        return DBConnection::query($sql);
    }
}
?>
