<?php
namespace models;

class Newspaper extends Document {
    public $dayIssue;

    public function __construct($newspaper) {
        parent::__construct($newspaper);
        $this->dayIssue = $newspaper["dayIssue"];
    }
}
?>