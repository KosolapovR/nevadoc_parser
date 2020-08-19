<?php


namespace App\Classes;


class DB
{
    private \PDO $pdo;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    public function addPattern(Pattern $pattern)
    {
        $sql = 'INSERT INTO products (seller, pattern, name, size, color, material, sleeve, print) 
                VALUES (:seller, :pattern, :productName, :size, :color, :material, :sleeve, :print)';

        $stm = $this->pdo->prepare($sql);

        return $stm->execute(
            [
                ':seller' => $pattern->getSeller(),
                ':pattern' => $pattern->getPattern(),
                ':productName' => $pattern->getProductName(),
                ':size' => $pattern->getSize(),
                ':color' => $pattern->getColor(),
                ':material' => $pattern->getMaterial(),
                ':sleeve' => $pattern->getSleeve(),
                ':print' => $pattern->getPrint()
            ]
        );
    }

    public function findProduct(string $pattern)
    {
        $query = "SELECT DISTINCT p.name FROM products p WHERE p.name LIKE ?";
        $params = array("%$pattern%");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductByPattern(string $pattern){
        $sql = "SELECT p.name, p.size, p.color, p.material, p.sleeve, p.print 
                FROM products p 
                WHERE p.pattern = :pattern";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(
            [
                ':pattern' => $pattern,
            ]
        );
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function connect()
    {
        try {
            $this->pdo = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}