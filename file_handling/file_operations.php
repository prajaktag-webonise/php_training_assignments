<?php
/*
 * Append content to file
 * 
 */
function appendFile() {
    try {
        if (isset($_POST['appendToBook'])) {
            if ($_POST['books'] != "" && $_POST['bookContent'] !="") {
                //preg_replace(“/[^a-z0-9\.]/”, “”, strtolower($str));
                $fileName = $_POST['books'];
                $fileHandler = fopen($fileName, "a");
                if (!$fileHandler) {
                    throw new Exception('Unable to open file.');
                }

                $bookContent = $_POST['bookContent'] . "\n";
                fwrite($fileHandler, $bookContent);
                fclose($fileHandler);
                echo 'Book content apppended successfully';
            }
         else {
             throw new Exception('Values are blank.');
         }   
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
/*
 * function to display content of file
 * 
 */
function viewFile() {
    try {
        if (isset($_POST['viewBook'])) {
            if ($_POST['books'] != "") {
                //preg_replace(“/[^a-z0-9\.]/”, “”, strtolower($str));
                $fileName = $_POST['books'];
                $fileHandler = fopen($fileName, "r");
                if (!$fileHandler) {
                    throw new Exception('Unable to open file.');
                }
                $filesize = filesize( $fileName );
                $filetext = fread( $fileHandler, $filesize );
                fclose($fileHandler);
                echo ( "<pre>$filetext</pre>" );
            }
         else {
             throw new Exception('Values are blank.');
         }   
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}

/*
 * function file delete
 * 
 */
function deleteFile(){
    try {
        if (isset($_POST['deleteBook'])) {
            if ($_POST['books'] != "") {
                //preg_replace(“/[^a-z0-9\.]/”, “”, strtolower($str));
                $fileName = $_POST['books'];
                //$fileHandler = fopen($fileName, "r");
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                else {
                    throw new Exception('File does not exists');
                }
                
                echo ( "File Deleted successfully" );
            }
         else {
             throw new Exception('Values are blank.');
         }   
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}

/*
 * get list of all .txt file
 * 
 */
function fileListing(){
    
   $list='<select name="books">';
   $list.='<option value="" >Select File </option>';
   foreach (glob("*.txt") as $filename) {
    $list.= "<option value=$filename>" . $filename . "</option>";
   }
   $list.="</select>";
   return $list;
}

?>
<h2>Append Content to File </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
    Book Name: <?php echo fileListing(); ?><br/><br/>
    Append Content: <textarea name="bookContent" rows="5" cols="40"></textarea><br/><br/>
    <input type="submit" value="Append" name="appendToBook">
</form>
<?php appendFile();?>


<h2>View File Content </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
    Book Name: <?php echo fileListing(); ?>
     <input type="submit" value="View" name="viewBook">
</form>
<?php viewFile(); ?>


<h2>Delete File</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
    Book Name: <?php echo fileListing(); ?>
     <input type="submit" value="Delete" name="deleteBook">
</form>
<?php deleteFile(); ?>