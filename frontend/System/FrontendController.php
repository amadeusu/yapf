<?php

namespace Frontend\System;

use System\Core\Controller;
use Frontend\System\Asset;

class FrontendController extends Controller {
    /**
     * @var Asset
     */
    public $assets;

    public function __construct(){
        $this->assets = new Asset();
    }
}