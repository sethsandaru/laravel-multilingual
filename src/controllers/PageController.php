<?php


namespace SethPhat\Multilingual\Controllers;


class PageController extends BaseController
{
    public function index() {
        return $this->loadView('page.index');
    }
}