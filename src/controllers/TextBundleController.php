<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:18 PM
 */

namespace SethPhat\Multilingual\Controllers;


use Illuminate\Http\Request;
use SethPhat\Multilingual\models\TextBundle;

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