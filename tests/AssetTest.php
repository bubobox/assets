<?php

use \BuboBox\Assets as Assets;

class Asset_Test extends PHPUnit_Framework_TestCase
{
	public function setup ()
	{}

	public function teardown()
    {
        Assets::reset();
    }


	public function testLoadJavascript() 
	{
		$fixt_url = 'modules/asset/assets/script1.js';

		Assets::js( $fixt_url );
		$result = \BuboBox\Assets::render(true, false);
		
		$this->assertContains('<script', $result, 'Should contain script tag');
		$this->assertContains($fixt_url, $result, 'Should contain script url');
	}

	public function testLoadMultipleJavascript() 
	{
		$fixt_url1 = 'modules/asset/assets/script1.js';
		$fixt_url2 = 'modules/asset/assets/script2.js';

		Assets::js( $fixt_url1 );
		Assets::js( $fixt_url2 );
		$result = \BuboBox\Assets::render(true, false);
		
		$this->assertContains('<script', $result, 'Should contain script tag');
		$this->assertContains($fixt_url1, $result, 'Should contain script url 1');
		$this->assertContains($fixt_url2, $result, 'Should contain script url 2');
	}

	public function testLoadStylesheet() 
	{
		$fixt_url = 'modules/asset/assets/style.css';

		Assets::css( $fixt_url );
		$result = \BuboBox\Assets::render(false, true);
		
		$this->assertContains('<link', $result, 'Should contain link tag');
		$this->assertContains($fixt_url, $result, 'Should contain stylesheet url');
	}

	public function testLoadMultipleStylesheets() 
	{
		$fixt_url1 = 'modules/asset/assets/style1.css';
		$fixt_url2 = 'modules/asset/assets/style2.css';

		Assets::css( $fixt_url1 );
		Assets::css( $fixt_url2 );
		$result = \BuboBox\Assets::render(false, true);
		
		$this->assertContains('<link', $result, 'Should contain link tag');
		$this->assertContains($fixt_url1, $result, 'Should contain stylesheet url 1');
		$this->assertContains($fixt_url2, $result, 'Should contain stylesheet url 2');
	}

	public function testRenderOnlyRequestedType() 
	{
		$style = 'modules/asset/assets/style.css';
		$script = 'modules/asset/assets/script.js';

		Assets::css( $style );
		Assets::js( $script );
		$only_style = \BuboBox\Assets::render(false, true);
		$only_script = \BuboBox\Assets::render(true, false);

		$this->assertNotContains('<script', $only_style, 'Should not contain script tag');
		$this->assertNotContains($script, $only_style, 'Should not contain script url');

		$this->assertNotContains('<link', $only_script, 'Should not contain link tag');
		$this->assertNotContains($style, $only_script, 'Should not contain style url');
	}
}