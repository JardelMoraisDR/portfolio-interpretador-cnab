<?php

class HeaderArchive
{
    private $fileContent;
    private $headerContent;

    public $headerJson;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;
        
        if(!empty($this->fileContent)){
            $this->headerContent = explode('|', $fileContent)[0]; //De: 1 - Para: 240
        }
    }

    public function GetBanco(){
        $banco = substr($this->headerContent, 0, 3); //De: 1 - Para: 3 | N° Dig.: 3
        if(!is_numeric($banco)){
            throw new Exception('Header do arquivo: O campo banco é inválido.');
        }
        return $banco;
    }

    public function GetLoteServico(){
        $loteServico = substr($this->headerContent, 3, 4); //De: 4 - Para: 7 | N° Dig.: 4
        if(!is_numeric($loteServico) || $loteServico != '0000'){
            throw new Exception('Header do arquivo: O campo lote de serviço é inválido.');
        }
        return $loteServico;
    }

    public function GetTipoRegistro(){
        $tipoRegistro = substr($this->headerContent, 7, 1); //De: 8 - Para: 8 | Nº Dig.: 1
        if($tipoRegistro != '0'){
            throw new Exception('Header do arquivo: Tipo de registro é diferente de 0.');
        }
        return $tipoRegistro;
    }

    public function GetLoteInscricao(){
        $loteInscricao = substr($this->headerContent, 17, 1); //De: 18 - Para: 18 | Nº Dig.: 1
        if($loteInscricao != '2'){
            throw new Exception('Header do arquivo: Lote inscrição é diferente de 2.');
        }
        return $loteInscricao;
    }   

    public function GetCNPJ(){
        return substr($this->headerContent, 18, 14); //De: 19 - Para: 32 | N° Dig.: 14
    }

    public function GetRazaoSocial(){
        $razaoSocial = substr($this->headerContent, 72, 30); //De: 73 - Para: 102 | Nº Dig.: 30
        if(empty($razaoSocial)){
            throw new Exception('Header do arquivo: Razão social é inválida.');
        }
        return $razaoSocial;
    }

    public function GetCodRemessaRetorno(){
        $codRemessaRetorno = substr($this->headerContent, 142, 1); //De: 143 - Para: 143 | Nº Dig.: 1
        if($codRemessaRetorno != '1'){ 
            throw new Exception('Header do arquivo: Código de remessa/retorno é diferente de 1.');
        }
        return $codRemessaRetorno;
    }

    public function GetVersaoLayout(){
        $versaoLayout = substr($this->headerContent, 163, 3); //De: 164 - Para: 166 | N° Dig.: 3
        if($versaoLayout != '082' && $versaoLayout != '089' && $versaoLayout != '090'){
            throw new Exception('Header do arquivo: Versão do layout inválida.');
        }
        return $versaoLayout;
    }

    public function GetHeader(){
        
        include 'Models/Cnab/Cnab240/HeaderArchiveModel.php';
        $headerArchive = new HeaderArchiveModel();

        try{
            $headerArchive->banco = $this->GetBanco();
            $headerArchive->loteServico = $this->GetLoteServico();
            $headerArchive->tipoRegistro = $this->GetTipoRegistro();
            $headerArchive->loteInscricao = $this->GetLoteInscricao();
            $headerArchive->cnpj = $this->GetCNPJ();
            $headerArchive->razaoSocial = $this->GetRazaoSocial();
            $headerArchive->codRemessaRetorno = $this->GetCodRemessaRetorno();
            $headerArchive->versaoLayout = $this->GetVersaoLayout();

            return $headerArchive;
        }catch(Exception $e){
            echo '[Header Archive] Houve uma excessão: ',  $e->getMessage(), "\n";
        }

    }

}