<?php
$conn = mysqli_connect("localhost", "root", "test", "phpsamples");

$affectedRow = 0;

$xml = simplexml_load_file("input.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $title = $row->title;
    $link = $row->link;
    $description = $row->description;
    $keywords = $row->keywords;
    
    $sql = "INSERT INTO tbl_tutorials(title,link,description,keywords) VALUES ('" . $title . "','" . $link . "','" . $description . "','" . $keywords . "')";
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "n";
    }
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

?>

<?php //insertarXML(totalVariables, variables["nombres"], fichero);?>