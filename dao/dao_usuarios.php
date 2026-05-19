<?php
require_once(__DIR__ . "/../db/db_connection.php");
require_once(__DIR__ . "/../config/constants.php");
require_once(__DIR__ . "/../Logger.php");

class dao_usuarios {

    public static function create($username, $password, $id_persona, $id_perfil) {
        try {
            $sql = "INSERT INTO usuarios (username, password, id_persona, id_perfil) 
                    VALUES ('$username', '$password', $id_persona, $id_perfil)";
            $result = DBConnection::query($sql);

            if (!$result) {
                throw new Exception("Error al insertar usuario", ERROR);
            }

            throw new Exception("Usuario creado correctamente: $username", DEBUG);

        } catch (Exception $e) {
            Logger::log($e->getCode() === ERROR ? "ERROR" : "DEBUG", $e->getMessage(), $e->getCode());
            throw $e;
        }
    }

    public static function read($id_usuario) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
            $result = DBConnection::query($sql);

            if (!$result) {
                throw new Exception("Error al leer usuario con ID $id_usuario", ERROR);
            }

            throw new Exception("Usuario leído correctamente: ID $id_usuario", DEBUG);
            return $result;

        } catch (Exception $e) {
            Logger::log($e->getCode() === ERROR ? "ERROR" : "DEBUG", $e->getMessage(), $e->getCode());
            throw $e;
        }
    }

    public static function update($id_usuario, $username, $password, $id_persona, $id_perfil) {
        try {
            $sql = "UPDATE usuarios 
                    SET username='$username', password='$password', 
                        id_persona=$id_persona, id_perfil=$id_perfil 
                    WHERE id_usuario=$id_usuario";
            $result = DBConnection::query($sql);

            if (!$result) {
                throw new Exception("Error al actualizar usuario con ID $id_usuario", ERROR);
            }

            throw new Exception("Usuario actualizado correctamente: $username", DEBUG);

        } catch (Exception $e) {
            Logger::log($e->getCode() === ERROR ? "ERROR" : "DEBUG", $e->getMessage(), $e->getCode());
            throw $e;
        }
    }

    public static function delete($id_usuario) {
        try {
            $sql = "DELETE FROM usuarios WHERE id_usuario=$id_usuario";
            $result = DBConnection::query($sql);

            if (!$result) {
                throw new Exception("Error al eliminar usuario con ID $id_usuario", ERROR);
            }

            throw new Exception("Usuario eliminado correctamente: ID $id_usuario", DEBUG);

        } catch (Exception $e) {
            Logger::log($e->getCode() === ERROR ? "ERROR" : "DEBUG", $e->getMessage(), $e->getCode());
            throw $e;
        }
    }
}
?>
