<?php


namespace SethPhat\Multilingual\controllers;


use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{

    /**
     * Return view for controller actions
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function loadView($view = "", $data = []) {
        return view('multilingual::' . $view, $data);
    }
}