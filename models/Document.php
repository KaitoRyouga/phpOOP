<?php
namespace models;

abstract class Document {
    
    public $code;
    public $publisher;
    public $releaseNumber;

    public function __construct($document) {
        
        $this->code = $document["code"];
        $this->publisher = $document["publisher"];
        $this->releaseNumber = $document["releaseNumber"];
    }

}
?>