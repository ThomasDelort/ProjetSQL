<?php

try {
    $database = new PDO('mysql:host=localhost;dbname=store','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));  
}
catch(Exception $e)
{
    die();
}

$results = $database->query('SELECT first_name, last_name FROM customers');

while($row = $results->fetch())
{
    echo $row['first_name'].'<br>';
}

?>