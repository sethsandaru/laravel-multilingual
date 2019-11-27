<?php


namespace SethPhat\Multilingual\models;


use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = "languages";
    protected $primaryKey = "lang_iso_code";
    public $incrementing = false;

    protected $fillable = ['lang_iso_code', 'name'];


    /**
     * To apply prefix for table
     * @return string
     */
    public function getTable()
    {
        return config("multilingual.table_prefix") . $this->table;
    }
}