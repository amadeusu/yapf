<?php

namespace Frontend\Widgets;

use System\Core\Widget;

class HelloWidget extends Widget {
    /**
     * @var string
     */
    public $username = '';

    public function run() {
        $this->render('hello', [
            'username' => $this->username,
        ]);
    }
}