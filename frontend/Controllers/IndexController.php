<?php

namespace Frontend\Controllers;

use Frontend\System\FrontendController;

class IndexController extends FrontendController {
    public function indexAction() {
        $this->view->set([
            'title' => 'Index Page',
        ]);

        $this->view->render('index');
    }
}