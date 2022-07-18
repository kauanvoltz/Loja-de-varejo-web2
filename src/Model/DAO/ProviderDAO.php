<?php
 namespace APP\Model\DAO;

 use APP\Model\Connection;

class ProviderDAO implements DAO
{
    function insert($object)
    {
        $connection = Connection::getConnection();
        $stmt = $connection->prepare("INSERT INTO provider VALUES (?,?,?,2);");
        $stmt->bindParam(1,$object->cnpj);
        $stmt->bindParam(2,$object->name);
        $stmt->bindParam(3,$object->phone);
        return $stmt->execute();

    }
    public function findOne($id){}
    public function findAll(){}
    public function update($object){}
    public function delete($id){}


}