<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:18 PM
 */

namespace SethPhat\Multilingual\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SethPhat\Multilingual\Models\Language;

class LanguageController extends BaseController
{
    const PAGINATION_LENGTH = 15;

	/**
	 * Index Page - to see all tha languages of the system
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
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

	/**
	 * Show Create Page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function create() {
		return $this->loadView("language.create");
    }


    public function store(Request $rq) {
		$postData = $rq->all();

		$entity = new Language($postData);

		// Run Laravel Validation
		$validator = Validator::make($postData, [
			'lang_iso_code' => "required|min:2|max:5|unique:{$entity->getTable()},{$entity->getPrimaryKey()}",
			'name' => 'required|max:50'
		], [
			// lang_iso_code
			'lang_iso_code.required' => __(self::NAMESPACE . "::language.lang_iso_code.required"),
			'lang_iso_code.min' => __(self::NAMESPACE . "::language.lang_iso_code.min"),
			'lang_iso_code.max' => __(self::NAMESPACE . "::language.lang_iso_code.max"),
			'lang_iso_code.unique' => __(self::NAMESPACE . "::language.lang_iso_code.unique"),

			// name
			'name.required' => __(self::NAMESPACE . "::language.name.required"),
			'name.max' => __(self::NAMESPACE . "::language.name.max"),
		]);

		// oh la la validation XXX
		if ($validator->fails()) {
			return redirect()
						->back()
						->withErrors($validator)
						->withInput();
		}

		// ok it's safe to save now.
		$entity->save();
		return redirect()->route('lml-language.index');
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {

    }
}