<?php

require(__DIR__ . '/../entity/Product.php');

class ProductRepository
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAllProducts()
    {
        $statement = $this->conn->query('SELECT * FROM products');
        $resultSet = $statement->fetchAll();

        $result = array_map(function ($product) {
            return new Product(
                $product['id'],
                $product['type'],
                $product['name'],
                $product['description'],
                $product['image'],
                $product['price']
            );
        }, $resultSet);

        return $result;
    }

    public function deleteProduct(int $id)
    {
        $query = 'DELETE FROM products WHERE id = :id;';
        $preparedStatement = $this->conn->prepare($query);
        $preparedStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $preparedStatement->execute();
    }
}
