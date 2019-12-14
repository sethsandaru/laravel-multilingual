<?php


namespace SethPhat\Multilingual\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Class TextBundleItem
 * @package SethPhat\Multilingual\models
 * @method static Builder byKeyAndBundleId(string $key, integer $bundle_id)
 */
class TextBundleItem extends Model
{
    protected $table = "text_bundle_items";
    protected $fillable = [
        'text_bundle_id',
        'key',
        'text_id',
        'description',
        'is_translated',
        'updated_times',
        'last_updated_by',
    ];

    /***************************************************************************
     *  Relationships...
     ***************************************************************************/

    public function bundle() {
        return $this->belongsTo(TextBundle::class, "text_bundle_id");
    }

    public function langTexts() {
        return $this->hasMany(LangText::class, "text_id");
    }

    /***************************************************************************
     *  Scope...
     ***************************************************************************/

    /**
     * @param Builder $query
     * @param string $key
     * @param integer $bundle_id
     * @return Builder
     */
    public function scopeByKeyAndBundleId($query, $key, $bundle_id) {
        return $query->where('key', $key)
                    ->where('text_bundle_id', $bundle_id);
    }

    /**
     * Get validation rules for Laravel Validator
     * @return array
     */
    public static function getValidationRules() {
        return [
            'text_bundle_id' => 'required|exists:text_bundles,id',
            'key' => [
                'required',
                'max:50',
                /**
                 * @var string $attribute // Field Name
                 * @var string $value // Key
                 * @var \Closure $fail // Function
                 */
                function($attribute, $value, $fail) {
                    $text_bundle_id = request()->post('text_bundle_id');
                    $bundle_item = TextBundleItem::byKeyAndBundleId($value, $text_bundle_id)->first();
                    if (!empty($bundle_item)) {
                        $fail(__('multilingual::bundle-item.key.unique'));
                    }
                }
            ],
//            'lang_text.*' => 'required', //TODO: Still thinking about this validation, do we need it??
        ];
    }

    /**
     * Get validation custom message for Laravel Validator
     * @return array
     */
    public static function getValidationMessages() {
        return [
            'key.required' => __('multilingual::bundle-item.key.required'),
            'key.max' => __('multilingual::bundle-item.key.max'),
            'key.unique' => __('multilingual::bundle-item.key.unique'),

            'text_bundle_id.required' => __('multilingual::bundle-item.text_bundle_id.required'),
            'text_bundle_id.exists' => __('multilingual::bundle-item.text_bundle_id.exists'),
        ];
    }

    /**
     * Get data for datatable
     * @return array
     */
    public static function getDataTable() {
        $postData = request()->all();
        $lang_code = $postData['language'] ?? App::getLocale() ?? "en";

        // query
        $query = DB::table("text_bundle_items");
        $query->select([
            DB::raw("SQL_CALC_FOUND_ROWS text_bundle_items.*"),
            'lang_texts.lang_text as text_value',
            'text_bundles.name as bundle_name'
        ]);

        // join
        $query->leftJoin("lang_texts", 'lang_texts.text_id', '=', 'text_bundle_items.text_id')
                ->where('lang_texts.lang_code', $lang_code);
        $query->join("text_bundles", "text_bundles.id", "=", "text_bundle_items.text_bundle_id");

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

        // filter - bundle id
        if (isset($postData['filter_bundle']) && !empty($postData['filter_bundle'])) {
            $query->where('text_bundle_id', $postData['filter_bundle']);
        }

        // filter - keyword
        if (isset($postData['filter_keyword']) && !empty($postData['filter_keyword'])) {
            $keyword = $postData['filter_bundle'];
            $query->where(function($sub_query) use ($keyword) {
                $sub_query->orWhere('key', 'LIKE', "%{$keyword}%");
                $sub_query->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // query to get result
        $result = $query->get();

        // count
        $count = DB::select("SELECT FOUND_ROWS() AS COUNT");
        $total_result = intval($count[0]->COUNT);

        // post-data-processing
        foreach ($result as $index => $item) {
            // get urls
            $result[$index]->urls = [
                'edit' => route('lml-text-bundle-item.update', [$item->id]),
                'delete' => route('lml-text-bundle-item.destroy', [$item->id]),
            ];

            // yes no text
            $result[$index]->is_translated = $item->is_translated ? __("multilingual::bundle.translated-yes") : __("multilingual::bundle.translated-no");
        }

        // data back neh
        return [
            "draw" => intval($postData['draw'] ?? 0),
            "recordsTotal" => $total_result,
            "recordsFiltered" => $total_result,
            "data" => $result,
        ];
    }
}