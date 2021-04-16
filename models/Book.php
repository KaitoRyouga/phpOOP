<?php
namespace models;

class Book extends Document {
    public $author;
    public $numberPage;

    public function __construct($book) {
        parent::__construct($book);
        $this->author = $book["author"];
        $this->numberPage = $book["numberPage"];
    }
}
?>