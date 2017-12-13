
<?php
$conn = mysqli_connect('localhost', 'root', '', 'gestao_escolar');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');
// TODO: insert your code here.
