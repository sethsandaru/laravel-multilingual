<?php


namespace SethPhat\Multilingual\models;


use Illuminate\Database\Eloquent\Model;

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


    public function bundle() {
        return $this->belongsTo(TextBundle::class, "text_bundle_id");
    }

    public function langTexts() {
        return $this->hasMany(LangText::class, "text_id");
    }
}