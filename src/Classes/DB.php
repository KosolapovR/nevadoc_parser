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
        $sql = 'INSERT INTO products (seller, pattern, product) 
                VALUES (:seller, :pattern, :productName)';
        $stm = $this->pdo->prepare($sql);
        return $stm->execute(
            [
                ':seller' => $pattern->getSeller(),
                ':pattern' => $pattern->getPattern(),
                ':productName' => $pattern->getProductName()
            ]
        );
    }

    private function connect()
    {
        try {
            $this->pdo = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
//            foreach($this->pdo->query('SELECT * from products') as $row) {
//                print_r($row);
//            }
            $pdo = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}