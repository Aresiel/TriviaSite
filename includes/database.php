<?php
class Database
{
    private static mysqli $conn;
    private static string $serverName = "localhost";
    private static string $dbUsername = "triviasite";
    private static string $dbPassword = "";
    private static string $dbName = "triviasite";

    public final function __construct(){}

    public static function getConn(): mysqli {
        if(!isset(self::$conn))
        {
            self::$conn = mysqli_connect(self::$serverName, self::$dbUsername, self::$dbPassword, self::$dbName);

            if(!self::$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }
        return self::$conn;
    }
}