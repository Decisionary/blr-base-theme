
# Assets

## Theme CSS / JS

BLR Base Theme automatically enqueues the main theme CSS and JS files for you
if they exist. By default the theme CSS has no dependencies, while the theme JS
has one dependency (jQuery). If your theme CSS or JS has any other dependencies,
you can use the `blr/assets/css-deps` and `blr/assets/js-deps` filters to add
them. For example, let's say you're using Underscore in your theme JS. To add
Underscore as a dependency, you'd do something like this:

	function customize_theme_js_deps( $deps ) {

		if ( ! in_array( 'underscore', $deps, true ) ) {
			$deps[] = 'underscore';
		}

		return $deps;
	}

	add_filter( 'blr/assets/js-deps', 'customize_theme_js_deps' );

The method for updating CSS dependencies is the same. For example, let's say you
enqueued the Bootstrap CSS and wanted to make sure that it was loaded before the
theme CSS:

	function customize_theme_css_deps( $deps ) {

		if ( ! in_array( 'bootstrap', $deps, true ) ) {
			$deps[] = 'bootstrap';
		}

		return $deps;
	}

	add_filter( 'blr/assets/css-deps', 'customize_theme_css_deps' );

BLR Base Theme also provides some handy asset-related helper functions. For
example, let's say you're putting together some custom template files for your
theme and you need to add some placeholder content, including some images:


	<?php
	use BLR\Base_Theme\Assets;

	$image_url = Assets\asset_url( 'images/image-file.png' );
	?>

	<img alt="Placeholder Image" src="<?php echo esc_url( $image_url ); ?>">

	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua.
	</p>

Or, let's say you want to check to see if an asset file exists. You'd simply do:

	use BLR\Base_Theme\Assets;

	if ( file_exists( Assets\asset_path( 'path/to/asset.file' ) ) {
		// Do something.
	}

There are also specific path and URL functions for images, CSS, and JS. So in
our first example with the template image, we could use the following instead:

	$image_url = Assets\image_url( 'image-file.png' );

These helper functions are especially useful when enqueueing custom CSS and JS:

	wp_enqueue_style( 'custom', Assets\css_url( 'custom.css' ), [], null );
	wp_enqueue_script( 'custom', Assets\js_url( 'custom.js' ), [], null, true );
