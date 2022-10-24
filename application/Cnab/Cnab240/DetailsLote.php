<?php

class DetailsLote
{
    private $fileContent;
    private $detailsContent;

    public $headerJson;
    public $numberRegisters;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;
        
        if(!empty($this->fileContent)){
            $headerArchiveLine = 0;
            $headerLoteLine = 1;
            $trailerArchiveLine = count(explode('|', $fileContent)) - 2;
            $trailerLoteLine = count(explode('|', $fileContent)) - 3;
            $nullLine = count(explode('|', $fileContent)) - 1;

            $this->detailsContent = explode('|', $fileContent);
            unset($this->detailsContent[$headerArchiveLine]);
            unset($this->detailsContent[$headerLoteLine]);
            unset($this->detailsContent[$trailerLoteLine]);
            unset($this->detailsContent[$trailerArchiveLine]);
            unset($this->detailsContent[$nullLine]);

            $this->detailsContent = array_values($this->detailsContent);
            $this->numberRegisters = count($this->detailsContent);
        }
        
    }

    private function GetBanco($currentDetail){
        return substr($currentDetail, 0, 3); //De: 1 - Para: 3 | N° Dig.: 3
    }

    private function GetLoteServico($currentDetail){
        return substr($currentDetail, 3, 4); //De: 4 - Para: 7 | N° Dig.: 4
    }

    private function GetTipoRegistro($currentDetail){
        return substr($currentDetail, 7, 1); //De: 8 - Para: 8 | N° Dig.: 1
    }

    private function GetNumSequencialRegistro($currentDetail){
        return substr($currentDetail, 8, 5); //De: 9 - Para: 13 | N° Dig.: 5
    }

    private function GetCodSegmento($currentDetail){
        return substr($currentDetail, 13, 1); //De: 14 - Para: 14 | N° Dig.: 1
    }

    private function GetTipoMovimento($currentDetail){
        return substr($currentDetail, 14, 1); //De: 15 - Para: 15 | N° Dig.: 1
    }    

    private function GetNomeMutuario($currentDetail){
        return substr($currentDetail, 15, 30); //De: 16 - Para: 45 | N° Dig.: 30
    }        

    private function GetCodUnidade($currentDetail){
        return substr($currentDetail, 45, 6); //De: 46 - Para: 51 | N° Dig.: 6
    }        

    private function GetCpfMutuario($currentDetail){
        return substr($currentDetail, 51, 11); //De: 52 - Para: 62 | N° Dig.: 11
    }        

    private function GetIdMutuario($currentDetail){
        return substr($currentDetail, 62, 12); //De: 63 - Para: 74 | N° Dig.: 12
    }        

    private function GetTipoOperacaoCredito($currentDetail){
        return substr($currentDetail, 96, 1); //De: 97 - Para: 97 | N° Dig.: 1
    }      
    
    private function GetDataVencimentoParcela($currentDetail){
        return substr($currentDetail, 99, 6); //De: 100 - Para: 105 | N° Dig.: 6
    }        

    private function GetQtdeParcelasContrato($currentDetail){
        return substr($currentDetail, 107, 2); //De: 108 - Para: 109 | N° Dig.: 2
    }            

    private function GetDataInicioContrato($currentDetail){
        return substr($currentDetail, 109, 8); //De: 110 - Para: 117 | N° Dig.: 8
    }            

    private function GetDataFimContrato($currentDetail){
        return substr($currentDetail, 117, 8); //De: 118 - Para: 125 | N° Dig.: 8
    }            

    private function GetValorTotalLiberado($currentDetail){
        return substr($currentDetail, 125, 7); //De: 126 - Para: 134 | N° Dig.: 7
    }            

    private function GetValorTotalOperacao($currentDetail){
        return substr($currentDetail, 134, 7); //De: 135 - Para: 143 | N° Dig.: 7
    }            

    private function GetValorParcela($currentDetail){
        return substr($currentDetail, 143, 7); //De: 144 - Para: 152 | N° Dig.: 7
    }            

    private function GetIdContrato($currentDetail){
        return substr($currentDetail, 161, 7); //De: 162 - Para: 181 | N° Dig.: 20
    }            

    private function GetAgencia($currentDetail){
        return substr($currentDetail, 202, 7); //De: 203 - Para: 207 | N° Dig.: 5
    }  

    private function GetNumConta($currentDetail){
        return substr($currentDetail, 208, 7); //De: 209 - Para: 220 | N° Dig.: 12
    }      

    private function GetDigitoConta($currentDetail){
        return substr($currentDetail, 220, 1); //De: 221 - Para: 221 | N° Dig.: 1
    }      

    public function GetDetails(){
        
        include 'Models/Cnab/Cnab240/DetailsLoteModel.php';

        try{
            $registerList = array();

            foreach($this->detailsContent as $item){  
    
                $detailModel = new DetailsLoteModel();
                $detailModel->banco = $this->GetBanco($item);
                $detailModel->loteServico = $this->GetLoteServico($item);
                $detailModel->tipoRegistro = $this->GetTipoRegistro($item);
                $detailModel->numSequencialRegistro = $this->GetNumSequencialRegistro($item);
                $detailModel->codSegmento = $this->GetCodSegmento($item);
                $detailModel->tipoMovimento = $this->GetTipoMovimento($item);
                $detailModel->nomeMutuario = $this->GetNomeMutuario($item);
                $detailModel->codUnidade = $this->GetCodUnidade($item);
                $detailModel->cpfMutuario = $this->GetCpfMutuario($item);
                $detailModel->idMutuario = $this->GetIdMutuario ($item);
                $detailModel->tipoOperacaoCredito = $this->GetTipoOperacaoCredito($item);
                $detailModel->dataVencimentoParcela = $this->GetDataVencimentoParcela($item);
                $detailModel->qtdeParcelasContrato = $this->GetQtdeParcelasContrato($item);
                $detailModel->dataInicioContrato = $this->GetDataInicioContrato($item);
                $detailModel->dataFimContrato = $this->GetDataFimContrato($item);
                $detailModel->valorTotalLiberado = $this->GetValorTotalLiberado($item);
                $detailModel->valorTotalOperacao = $this->GetValorTotalOperacao($item);
                $detailModel->valorParcela = $this->GetValorParcela($item);
                $detailModel->idContrato = $this->GetIdContrato($item);
                $detailModel->agencia = $this->GetAgencia($item);
                $detailModel->numConta = $this->GetNumConta($item);
                $detailModel->digitoConta = $this->GetDigitoConta($item);

                $registerList[] = $detailModel;
            }
            return $registerList;

        }catch(Exception $e){
            echo '[Details] Houve uma excessão: ',  $e->getMessage(), "\n";
        }

    }

}