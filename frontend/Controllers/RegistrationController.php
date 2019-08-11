<?php

namespace Frontend\Controllers;

use Frontend\System\FrontendController;
use System\Core\Auth;
use System\Core\Response;
use System\Core\Request;
use Common\Models\User;

class RegistrationController extends FrontendController {
    /**
     * @var string
     */
    public $registrationStatus = '';

    public function indexAction() {
        $this->view->set([
            'title' => 'Registration',
        ]);

        if (isset($this->request->post['submit'])) {
            $params = [
                'login' => $this->request->post['login'],
                'password' => $this->request->post['password'],
                'email' => $this->request->post['email'],
                'firstname' => $this->request->post['firstname'],
                'lastname' => $this->request->post['lastname'],
            ];

            $user = new User();
            if($user->add($params)) {
                $url = '/regstration/?status=success';
                Response::redirect($url);
            }
        }

        $this->assets->addJs('https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js');
        $this->view->render('index');
    }
}