<?php
require __DIR__ . '/../vendor/autoload.php';
$db = new PDO('sqlite:' . __DIR__ . '/database.sqlite');
$stmt = $db->query('SELECT count(*) as c FROM users');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo 'users=' . ($row['c'] ?? '0') . PHP_EOL;
$stmt = $db->query('SELECT email, name FROM users LIMIT 5');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['email'] . ' | ' . $row['name'] . PHP_EOL;
}
