<?php

class InterpretationModel
{

    public $id, $createdAt, $jsonReturn;

    public $rows;

    public function save()
    {
        include 'DAO/InterpretationDAO.php';

        $dao = new InterpretationDAO(); 

        if(empty($this->id))
        {
            $dao->insert($this);
        }  
    }

    public function getAllRows()
    {
        include 'DAO/InterpretationDAO.php';
        
        $dao = new InterpretationDAO();

        $this->rows = $dao->select();
    }

}