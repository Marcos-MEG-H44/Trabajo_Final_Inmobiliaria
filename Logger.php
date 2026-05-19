<?php
class Logger {
    private static $logFile = "GestionInmobiliaria.log";

    public static function log($level, $message, $code) {
        $date = date("Y-m-d H:i:s");
        $entry = "[$date] [$level] Código: $code - $message" . PHP_EOL;

        if ($level === "ERROR" || $level === "DEBUG") {
            file_put_contents(self::$logFile, $entry, FILE_APPEND);
        }
    }
}
?>
