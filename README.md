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