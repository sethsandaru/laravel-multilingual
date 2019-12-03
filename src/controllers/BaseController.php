<?php


namespace SethPhat\Multilingual\controllers;


use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    const NAMESPACE = "multilingual";

    /**
     * Return view for controller actions
     * @param string $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function loadView($view = "", $data = []) {
        $base_data = [
            'namespace' => static::NAMESPACE
        ];

        // extends...
        $data = array_merge($base_data, $data);

        return view(static::NAMESPACE . '::' . $view, $data);
    }
}