<?php

namespace app;

use \core\Controller;

class HomeController extends Controller {
    public function index() {
        $data = ['title' => 'Welcome to the SnapPHP Framework'];
        $this->loadView('home/main', $data);
    }

    public function about() {
        $data = [
            'title' => 'About SnapPHP Framework',
            'about' => 'This is a light weight framework by dinzin'
        ];

        $this->loadView('home/about', $data);
    }
}
