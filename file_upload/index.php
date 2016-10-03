<?php
/*
 * main flow after form submission
 * 
 */
function callToMainLogic() {
    if (isset($_POST['submit'])) {
        if (preg_match('/[^A-Za-z]/', $_POST['userName'])) {
            echo 'Username should contain only letters' . $_POST['userName'];
            return;
        }

        if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            return;
        }
        sendDataThroughCurl();
    }
}
/*
 * configure curl opts and send data to curl
 * 
 */
function sendDataThroughCurl() {
    $url = 'http://localhost/file_upload/curl_url_page.php';
    $arrayFormatting=array();
    for($fileCounter = 0; $fileCounter < count($_FILES["filename"]["name"]); $fileCounter++){
        $fileTempName = $_FILES["filename"]["tmp_name"][$fileCounter];
        $fileType=$_FILES["filename"]["type"][$fileCounter];
        $fileName= $_FILES['filename']['name'][$fileCounter];
        $file[$fileCounter]=new CurlFile($fileTempName,$fileType,$fileName);
        $str='file['.$fileCounter.']';
        $key=array($str);
        $value=array($file[$fileCounter]);
        $makeAssociativeArray=array_combine($key,$value);
        $arrayFormatting = array_merge($arrayFormatting,$makeAssociativeArray);
        
    }
    
    $fields = array(
        'name' => urlencode($_POST['userName']),
        'email' => urlencode($_POST['userEmail']),
         );
    $fields=array_merge($arrayFormatting,$fields);
       //open connection
$curl_connection = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($curl_connection,CURLOPT_URL, $url);
curl_setopt($curl_connection,CURLOPT_POST, 1);
curl_setopt($curl_connection,CURLOPT_POSTFIELDS, $fields);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
//execute post
$result = curl_exec($curl_connection);


//close connection
curl_close($curl_connection);
}

callToMainLogic();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>

            var counter = 1;

            var limit = 5;

            function addFileGenerator(divName) {
                if (counter == limit) {

                    alert("You have reached the limit of adding " + counter + " inputs");

                } else {

                    var fileNode = document.createElement('input');
                    fileNode.setAttribute('type', 'file');
                    fileNode.setAttribute('name', 'filename[]');
                    fileNode.setAttribute('value', '');
                    document.getElementById(divName).appendChild(fileNode);

                    counter++;

                }
            }
        </script>

    </head>
    <body>
        <h3>File upload form</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"> 
            <div class="personal_info">
            Uploaded by: <input type="text" name="userName"><br/><br/>
            Email : <input type="email" name="userEmail"><br/><br/>
            </div>
            <div id="upload_image">
               Add Images :<input type="file" name="filename[]" id="filename[]">
                </div>
            <input type="button" value="+" onClick="addFileGenerator('upload_image');">
<!--            <div id="upload_xls">
                Add Excel file :<input type="file" name="filename[]" id="filename[]"><br/>
                </div>
            <div id="upload_csv">
                Add CSV file :<input type="file" name="filename[]" id="filename[]"><br/>
                </div>-->
            <input type="submit" value="Submit" name="submit">
        </form>
    </body>
</html>
