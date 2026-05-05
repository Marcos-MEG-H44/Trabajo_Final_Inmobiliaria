<?php
require_once(__DIR__ . "/../dao/dao_usuarios.php");

// Crear usuario
dao_usuarios::create("marcos", "clave123", 1, 2);

// Leer usuario
$result = dao_usuarios::read(1);
if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    echo "Usuario: " . $usuario['username'] . "\n";
}

// Actualizar usuario
dao_usuarios::update(1, "marcos", "clave456", 1, 2);

// Eliminar usuario
dao_usuarios::delete(1);
?>
