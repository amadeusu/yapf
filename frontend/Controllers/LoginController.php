<?php

namespace Frontend\Controllers;

use Frontend\System\FrontendController;
use System\Core\Auth;
use System\Core\Response;
use System\Core\Request;

class LoginController extends FrontendController {
    /**
     * @var string
     */
    public $authStatus = '';

    public function indexAction() {
        $this->view->set([
            'title' => 'Login',
        ]);

        if (isset($this->request->post['login']) && isset($this->request->post['password'])) {
            $auth = $this->di->get('auth');
            if ($auth->auth($this->request->post['login'], $this->request->post['password'])) {
                Response::redirect('/');
            } else {
                $this->authStatus = 'error';
            }
        }

        $this->view->render('index');
    }

    public function logoutAction() {
        Auth::logout();
        Response::redirect('/');
    }
}