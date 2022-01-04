<?php

namespace App;

use PDO;
use Validate\Validate;

class App
{
    static $pdo;
    protected $validate;

    public static function connect_db()
    {
        $host = '127.0.0.1';
        $db   = 'apart_clean';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        self::$pdo = new PDO($dsn, $user, $pass, $options);
    }

    public static function getAllClients()
    {
        self::connect_db();
        $sql = "SELECT *
        FROM clients";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function printDataToCsvFile($data)
    {
        $file = fopen('dataExport.csv', 'r+') or die("Unable to open file!");
        foreach ($data as $key => $item) {
            fputcsv($file, $item);
        }
        fclose($file);
        return print "Data successfully printed in CSV file";
    }

    public static function importDataToDb($filename)
    {
        $file = fopen($filename, 'r');

        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            $sql = "INSERT INTO
            clients
            (`name`, email, phone, `address`, `date`, `time`)
            VALUES ('$getData[1]', '$getData[2]', '$getData[3]', '$getData[4]', '$getData[5]', '$getData[6]')
            ";

            $result = self::$pdo->query($sql);

            if (!isset($result)) {
                print "Invalid file format, or line error!";
            }
        }
        print "CSV file was successfully import to database!";
        fclose($file);
    }

    public static function addNewClient($name, $email, $phone, $address, $date, $time)
    {
        $validate = new Validate;
        $valEmail = $validate->validateEmail($email);
        $valPhone = $validate->validatePhone($phone);
        $valDate = $validate->validateDate($date);
        $valTime = $validate->validateTime($time);

        self::connect_db();
        $sql = "INSERT INTO
        clients
        (`name`, email, phone, `address`, `date`, `time`)
        VALUES ('$name', '$valEmail', '$valPhone', '$address', '$valDate', '$valTime')
        ";
        self::$pdo->query($sql);
    }

    public static function editClient($id, $name, $email, $phone, $address, $date, $time)
    {
        self::connect_db();
        $sql = "UPDATE
        clients
        SET `name` = '$name', email = '$email', phone = '$phone', address = '$address', date = '$date', time = '$time'
        WHERE id = $id
        ";
        self::$pdo->query($sql);
    }

    public static function deleteClient($id)
    {
        self::connect_db();
        $sql = "DELETE FROM
        clients
        WHERE id = $id";
        self::$pdo->query($sql);
        return "Entry deleted";
    }

    public static function showByDate($date)
    {
        self::connect_db();
        $sql = "SELECT *
        FROM clients
        WHERE `date` = '$date'
        ORDER BY `time` ASC";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return print_r($row);
    }
}
