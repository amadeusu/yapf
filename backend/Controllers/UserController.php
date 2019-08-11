<?php

namespace Backend\Controllers;

use Backend\System\BackendController;
use System\Adapter\Eloquent;
use Common\Models\User;
use System\Libraries\Pagination;

class UserController extends BackendController {
    /**
     * @var User
     */
    public $users;

    public function __construct() {
        parent::__construct();
    }

    public function indexAction() {
        $this->view->set([
            'title' => 'Users',
        ]);

        $this->users = User::orderBy('login', 'ASC')->get();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination();
        $this->pages = $pagination->setCurrentPage($page)
                        ->setRecorndCount(200)
                        ->setPerPageLimit(10)
                        ->setMaxPagesCount(8)
                        ->getPages();

        $this->view->render('index');
    }
}