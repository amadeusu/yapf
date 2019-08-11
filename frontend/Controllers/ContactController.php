<?php

namespace Frontend\Controllers;

use Frontend\System\FrontendController;

class ContactController extends FrontendController {
    public function indexAction() {
        $this->view->set([
            'title' => 'Contact',
        ]);
        $this->view->render('index');
    }
}