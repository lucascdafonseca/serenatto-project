<?php

require(__DIR__ . '/Connection.php');
require(__DIR__ . '/../repository/ProductRepository.php');

$pdo = new Connection();
$conn = $pdo->getConnection();
$repository = new ProductRepository($conn);

$productToInsert = new Product(
    null,
    $_POST['type'],
    $_POST['name'],
    $_POST['description'],
    $_POST['price']
);

$repository->insertProduct($productToInsert);

header('Location: ../../admin.php');
