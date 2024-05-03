<?php

require(__DIR__ . '/Connection.php');
require(__DIR__ . '/../repository/ProductRepository.php');

$pdo = new Connection();
$conn = $pdo->getConnection();
$repository = new ProductRepository($conn);
$resultList = $repository->getAllProducts();

$typeCafe = array_filter($resultList, function ($current) {
    return $current->getType() == 'Café';
});

$typeAlmoco = array_filter($resultList, function ($current) {
    return $current->getType() == 'Almoço';
});
