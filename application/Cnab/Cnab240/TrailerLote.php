<?php

class TrailerLote
{
    private $fileContent;
    private $trailerLoteContent;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;

        if(!empty($this->fileContent)){
            $positionTrailerLoteContent = count(explode('|', $fileContent)) - 3; 
            $this->trailerLoteContent = explode('|', $fileContent)[$positionTrailerLoteContent]; //De: 1 - Para: 240
        }
    }
    

    public function GetBanco($codOrigem){
        $banco = substr($this->trailerLoteContent, 0, 3); //De: 1 - Para: 3 | Nº Dig.: 3
        if(!is_numeric($banco) || $banco != $codOrigem){
            throw new Exception('Trailer do lote: O campo banco é inválido.');
        }
        return $banco;
    }

    public function GetLoteServico(){
        return substr($this->trailerLoteContent, 3, 4); //De: 4 - Para: 7 | Nº Dig.: 4
    }

    // public function GetLoteServico(){
    //     $loteServico = substr($this->trailerLoteContent, 3, 4); //De: 4 - Para: 7 | Nº Dig.: 4
    //     if(strval($loteServico) != "9999"){
    //         throw new Exception('Trailer do lote: Lote de serviço é diferente de 9999.');
    //     }
    //     return $loteServico;
    // }

    public function GetTipoRegistro(){
        return substr($this->trailerLoteContent, 7, 1); //De: 8 - Para: 8 | N° Dig.: 1
    }

    // public function GetTipoRegistro(){
    //     $tipoRegistro = substr($this->trailerLoteContent, 7, 1); //De: 8 - Para: 8 | N° Dig.: 1
    //     if(strval($tipoRegistro) != '9'){
    //         throw new Exception('Trailer do lote: Tipo de registro é diferente de 9.');
    //     }
    //     return $tipoRegistro;
    // }

    public function GetQtdeRegistrosLote(){
        return substr($this->trailerLoteContent, 15, 6); //De: 16 - Para: 21 | N° Dig.: 6
    }

    public function GetTotalDeParcelasEnviadas(){
        return substr($this->trailerLoteContent, 21, 5); //De: 22 - Para: 26 | N° Dig.: 5
    }

    public function GetTotalValoresParcelas(){
        return substr($this->trailerLoteContent, 26, 14); //De: 26 - Para: 41 | N° Dig: 14
    }    

    public function GetTrailerLote($codBanco){
        
        include 'Models/Cnab/Cnab240/TrailerLoteModel.php';
        $trailerLote = new TrailerLoteModel();

        try{
            $trailerLote->banco = $this->GetBanco($codBanco);
            $trailerLote->loteServico = $this->GetLoteServico();
            $trailerLote->tipoRegistro = $this->GetTipoRegistro();
            $trailerLote->qtdeRegistrosLote = $this->GetQtdeRegistrosLote();
            $trailerLote->totalDeParcelasEnviadas = $this->GetTotalDeParcelasEnviadas();
            $trailerLote->totalValoresParcelas = $this->GetTotalValoresParcelas();

            return $trailerLote;
        }catch(Exception $e){
            echo '[Trailer Lote] Houve uma excessão: ',  $e->getMessage(), "\n";
        }

    }

}