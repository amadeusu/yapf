<?php

namespace Backend\System;

use System\Core\Controller;
use System\Core\Auth;
use System\Core\Response;
use Backend\System\Asset;

class BackendController extends Controller {
    /**
     * @var Asset
     */
    public $assets;

    public function __construct() {
        if (!Auth::isAuth()){
            Response::redirect('/login/');
        }

        $this->assets = new Asset();
    }
}