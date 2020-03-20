<?php
// Создание table с помощью MySQLi
// create.table.php
$servername = "localhost";
$username = "root";
$password = "ghbdtn";
$dbname = "store";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("\nНе удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
echo "Connected successfully\n\n";

$sql = "CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(25) NOT NULL,
    status tinyInt(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
 );";
 

// Create table

if (mysqli_query($conn, $sql)) {
    echo "\nTable categories created successfully\n\n";

} else {
    printf("\nError creating table: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
