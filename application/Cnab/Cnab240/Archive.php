<?php

include 'Cnab/Cnab240/HeaderArchive.php';
include 'Cnab/Cnab240/TrailerArchive.php';

include 'Cnab/Cnab240/HeaderLote.php';
include 'Cnab/Cnab240/TrailerLote.php';
include 'Cnab/Cnab240/DetailsLote.php';


class Archive
{

    private $fileContent;

    private $headerModel;
	private $headerLoteModel;
	private $detailsLoteModel;
	private $trailerLoteModel;
	private $trailerModel;

    public function __construct($fileContent)
    {
        $this->fileContent = $fileContent;

        $archiveHeader = new HeaderArchive($fileContent);
        $archiveTrailer = new TrailerArchive($fileContent);
        
        $headerLote = new HeaderLote($fileContent);
        $trailerLote = new TrailerLote($fileContent);
        $detailsLote = new DetailsLote($fileContent);       

        $this->headerModel = $archiveHeader->GetHeader();
        $this->headerLoteModel = $headerLote->GetHeaderLote($this->headerModel->banco);
        $this->detailsLoteModel = $detailsLote->GetDetails();
        $this->trailerLoteModel = $trailerLote->GetTrailerLote($this->headerModel->banco);
        $this->trailerModel = $archiveTrailer->GetTrailerArchive($this->headerModel->banco);

    }

    public function GetJson()
    {
        $jsonInterpretation = json_encode(array("header_archive" => $this->headerModel,
                                                "header_lote" => $this->headerLoteModel,
                                                "details" => $this->detailsLoteModel,
                                                "trailer_lote" => $this->trailerLoteModel,
                                                "trailer_archive" => $this->trailerModel), JSON_PRETTY_PRINT);

        return $jsonInterpretation;
    }

}