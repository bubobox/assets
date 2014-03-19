<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This static class can be used to load javascript or css resources from
 * within your controllers
 *
 * @author Wim Mostmans
 */
class Assets extends Registry {

	/**
	 * Key to use in the registry to save a list of js assets
	 *
	 * @var string
	 */
	const JAVASCRIPT_RESOURCE_KEY = 'javascript_assets';

	/**
	 * Key to use in the registry to save a list of css assets
	 *
	 * @var string
	 */
	const CSS_RESOURCE_KEY = 'css_assets';	

	/**
	 * Javascript resource type
	 *
	 * @var string
	 */
	const TYPE_JS = 'js';

	/**
	 * CSS resource type
	 *
	 * @var string
	 */
	const TYPE_CSS = 'css';

	/**
	 * Load a javascript asset
	 *
	 * @param $url
	 * @return void
	 */
	public static function js($url)
	{
		self::add($url, self::TYPE_JS);
	}

	/**
	 * Load a stylesheet asset
	 *
	 * @param $url
	 * @return void
	 */
	public static function css($url)
	{
		self::add($url, self::TYPE_CSS);
	}

	/**
	 * Render the js and/or css include html
	 *
	 * @param bool $include_js
	 * @param bool $include_css
	 * @return string
	 */
	public static function render($include_js = TRUE, $include_css = FALSE) 
	{
		$html = '';
		if($include_js) {
			if($list = self::get(self::JAVASCRIPT_RESOURCE_KEY)) {
				foreach($list as $url) {
					$html .= self::script_tag($url);
				}
			}
		}
		if($include_css) {
			if($list = self::get(self::CSS_RESOURCE_KEY)) {
				foreach($list as $url) {
					$html .= self::style_tag($url);
				}
			}
		}
		return $html;
	}

	/**
	 * Add a resource to the list to load
	 *
	 * @param string $url
	 * @param string $type
	 * @return void
	 */
	protected static function add($url, $type = self::TYPE_JS) 
	{
		$key = $type == self::TYPE_JS ? self::JAVASCRIPT_RESOURCE_KEY : self::CSS_RESOURCE_KEY;
		if($list = self::get($key)) {
			$list[] = $url;
		} else {
			$list = array($url);
		}
		self::set($key, $list);
	}

	/**
	 * Generate a script tag from an url
	 *
	 */
	protected static function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
    {
        $CI =& get_instance();
        $script = '<scr'.'ipt';

        if ( strpos($src, '://') !== FALSE) {
            $script .= ' src="'.$src.'" ';
        }
        elseif ($index_page === TRUE) {
            $script .= ' src="'.$CI->config->site_url($src).'" ';
        }
        else {
            $script .= ' src="'.$CI->config->slash_item('base_url').$src.'" ';
        }

        $script .= 'language="'.$language.'" type="'.$type.'"';
        $script .= ' /></scr'.'ipt>' . PHP_EOL;

        return $script;
    }

    /**
	 * Generate a script tag from an url
	 *
	 */      
	protected static function style_tag($src = '', $rel = 'stylesheet', $type = 'text/css', $index_page = FALSE)
    {
        $CI =& get_instance();
        $link = '<link';
 		
 		if ( strpos($src, '://') !== FALSE) {
            $link .= ' href="'.$src.'" ';
        }
        elseif ($index_page === TRUE) {
            $link .= ' href="'.$CI->config->site_url($src).'" ';
        }
        else {
            $link .= ' href="'.$CI->config->slash_item('base_url').$src.'" ';
        }

        $link .= 'rel="'.$rel.'" type="'.$type.'"';
        $link .= ' /></link>' . PHP_EOL;     
 
        return $link;
    }

}