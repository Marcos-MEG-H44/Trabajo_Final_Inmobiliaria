<?php
require_once(__DIR__ . "/../db/db_connection.php");

class dao_usuarios {
    public static function create($username, $password, $id_persona, $id_perfil) {
        
        $username = DBConnection::escape($username);
        $password = DBConnection::escape($password);
        $id_persona = (int)$id_persona;
        $id_perfil = (int)$id_perfil;
        
        $sql = "INSERT INTO usuarios (username, password_hash, id_persona, id_perfil) 
                VALUES ('$username', '$password', $id_persona, $id_perfil)";
        return DBConnection::query($sql);
    }

    public static function read($id_usuario) {
        $id = (int)$id_usuario; // Casting a entero por seguridad
        
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
        return DBConnection::query($sql);
    }

    public static function update($id_usuario, $username, $password, $id_persona, $id_perfil) {
        $id = (int)$id_usuario;
        $username = DBConnection::escape($username);
        $password = DBConnection::escape($password);
        $id_persona = (int)$id_persona;
        $id_perfil = (int)$id_perfil;
        
        $sql = "UPDATE usuarios 
                SET username='$username', password_hash='$password', 
                    id_persona=$id_persona, id_perfil=$id_perfil 
                WHERE id_usuario=$id";
        return DBConnection::query($sql);
    }

    public static function delete($id_usuario) {
        $id = (int)$id_usuario; //Mismo casting a entero
        
        $sql = "DELETE FROM usuarios WHERE id_usuario=$id";
        return DBConnection::query($sql);
    }
}
?>
