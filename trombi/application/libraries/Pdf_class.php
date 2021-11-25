<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (TCPDF_PATH);

class PDF_class extends TCPDF {
    
    public function __construct() {
        parent::__construct();
    }
}