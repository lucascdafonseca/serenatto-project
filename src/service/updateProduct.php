<?php

require(__DIR__ . '/Connection.php');
require(__DIR__ . '/../repository/ProductRepository.php');

$pdo = new Connection();
$conn = $pdo->getConnection();
$repository = new ProductRepository($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productToUpdate = $repository->findProductById($id);
}

if (isset($_GET['idToUpdate'])) {
    $productToUpdate = new Product(
        $_GET['idToUpdate'],
        $_POST['type'],
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image']
    );

    $repository->updateProduct($productToUpdate);

    header('Location: ../../admin.php');
}