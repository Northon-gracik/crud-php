<?php
class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $host = "localhost";
            $dbname = "cadastro";
            $user = "postgres";
            $password = "postgres"; // Alterar para a senha do PostgreSQL

            self::$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

            if (!self::$conn) {
                die("Erro ao conectar ao PostgreSQL");
            }
        }
        return self::$conn;
    }
}
?>
