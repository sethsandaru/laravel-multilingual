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


    public function bundle_items() {
        return $this->hasMany(TextBundleItem::class, 'text_bundle_id');
    }

    public function getUrlsAttribute() {
    	return [
    		'edit' => route('lml-text-bundle.edit', [$this->id]),
    		'delete' => route('lml-text-bundle.destroy', [$this->id]),
		];
	}

	public function getTranslatedTextAttribute() {
    	return $this->is_translated ? __("multilingual::bundle.translated-yes") : __("multilingual::bundle.translated-no");
	}
}