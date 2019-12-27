<?php


namespace SethPhat\Multilingual\Tests;


use SethPhat\Multilingual\Libraries\TextBundleHandler;
use SethPhat\Multilingual\Models\LangText;
use SethPhat\Multilingual\Models\TextBundle;
use SethPhat\Multilingual\Models\TextBundleItem;

class HelperTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testInstance() {
        $facadeObj = multilingual();
        $this->assertInstanceOf(TextBundleHandler::class, $facadeObj);
    }

    public function testGetTextFailedException() {
        $this->expectException(\RuntimeException::class);
        $text = multilingual("not_found", "not_have");
    }

    public function testGetTextFailedString() {
        $text = multilingual("not_found", "not_have", [], "en", false);
        $this->assertStringContainsString("doesn't existed", $text);
    }

    private function prepareText() {
        $bundle = TextBundle::create([
            'name' => 'test_bundle'
        ]);

        $textId = LangText::saveLangText([
            'en' => 'Hello Seth Phat',
            'vi' => 'Xin chào Seth Phát',
            'fr' => 'Bonjour Seth Phat and :name',
            'de' => 'Hallo Herr Seth Phat',
        ]);

        $bundle_item = TextBundleItem::create([
            'text_id' => $textId,
            'key' => 'hello',
            'text_bundle_id' => $bundle->id,
        ]);
    }

    public function testGetTextSuccessDefaultLang() {
        $this->prepareText();

        $text_default = multilingual('hello', 'test_bundle');
        $this->assertEquals("Hello Seth Phat", $text_default);
    }

    public function testGetTextSuccessSpecificLang() {
        $this->prepareText();

        $text_de = multilingual('hello', 'test_bundle', [], "de");
        $this->assertEquals("Hallo Herr Seth Phat", $text_de);
    }

    public function testReplaceTextSuccess() {
        $this->prepareText();
        $text_fr = multilingual('hello', 'test_bundle', ['name' => 'Phat Tran'], "fr");
        $this->assertEquals("Bonjour Seth Phat and Phat Tran", $text_fr);
    }

    public function testReplaceTextNotSuccessBecauseNoMatchKey() {
        $this->prepareText();
        $text_fr = multilingual('hello', 'test_bundle', ['xnise' => 'Phat Tran'], "fr");

        $this->assertStringContainsString(":name", $text_fr);
    }
}