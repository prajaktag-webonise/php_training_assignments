<?php
/*
 * Abstract class that defines common behavior and specific behavior of connection is kept abstract
 */
abstract class pdoDatabase {

    abstract function connectToDb();

    /*
     * performs select operation
     */
    function viewQueryResults($connection,$query){
        try {
            $selectQuery = $connection->query($query);
            $selectQuery->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $selectQuery->fetch()) {
                echo $row['dept_id'] . "\n";
                echo $row['dept_name'] . "\n";
                echo "<br/>";

            }
        }
        catch(PDOException $exception)
        {
            echo $query . "<br>" . $exception->getMessage();
        }
    }
/*
 *
 * performs delete operation ...deletes last entry
 */
    function deleteQuery($connection){
        try {
            $selectQuery = $connection->query('select * from department order by dept_id desc limit 1');
            $selectQuery->setFetchMode(PDO::FETCH_ASSOC);
            $row = $selectQuery->fetch();
            $deleteQuery="delete from department where dept_id=".$row['dept_id'];
            $connection->exec($deleteQuery);
            echo "Deleted record successfully with dept_id :".$row['dept_id'];
        }
        catch(PDOException $exception)
        {
            echo $exception->getMessage();
        }
    }
/*
 * performs insertion operation
 *
 */
    function insertQuery($connection,$query){
        try {
            $connection->exec($query);
            echo "New record created successfully";
        }
        catch(PDOException $exception)
        {
            echo $query . "<br>" . $exception->getMessage();
        }
    }

}

/*
 *
 * class for mysql db which inherits pdoDatabase class and defines connection
 */
class mySql extends pdoDatabase {

    var $serverName;
    var $username;
    var $password;
    var $databaseName;
/*
 * initialize connection variables
 *
 */
     function __construct() {
         $this->serverName = "localhost";
         $this->username = "root";
         $this->password = "admin";
         $this->databaseName = "pdo";
     }
    /*
     * connection to mysql and returns connection handler
     *
     */
     function connectToDb() {

        try {
            $connection = new PDO("mysql:host=$this->serverName;dbname=$this->databaseName", $this->username, $this->password);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo  "<br>" . $exception->getMessage();
        }

        return $connection;
    }
}

/*
 *
 * class for postgres db which inherits pdoDatabase class and defines connection
 */
class postgresPdo extends pdoDatabase {
     var $serverName;
     var $username;
     var $password;
     var $databaseName;

    /*
 * initialize connection variables
 *
 */
    function __construct() {
        $this->serverName = "localhost";
        $this->username = "postgres";
        $this->password = "admin";
        $this->databaseName = "organizationdb";
    }

    /*
     * connection to postgres and returns connection handler
     *
     */

    function connectToDb() {
        try {
            $dbConnection = new PDO("pgsql:host=$this->serverName;dbname=$this->databaseName", $this->username, $this->password);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              }

            // set the PDO error mode to exception
        catch(PDOException $exception) {

            echo "<br>" .$exception->getMessage();
        }
        return $dbConnection;
    }
}

/*
 *
 * class for sqlite db which inherits pdoDatabase class and defines connection
 */
class sqlitePdo extends pdoDatabase{

    /*
     * connection to sqlite and returns connection handler
     *
     */
    function connectToDb()
    {
        try {
            $dbConnection = new PDO("sqlite:/home/webonise/PDO/organization.db");
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception) {

            echo "<br>" .$exception->getMessage();
        }
        return $dbConnection;
        }

}

