<?php

namespace TbUpdaterModule\SemVer;

class SemVerException extends \Exception {

    protected $version = NULL;

    function __construct($message, $version = NULL) {
        $this->version = $version;
        parent::__construct($message . ' [[' . $version . ']]');
    }

    function getVersion() {
        return $this->version;
    }

}

