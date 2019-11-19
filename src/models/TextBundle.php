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


    public function bundle_items() {
        return $this->hasMany(TextBundleItem::class, 'text_bundle_id');
    }
}