<?php

namespace Core;

use PDO;
use PDOException;

class DataBase
{
    public static function getDataBase(){

        $conf = include __DIR__ . '/../app/database.php';

        if ($conf['driver'] == "sqlite"){

            $sqlite = __DIR__ . "/../storage/database/" . $conf['sqlite']['database'];
            $sqlite = "sqlite: " . $sqlite;

            try{
                $pdo = new PDO($sqlite);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                return $pdo;
            }
            catch (PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        else if ($conf['driver'] == "mysql"){

            $host = $conf['mysql']['host'];
            $db = $conf['mysql']['database'];
            $user = $conf['mysql']['user'];
            $password = $conf['mysql']['password'];
            $charset = $conf['mysql']['charset'];
            $collation = $conf['mysql']['collation'];

            try{
                $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '$charset' COLLATE '$collation'");
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                return $pdo;

            }
            catch (PDOException $e){
//                echo $e->getMessage();
                return include_once '../app/view/notfound/maintenance.phtml';
            }
        }
        else {
            return include_once '../app/view/notfound/maintenance.phtml';
//            echo "Drive de conexão não configurado!";
        }
    }

}