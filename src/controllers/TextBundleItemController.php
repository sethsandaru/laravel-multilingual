<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:18 PM
 */

namespace SethPhat\Multilingual\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SethPhat\Multilingual\Libraries\Events\TextBundleItemCreated;
use SethPhat\Multilingual\Libraries\Events\TextBundleItemUpdated;
use SethPhat\Multilingual\Models\LangText;
use SethPhat\Multilingual\Models\Language;
use SethPhat\Multilingual\Models\TextBundle;
use SethPhat\Multilingual\Models\TextBundleItem;

class TextBundleItemController extends BaseController
{
    /**
     * Show index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // get all text-bundle
        $text_bundle_options = TextBundle::all()->pluck('name', 'id');

        // get all languages
        $language_options = Language::all()->pluck('name', 'lang_iso_code');

        return $this->loadView('text-bundle-item.index', compact('text_bundle_options', 'language_options'));
    }

    /**
     * [API][POST] DataTable Retrieve
     * @return \Illuminate\Http\JsonResponse
     */
    public function retrieve() {
        return response()->json(TextBundleItem::getDataTable());
    }

    /**
     * [GET] Show create text bundle item page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        // get all text-bundle
        $text_bundle_options = TextBundle::all()->pluck('name', 'id');

        // get all languages
        $language_options = Language::all()->pluck('name', 'lang_iso_code');

        return $this->loadView('text-bundle-item.create', compact('text_bundle_options', 'language_options'));
    }

    /**
     * [POST] Process create new
     * @param Request $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $rq) {
        $postData = $rq->all();

        // run validator
        $validator = Validator::make($postData, TextBundleItem::getValidationRules(), TextBundleItem::getValidationMessages());

        // oh la la validation XXX
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // insert time
        DB::beginTransaction();
        try {
            // insert langText first
            $text_id = LangText::saveLangText($postData['lang_text']);

            // insert bundle item
            $bundle_item = TextBundleItem::create(array_merge($postData, [
                'text_id' => $text_id
            ]));

            // re-update the ids
            LangText::saveTextBundleId($text_id, $bundle_item->id);

            // commit changes
            DB::commit();

            // run event
            event(new TextBundleItemCreated($bundle_item));

            return redirect()
                    ->route('lml-text-bundle-item.index')
                    ->with('info', __('multilingual::base.saved_changes'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', __('multilingual::base.failed_action'));
        }
    }

    /**
     * [GET] Show Edit Page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $bundle_item = TextBundleItem::find($id);
        if (empty($bundle_item)) {
            return redirect()
                ->route('lml-text-bundle-item.index')
                ->with('error', __('multilingual::bundle-item.not-found', [$id]));
        }

        // get all languages
        $language_options = Language::all()->pluck('name', 'lang_iso_code');

        return $this->loadView('text-bundle-item.edit', compact('bundle_item', 'language_options'));
    }

    /**
     * [PUT] Process Update
     * @param $id
     * @param Request $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $rq) {
        $bundle_item = TextBundleItem::find($id);
        if (empty($bundle_item)) {
            return redirect()
                ->route('lml-text-bundle-item.index')
                ->with('error', __('multilingual::bundle-item.not-found', [$id]));
        }

        $postData = $rq->all();

        // check if we need to validate
        if ($postData['key'] !== $bundle_item->key) {
            // ok validate now
            $rules = TextBundleItem::getValidationRules();
            unset($rules['text_bundle_id']);

            // run validator
            $validator = Validator::make($postData, $rules, TextBundleItem::getValidationMessages());

            // oh la la validation XXX
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        DB::beginTransaction();

        try {
            // update text bundle item
            $bundle_item->fill($postData);
            $bundle_item->updated_times++;
            $bundle_item->save();

            // update langtext
            LangText::saveLangText($postData['lang_text'], $bundle_item->text_id);

            // commit changes
            DB::commit();

            // run event
            event(new TextBundleItemUpdated($bundle_item));

            return redirect()
                    ->route('lml-text-bundle-item.index')
                    ->with('info', __('multilingual::base.saved_changes'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('multilingual::base.failed_action'));
        }
    }

    public function destroy($id) {

    }
}