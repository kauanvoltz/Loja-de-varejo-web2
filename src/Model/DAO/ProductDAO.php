<?php

namespace APP\Model\DAO;

use APP\Model\Connection;
use PDO;

class ProductDAO implements DAO
{

    public function insert($object)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare("INSERT INTO product VALUES (null,?,?,?)");
        $stmt->bindParam(1, $object->name);
        $stmt->bindParam(2, $object->price);
        $stmt->bindParam(3, $object->quantity);
        return $stmt->execute();
    }
    public function findOne($id)
    {
    }
    public function findAll()
    {
        $connection = Connection::getConnection();
        $stmt = $connection->query("select * from product;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($object)
    {
    }
    public function delete($id)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare('delete from product where product_code = ?');
        $stmt->bindParam(1,$id);
        return $stmt->execute();
    }
}
