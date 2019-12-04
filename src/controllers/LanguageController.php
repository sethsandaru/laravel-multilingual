<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:18 PM
 */

namespace SethPhat\Multilingual\Controllers;


use SethPhat\Multilingual\Models\Language;

class LanguageController extends BaseController
{
    const PAGINATION_LENGTH = 15;

    public function index() {
        $query = Language::query();
        $keyword = request()->get('keyword');

        if (!empty($keyword)) {
            $query->orWhere('lang_iso_code', 'LIKE', "%{$keyword}%");
            $query->orWhere('name', 'LIKE', "%{$keyword}%");
        }

        // retrieve languages
        $languages = $query->paginate(static::PAGINATION_LENGTH);

        return $this->loadView('language.index', compact('languages'));
    }

    public function create() {

    }

    public function store() {

    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {

    }
}