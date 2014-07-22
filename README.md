![alt text](https://circleci.com/gh/bubobox/assets.png?circle-token=13470ff92795bdad02e3681c993c1fedd4bdbba1 "Master build") 

Assets
------
Assets is a static class that makes it very easy to add javascript or stylesheets to your views.

Run unit tests
--------------
	composer install --dev
	cd tests
	phpunit

Usage
-----
To specify a script or stylesheet to load from your controller your can use following code:

	use \BuboBox\Assets as Assets;
	Assets::js('modules/asset/assets/script.js');
	Assets::css('modules/asset/assets/style.css');

Now in your view you can add the script and link tags for the resources using the `Assets::render` method as follow:

	echo Assets::render(false, true); // Output only link (stylesheet) tags
	echo Assets::render(true, false); // Output only script tags
	echo Assets::render(true, true); // Output both link and script tags

For better examples take a look in the examples folder.

Modifiers
---------
With a modifier callback function you can change the URLs of the assets before it's rendered into HTML.
This can be handy if you for example want to load the .debug.js versions of your JavaScript files when your working in your development environment.

	echo Assets::render(true, false, function($url) {
		return str_replace('.min.js', '.js', $url);
	});