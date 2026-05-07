<?php
require_once(__DIR__ . "/../db/db_connection.php");

class dao_personas {
    public static function create($nombre, $apellido, $id_tipo_doc, $nro_documento, $email) {
        // Limpia los datos antes de usarlos
        $n = DBConnection::escape($nombre);
        $a = DBConnection::escape($apellido);
        $doc = DBConnection::escape($nro_documento);
        $e = DBConnection::escape($email);
        
        $sql = "INSERT INTO personas (nombre, apellido, id_tipo_doc, nro_documento, email) 
                VALUES ('$nombre', '$apellido', $id_tipo_doc, '$nro_documento', '$email')";
        return DBConnection::query($sql);
    }

    public static function read($id_persona) {
        $sql = "SELECT * FROM personas WHERE id_persona = $id_persona";
        return DBConnection::query($sql);
    }

    public static function update($id_persona, $nombre, $apellido, $id_tipo_doc, $nro_documento, $email) {
        
        $n = DBConnection::escape($nombre);
        $a = DBConnection::escape($apellido);
        $doc = DBConnection::escape($nro_documento);
        $e = DBConnection::escape($email);
        // 2. Asegura que los IDs sean números
        $id_p = (int)$id_persona;
        $id_td = (int)$id_tipo_doc;
        
        $sql = "UPDATE personas 
                SET nombre='$n', apellido='$a', id_tipo_doc=$id_td, 
                    nro_documento='$doc', email='$e' 
                WHERE id_persona=$id_p";
        return DBConnection::query($sql);
    }

    public static function delete($id_persona) {

        $id = (int)$id_persona;
        $sql = "DELETE FROM personas WHERE id_persona=$id";
        return DBConnection::query($sql);
    }
}
?>
