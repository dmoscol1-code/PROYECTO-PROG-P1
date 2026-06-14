<?php
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
foreach ($db->query('PRAGMA table_info(libros)') as $row) {
    echo $row['name'] . PHP_EOL;
}
