<?php
namespace models;

class Journal extends Document {
    public $issueNumber;
    public $monthIssue;

    public function __construct($journal) {
        parent::__construct($journal);
        $this->issueNumber = $journal["issueNumber"];
        $this->monthIssue = $journal["monthIssue"];
    }
}
?>