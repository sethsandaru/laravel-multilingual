<?php


namespace SethPhat\Multilingual\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class LangText
 * @package SethPhat\Multilingual\models
 * @method static Builder OfLangTextIDs(int $text_id, string $lang_id)
 */
class LangText extends Model
{
    protected $table = "lang_texts";
    public $incrementing = false;
    protected $primaryKey = ['text_id', 'lang_code'];
    protected $fillable = ['text_id', 'lang_code', 'lang_text'];
    public $timestamps = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    /********************************************************************************
     * SCOPES
     *********************************************************************************/

    /**
     * Scope - Double Columns Where to find the text
     * Note: Left => Right (MySQL Multiple Columns Index - LeftMostX)
     */
    public function scopeOfLangTextIDs($query, $text_id, $lang_id) {
        return $query->where([
            ['text_id', '=', $text_id],
            ['lang_code', '=', $lang_id],
        ]);
    }

    /**
     * Get next ID for insert
     * @return number
     */
    public static function getNextId() {
        $next_id = DB::table("lang_texts")
            ->selectRaw('IFNULL(MAX(text_id), 0) + 1 as next_id')
            ->value('next_id');
        return $next_id;
    }

    /**
     * Save LangText
     * @param array $lang_texts [lang_id_a => '...', lang_id_b => '...']
     * @return boolean|integer
     */
    public static function saveLangText(array $lang_texts, $text_id = null) {
        // add langText
        if ($text_id == null) {
            $new_text_id = static::getNextID();

            // traverse and bulk add lang text
            foreach ($lang_texts as $lang_id => $value) {
                $lang_obj = new static;
                $lang_obj->fill([
                    'lang_code' => $lang_id,
                    'text_id' => $new_text_id,
                    'lang_text' => $value
                ]);

                if (!$lang_obj->save()) {
                    throw new \RuntimeException("Insert new LangText Failed. LangCode: {$lang_id} - TextID: {$text_id}");
                }
            }

            return $new_text_id;
        }

        // edit langText - traverse and edit...
        foreach ($lang_texts as $lang_id => $value) {
            /**
             * @var static $lang_obj
             */
            $lang_obj = static::ofLangTextIDs($text_id, $lang_id)->first();
            if ($lang_obj == null) {
                $lang_obj = new static([
                    'lang_code' => $lang_id,
                    'text_id' => $text_id,
                ]);
            }
            $lang_obj->lang_text = $value;

            if (!$lang_obj->save()) {
                throw new \RuntimeException("Update LangText Failed. LangCode: {$lang_id} - TextID: {$text_id}");
            }
        }

        return true;
    }

    /**
     * Update TextBundleItem ID (Easy to handle)
     * @param $text_id
     * @param $text_bundle_item_id
     * @return int
     */
    public static function saveTextBundleId($text_id, $text_bundle_item_id) {
        return DB::table("lang_texts")
            ->where('text_id', $text_id)
            ->update([
                'text_bundle_item_id' => $text_bundle_item_id
            ]);
    }
}