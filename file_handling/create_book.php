<?php
/*
 * creates files
 * 
 */
function createFile() {
    try {
        if (isset($_POST['createBook'])) {
            if ($_POST['bookName'] != "" && $_POST['bookContent'] !="") {
                //preg_replace(“/[^a-z0-9\.]/”, “”, strtolower($str));
                $fileName = $_POST['bookName'] . '.txt';
                $fileHandler = fopen($fileName, "w");
                if (!$fileHandler) {
                    throw new Exception('Unable to open file.');
                }

                $bookName = $_POST['bookName'] . "\n";
                fwrite($fileHandler, $bookName);
                $bookContent = $_POST['bookContent'] . "\n";
                fwrite($fileHandler, $bookContent);
                fclose($fileHandler);
                echo 'Book created successfully';
            }
         else {
             throw new Exception('Values are blank.');
         }   
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
createFile();
?>
<h2>Create Book </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
    Book Name: <input type="text" name="bookName"><br/><br/>
    Book Content: <textarea name="bookContent" rows="5" cols="40"></textarea><br/><br/>
    <input type="submit" value="Create Book" name="createBook">
</form>
