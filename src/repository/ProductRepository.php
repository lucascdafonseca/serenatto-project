<?php

require(__DIR__ . '/../entity/Product.php');

class ProductRepository
{
    const PRODUCTS_TABLE_NAME = "products";
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    private function toProductDto(array $product): Product
    {
        return new Product(
            $product['id'],
            $product['type'],
            $product['name'],
            $product['description'],
            $product['price'],
            $product['image']
        );
    }

    public function getAllProducts()
    {
        $statement = $this->conn->query('SELECT * FROM ' . self::PRODUCTS_TABLE_NAME);
        $resultSet = $statement->fetchAll();

        $result = array_map(function ($product) {
            return $this->toProductDto($product);
        }, $resultSet);

        return $result;
    }

    public function deleteProduct(int $id)
    {
        $query = 'DELETE FROM ' . self::PRODUCTS_TABLE_NAME . ' WHERE id = :id;';
        $preparedStatement = $this->conn->prepare($query);
        $preparedStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $preparedStatement->execute();
    }

    public function insertProduct(Product $product): void
    {
        $query = 'INSERT INTO ' . self::PRODUCTS_TABLE_NAME . ' (type,name,description,image,price) VALUES (:type, :name, :description, :image, :price);';
        $preparedStatement = $this->conn->prepare($query);
        $preparedStatement->bindValue(':type', $product->getType(), PDO::PARAM_STR);
        $preparedStatement->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $preparedStatement->bindValue(':description', $product->getDescription(), PDO::PARAM_STR);
        $preparedStatement->bindValue(':image', $product->getImageFileName(), PDO::PARAM_STR);
        $preparedStatement->bindValue(':price', $product->getPrice(), PDO::PARAM_INT);

        $preparedStatement->execute();
    }

    public function findProductById(int $id): Product
    {
    
        $query = 'SELECT * FROM ' . self::PRODUCTS_TABLE_NAME . ' WHERE id = :id';
        $preparedStatement = $this->conn->prepare($query);
        $preparedStatement->bindValue(':id', $id);
        $preparedStatement->execute();
        $result = $preparedStatement->fetch();

        return $this->toProductDto($result);
    }

    public function updateProduct(Product $product)
    {
        $query = 'UPDATE ' . self::PRODUCTS_TABLE_NAME . ' SET type = :type, name = :name, description = :description, image = :image, price = :price WHERE id = :id;';
        $preparedStatement = $this->conn->prepare($query);
        $preparedStatement->bindValue(':type', $product->getType());
        $preparedStatement->bindValue(':name', $product->getName());
        $preparedStatement->bindValue(':description', $product->getDescription());
        $preparedStatement->bindValue(':image', $product->getImageFileName());
        $preparedStatement->bindValue(':price', $product->getPrice());
        $preparedStatement->bindValue(':id', $product->getId());

        $preparedStatement->execute();
    }
}
