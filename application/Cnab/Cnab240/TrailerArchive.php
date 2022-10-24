<?php

class TrailerArchive
{
    private $fileContent;
    private $trailerContent;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;

        if(!empty($this->fileContent)){
            $positionTrailerContent = count(explode('|', $fileContent)) - 2; 
            $this->trailerContent = explode('|', $fileContent)[$positionTrailerContent]; //De: 1 - Para: 240
        }
    }
    
    public function GetBanco($codOrigem){
        $banco = substr($this->trailerContent, 0, 3); //De: 1 - Para: 3 | Nº Dig.: 3
        if(!is_numeric($banco) || $banco != $codOrigem){
            throw new Exception('Trailer do arquivo: O campo banco é inválido.');
        }
        return $banco;
    }

    public function GetLoteServico(){
        $loteServico = substr($this->trailerContent, 3, 4); //De: 4 - Para: 7 | Nº Dig.: 4
        if(strval($loteServico) != '9999'){
            throw new Exception('Trailer do arquivo: Lote de serviço é diferente de 9999.');
        }
        return $loteServico;
    }

    public function GetTipoRegistro(){
        $tipoRegistro = substr($this->trailerContent, 7, 1); //De: 8 - Para: 8 | N° Dig.: 1
        if(strval($tipoRegistro) != '9'){
            throw new Exception('Trailer do arquivo: Tipo de registro é diferente de 9.');
        }
        return $tipoRegistro;
    }

    public function GetQtdeLotesArquivo(){
        return substr($this->trailerContent, 17, 6); //De: 18 - Para: 23 ! Nº Dig.: 6
    }

    public function GetQtdeRegistrosArquivo(){
        return substr($this->trailerContent, 23, 6); //De: 24 - Para: 29 ! Nº Dig.: 6
    }

    public function GetTrailerArchive($codBanco){
        
        include 'Models/Cnab/Cnab240/TrailerArchiveModel.php';
        $trailerArchive = new TrailerArchiveModel();

        try{
            $trailerArchive->banco = $this->GetBanco($codBanco);
            $trailerArchive->loteServico = $this->GetLoteServico();
            $trailerArchive->tipoRegistro = $this->GetTipoRegistro();
            $trailerArchive->qtdeLotesArquivo = $this->GetQtdeLotesArquivo();
            $trailerArchive->qtdeRegistrosArquivo = $this->GetQtdeRegistrosArquivo();

            return $trailerArchive;
        }catch(Exception $e){
            echo '[Trailer Archive] Houve uma excessão: ',  $e->getMessage(), "\n";
        }

    }

}