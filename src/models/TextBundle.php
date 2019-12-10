<?php


namespace SethPhat\Multilingual\models;


use Illuminate\Database\Eloquent\Model;

class TextBundle extends Model
{
    protected $table = "text_bundles";
    protected $fillable = [
        'name',
        'description',
        'is_translated'
    ];
    protected $appends = ['urls', 'translated_text'];

    /**
     * Relationship - Bundle Items
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bundleItems() {
        return $this->hasMany(TextBundleItem::class, 'text_bundle_id');
    }

    /**
     * Attribute to get the url for backend page
     * @return array
     */
    public function getUrlsAttribute() {
    	return [
    		'edit' => route('lml-text-bundle.edit', [$this->id]),
    		'delete' => route('lml-text-bundle.destroy', [$this->id]),
		];
	}

    /**
     * Attribute to get the langtext Yes/No
     * @return string
     */
	public function getTranslatedTextAttribute() {
    	return $this->is_translated ? __("multilingual::bundle.translated-yes") : __("multilingual::bundle.translated-no");
	}

    /**
     * Get validation rules for Laravel Validator
     * @return array
     */
    public static function getValidationRules() {
        return [
            'name' => 'required|max:50|unique:text_bundles,name',
        ];
    }

    /**
     * Get validation custom message for Laravel Validator
     * @return array
     */
    public static function getValidationMessages() {
        return [
            'name.required' => __('multilingual::bundle.name.required'),
            'name.max' => __('multilingual::bundle.name.max'),
            'name.unique' => __('multilingual::bundle.name.unique'),
        ];
    }

    /**
     * Delete all related-relationship
     */
    public function deleteRelationships() {
        // prepare items
        $bundle_items = TextBundleItem::query()
                                ->where('text_bundle_id', $this->id);

        // delete lang_texts
        LangText::query()->where('text_bundle_item_id', $bundle_items->pluck('id'));

        // delete text_bundle_items
        $bundle_items->delete();
    }
}