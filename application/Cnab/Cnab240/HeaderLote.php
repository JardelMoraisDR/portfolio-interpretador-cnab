<?php

class HeaderLote
{
    private $fileContent;
    private $headerLoteContent;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;
        
        if(!empty($this->fileContent)){
            $this->headerLoteContent =  explode('|', $fileContent)[1]; //De: 1 - Para: 240
        }
        
    }

    public function GetBanco($codOrigem){
        $banco = substr($this->headerLoteContent, 0, 3); //De: 1 - Para: 3 | Nº Dig.: 3
        if(!is_numeric($banco) || $banco != $codOrigem){
            throw new Exception('Header do lote: O campo banco é inválido.');
        }
        return $banco;
    }

    public function GetTipoRegistro(){
        $tipoRegistro = substr($this->headerLoteContent, 7, 1); //De: 8 - Para: 8 | N° Dig.: 1
        if($tipoRegistro != '1'){
            throw new Exception('Header do lote: O campo tipo registro é inválido.');
        }
        return $tipoRegistro;
    }

    public function GetModalidadeAverbacao(){
        return substr($this->headerLoteContent, 8, 1); 
    }

    public function GetTipoServico(){
        return substr($this->headerLoteContent, 9, 2); //De: 10 - Para: 11 | N° Dig.: 2
    }

    // public function GetTipoServico(){
    //     $tipoServico = substr($this->headerLoteContent, 9, 2); //De: 10 - Para: 11 | N° Dig.: 2
    //     if(strval($tipoServico) != '09' && strval($tipoServico) != '11'){
    //         throw new Exception('Header do lote: O campo tipo serviço é inválido.');
    //     }
    //     return $tipoServico;
    // }

    public function GetVersaoLayout(){
        return substr($this->headerLoteContent, 11, 3); //De: 12 - Para: 14 | N° Dig.: 3
    }

    public function GetLoteServico(){
        return substr($this->headerLoteContent, 20, 4); //De: 21 - Para: 24 | Nº Dig.: 4
    }

    public function GetTipoInscricao(){
        $tipoInscricao = substr($this->headerLoteContent, 31, 1); //De: 32 - Para: 32 ! Nº Dig.: 1
        if($tipoInscricao != '2'){
            throw new Exception('Header do lote: O campo tipo inscrição é inválido.');
        }
    }

    public function GetCNPJ(){
        return substr($this->headerLoteContent, 32, 14); //De: 33 - Para: 46 ! Nº Dig: 14
    }

    public function GetHeaderLote($codBanco){
        
        include 'Models/Cnab/Cnab240/HeaderLoteModel.php';
        $headerLote = new HeaderLoteModel();

        try{
            $headerLote->banco = $this->GetBanco($codBanco);
            $headerLote->tipoRegistro = $this->GetTipoRegistro();
            $headerLote->modalidadeAverbacao = $this->GetModalidadeAverbacao();
            $headerLote->tipoServico = $this->GetTipoServico();
            $headerLote->versaoLayout = $this->GetVersaoLayout();
            $headerLote->loteServico = $this->GetLoteServico();
            $headerLote->tipoInscricao = $this->GetTipoInscricao();
            $headerLote->cnpj = $this->GetCNPJ();

            return $headerLote;
        }catch(Exception $e){
            echo '[Header Lote] Houve uma excessão: ',  $e->getMessage(), "\n";
        }

    }

}