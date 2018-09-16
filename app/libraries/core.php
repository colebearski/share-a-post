<?php

// App Core Class
// Creates URL and loads core controller
// URL FORMat - /controller/method/params

class Core {
    // protected properties and methods
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        // print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in Controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // ^^ defining our path as if we're in index.php
            // ^^ if the url exists set it as the current controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
        }
        
        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        // INstantiate controller class
        $this->currentController = new $this->currentController;

    }

    public function getUrl() {
        // Need to check and ensure it's set to avoid error when no url param is passed
        if (isset($_GET['url'])) {
        // ^^ if the varialbe is set do this
            $url = rtrim($_GET['url'], '/');
            // ^^ trim the / from url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // ^^ filter url varialbe so it is only used as a url
            $url = explode('/', $url);
            // ^^ cuts each url param and provides them in an array
            return $url;
        }
    }

    // Instantiating Core Class in public/index.php

}