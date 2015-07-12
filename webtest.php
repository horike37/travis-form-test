<?php
class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl(getenv('SITE_URL'));
    }

    public function testForm()
    {
        $this->url(getenv('FORM_URL'));
        $this->byName('your-name')->value('horike');
        $this->byName('your-email')->value('horike37@gmail.com');
        $this->byName('your-subject')->value('subject');
        $this->byName('your-message')->value('message');
        $this->byclassName('wpcf7-form')->submit();
        
        $this->waitUntil(function($testCase) {
            $str = $testCase->byclassName('screen-reader-response')->text();
            if ( !empty($str) ) {
            	return true;
            }
        }, 3000);
        $this->assertEquals('あなたのメッセージは送信されました。ありがとうございました。', $this->byclassName('screen-reader-response')->text());
    }

}