<?php
require_once(__DIR__ . "/../dao/dao_personas.php");

// Crear persona
dao_personas::create("Juan", "Pérez", 1, "12345678", "juan@mail.com");

// Leer persona
$result = dao_personas::read(1);
if ($result && $result->num_rows > 0) {
    $persona = $result->fetch_assoc();
    echo "Nombre: " . $persona['nombre'] . " " . $persona['apellido'] . "\n";
}

// Actualizar persona
dao_personas::update(1, "Juan", "Pérez", 1, "12345678", "juanperez@mail.com");

// Eliminar persona
dao_personas::delete(1);
?>
