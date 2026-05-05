<?php
require_once(__DIR__ . "/../db/db_connection.php");

class dao_usuarios {
    public static function create($username, $password, $id_persona, $id_perfil) {
        $sql = "INSERT INTO usuarios (username, password, id_persona, id_perfil) 
                VALUES ('$username', '$password', $id_persona, $id_perfil)";
        return DBConnection::query($sql);
    }

    public static function read($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
        return DBConnection::query($sql);
    }

    public static function update($id_usuario, $username, $password, $id_persona, $id_perfil) {
        $sql = "UPDATE usuarios 
                SET username='$username', password='$password', 
                    id_persona=$id_persona, id_perfil=$id_perfil 
                WHERE id_usuario=$id_usuario";
        return DBConnection::query($sql);
    }

    public static function delete($id_usuario) {
        $sql = "DELETE FROM usuarios WHERE id_usuario=$id_usuario";
        return DBConnection::query($sql);
    }
}
?>
