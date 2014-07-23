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

	public function testURLModifier() 
	{
		$style = 'modules/asset/assets/style.removethis.css';
		$script = 'modules/asset/assets/script.removethis.js';

		Assets::css( $style );
		Assets::js( $script );
		$only_style = \BuboBox\Assets::render(false, true, function($style) {
			return str_replace('.removethis', '', $style);
		});
		$only_script = \BuboBox\Assets::render(true, false, function($script) {
			return str_replace('.removethis', '', $script);
		});

		$this->assertNotContains('removethis', $only_style, 'Should not contain removethis part');
		$this->assertNotContains('removethis', $only_script, 'Should not contain removethis part');

	}

	public function testOrder()
	{
		$data = array(
			array('order' => 100, 'src' => 'test1'),
			array('order' => 200, 'src' => 'test2'),
			array('order' => 55, 'src' => 'test3'),
			array('order' => 0, 'src' => 'test5'),
			array('order' => 300, 'src' => 'test4'),
		);
		$result = Assets::sort($data, 'order');

		$this->assertEquals('test4', $result[0]['src']);
		$this->assertEquals(300, $result[0]['order']);
		$this->assertEquals('test2', $result[1]['src']);
		$this->assertEquals('test1', $result[2]['src']);
		$this->assertEquals('test3', $result[3]['src']);
		$this->assertEquals('test5', $result[4]['src']);
	}

}