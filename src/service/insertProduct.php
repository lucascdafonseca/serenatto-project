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


if ($_FILES['image']['size'] > 0) {
    $productToInsert->setImageFileName(uniqid() . $_FILES['image']['name']);
    $result = move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $productToInsert->getFixedImageFileName());
}

$repository->insertProduct($productToInsert);

header('Location: ../../admin.php');
