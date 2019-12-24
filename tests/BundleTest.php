<?php


namespace SethPhat\Multilingual\Tests;


use SethPhat\Multilingual\Libraries\Helper;
use SethPhat\Multilingual\Models\LangText;
use SethPhat\Multilingual\Models\TextBundle;
use SethPhat\Multilingual\Models\TextBundleItem;

class BundleTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    /**
     * @return TextBundle
     */
    private function prepareData() {
        $bundle = TextBundle::create([
            'name' => 'test_bundle'
        ]);

        $textId = LangText::saveLangText([
            'en' => 'Hello Seth Phat',
            'vi' => 'Xin chào Seth Phát',
            'fr' => 'Bonjour Seth Phat',
            'de' => 'Hallo Herr Seth Phat',
        ]);

        $bundle_item = TextBundleItem::create([
            'text_id' => $textId,
            'key' => 'hello',
            'text_bundle_id' => $bundle->id,
        ]);

        return $bundle;
    }

    public function testPublishBundleGetTextSuccess() {
        $bundle = $this->prepareData();
        $bundle->publish();

        $text = Helper::getFromCache("hello", "test_bundle", "en");
        $this->assertNotNull($text);
        $this->assertStringContainsString("Hello Seth Phat", $text);
        $this->assertNull(Helper::getFromCache("sethPhat", "test_bundle", "en"));
    }
}