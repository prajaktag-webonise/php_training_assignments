<?php
include_once('config.php');
include_once('pdo_classes.php');
/*
 * Main flow after selection
 *
 */
function callMainLogic(){
    if(isset($_POST['submit'])){
        if($_POST['databaseName']!="" && $_POST['operation'] != "") {
            if ($_POST['databaseName'] == "mysql") {
                $pdoObject = new mySql();
            } elseif ($_POST['databaseName'] == "postgres") {
                $pdoObject = new postgresPdo();
            } else {
                $pdoObject = new sqlitePdo();
            }
            if ($pdoObject != " ") {
                $connection = $pdoObject->connectToDb();
                if (DB_INSERT == $_POST['operation']) {

                    $pdoObject->insertQuery($connection, "INSERT INTO department (dept_name ) VALUES ('HR')");
                }

                if (DB_DELETE_ROW == $_POST['operation']) {
                    $pdoObject->deleteQuery($connection);
                }

                if (DB_SELECT == $_POST['operation']) {
                    $pdoObject->viewQueryResults($connection, 'SELECT * from department');
                }


            }
            $connection=NULL;
        }
        else {
            echo 'Please select database name and Operation.';
        }

    }
}

?>


<h2>PDO Basics</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name ="databaseName">
        <option value=" ">Select Database</option>
        <option value="mysql">MYSQL</option>
        <option value="postgres">POSTGRES</option>
        <option value="sqlite">Sqlite</option>
    </select>
<select name="operation">
    <option value=" ">Select Operation</option>
    <option value="1">Insert</option>
    <option value="2">Delete</option>
    <option value="3">View</option>
</select>
<input name="submit" value="Submit" type="submit">
    </form>
<?php callMainLogic();?>