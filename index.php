<?php
require_once(__DIR__ . "/dao/dao_personas.php");
require_once(__DIR__ . "/dao/dao_usuarios.php");

try {
    dao_personas::create("Juan", "Pérez", 1, "12345678", "juan@mail.com");
    dao_usuarios::create("juanperez", "1234", 1, 2);

} catch (Exception $e) {
    switch ($e->getCode()) {
        case ERROR:
            echo "❌ Ha ocurrido un error crítico. Contacte al administrador.";
            break;
        case DEBUG:
            echo "⚙️ Operación registrada en modo debug.";
            break;
        case INFO:
            echo "ℹ️ Información: " . $e->getMessage();
            break;
        default:
            echo "Excepción no categorizada: " . $e->getMessage();
    }
}
?>
