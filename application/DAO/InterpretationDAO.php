<?php

class InterpretationDAO
{

    private $connectionMySql;

    public function __construct()
    {
        $dataSource = "mysql:host=localhost:3306;dbname=portfolio-interpretation-cnab";
        $this->connectionMySql = new PDO($dataSource, 'root', '');
    }

    public function insert(InterpretationModel $model)
    {
        $sql = "INSERT INTO interpretation (createdAt, jsonReturn) VALUES (?, ?)";

        $stmt = $this->connectionMySql->prepare($sql);
        $stmt->bindValue(1, $model->createdAt);
        $stmt->bindValue(2, $model->jsonReturn);

        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM interpretation";

        $stmt = $this->connectionMySql->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);        
    }

}