<?php 

require(__DIR__ . '/Connection.php');
require(__DIR__ . '/../repository/ProductRepository.php');

$pdo = new Connection();
$conn = $pdo->getConnection();
$repository = new ProductRepository($conn);

$repository->deleteProduct($_POST['id']);

header('Location: ../../admin.php');