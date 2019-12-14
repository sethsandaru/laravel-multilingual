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
use SethPhat\Multilingual\Libraries\Events\TextBundleCreated;
use SethPhat\Multilingual\Libraries\Events\TextBundleRemoved;
use SethPhat\Multilingual\Libraries\Events\TextBundleUpdated;
use SethPhat\Multilingual\Models\TextBundle;

class TextBundleController extends BaseController
{
	/**
	 * Index Page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {
    	return $this->loadView('text-bundle.index');
	}

	/**
	 * Retrieve Bundles for DataTable [API]
	 * @param Request $rq
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function retrieve(Request $rq) {
    	// prepare data
    	$postData = $rq->all();
    	$query = TextBundle::query();
    	$total_result = $query->count("id");

    	// pagination
		$query->limit($postData['length']);
		$query->offset($postData['start']);

		// order by
		if (isset($postData['order'])) {
			$order_place = $postData['order'][0]['column'];
			$order_type = $postData['order'][0]['dir'];
			$order_column = $postData['columns'][$order_place]['data'];

			if ($order_type == "asc") {
				$order_type = "ASC";
			} else {
				$order_type = "DESC";
			}

			$query->orderBy($order_column, $order_type);
		}

		// filter by keyword
		if (isset($postData['filter_keyword']) && !empty($postData['filter_keyword'])) {
			$keyword = $postData['filter_keyword'];

			$query->where(function($where_query) use ($keyword) {
				$where_query->orWhere('name', 'LIKE', "%{$keyword}%");
				$where_query->orWhere('description', 'LIKE', "%{$keyword}%");

				if (is_numeric($keyword)) {
					$where_query->orWhere('id', $keyword);
				}
			});
		}

		// final
		$result = $query->get();

		return response()->json([
			"draw" => intval($postData['draw'] ?? 0),
			"recordsTotal" => $total_result,
			"recordsFiltered" => $total_result,
			"data" => $result,
		]);
	}

	/**
	 * Show Create Text Bundle Page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function create() {
		return $this->loadView('text-bundle.create');
    }

    /**
     * Process Create new Text Bundle
     * @param Request $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $rq) {
        $postData = $rq->all();

        // run validator
        $validator = Validator::make($postData, TextBundle::getValidationRules(), TextBundle::getValidationMessages());

        // oh la la validation XXX
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // ok save now
        $entity = TextBundle::create($postData);

        // run event
        event(new TextBundleCreated($entity));

        // redirect back to index page
        return redirect()->route('lml-text-bundle.index')->with('info', __('multilingual::base.saved_changes'));
    }

    /**
     * Show edit bundle page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $bundle = TextBundle::find($id);
        if (empty($bundle)) {
            return redirect()->route('lml-text-bundle.index')
                            ->with('error', __('multilingual::bundle.not-found'));
        }

        return $this->loadView('text-bundle.edit', compact('bundle'));
    }

    /**
     * Process update action
     * @param $id
     * @param Request $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $rq) {
        $bundle = TextBundle::find($id);
        if (empty($bundle)) {
            return redirect()->route('lml-text-bundle.index')
                            ->with('error', __('multilingual::bundle.not-found'));
        }

        $postData = $rq->all();
        if ($bundle->name != $postData['name']) {
            // need to run validation
            $validator = Validator::make($postData, TextBundle::getValidationRules(), TextBundle::getValidationMessages());

            // oh la la validation XXX
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        // ok update
        $bundle->fill($postData);
        if (!$bundle->save()) {
            return redirect()
                    ->back()
                    ->with('error', __('multilingual::base.failed_action'))
                    ->withInput();
        }

        // run event
        event(new TextBundleUpdated($bundle));

        return redirect()->route('lml-text-bundle.index')->with('info', __('multilingual::base.saved_changes'));
    }

    /**
     * Delete - API
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        /**
         * @var TextBundle $bundle
         */
        $bundle = TextBundle::find($id);
        if (empty($bundle)) {
            return response()->json(['msg' => __('multilingual::bundle.not-found')]);
        }

        // get the data for event before delete
        $data_for_event = $bundle->toArray();

        /*
         * Need to delete:
         *  - Text Bundle
         *  - Text Bundle Item
         *  - LangText of Text Bundle Item
         */
        DB::beginTransaction();

        try {
            $bundle->deleteRelationships();
            $bundle->delete();
            DB::commit();

            // run event
            event(new TextBundleRemoved($data_for_event));

            return response()->json(['msg' => __('multilingual::base.action_processed')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => __('multilingual::base.failed_action')]);
        }
    }
}