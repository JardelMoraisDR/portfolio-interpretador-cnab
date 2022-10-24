<?php

include 'Cnab/Cnab240/Archive.php';

class InterpretationController 
{
    
    private $fileContent;

    public static function index()
    {

        $fileContent = '';
        $fp = fopen($_FILES['archiveReturn']['tmp_name'], 'rb');
        while ( ($line = fgets($fp)) !== false) {
          $fileContent .= strval($line) . '|';
        }

        $archiveCnab = new Archive($fileContent);
        $archiveJson = $archiveCnab->GetJson();

        InterpretationController::save($archiveJson);

        include 'Views/InterpretationView.php';

    }

    private static function save($archiveJson)
    {
       include 'Models/InterpretationModel.php';

       $model = new InterpretationModel();

       $model->createdAt = date('d/m/y');
       $model->jsonReturn = $archiveJson;

       $model->save(); 
    }

}