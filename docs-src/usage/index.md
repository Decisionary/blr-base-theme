# Status and Changes

These documents are a work in progress, and may be out of date.  We intend to
maintain them and keep them as close to the implementation as possible.

BLR Base Theme is a work in progress.  If there is something not implemented
that you believe will be useful for other BLR WordPress implementations, please
feel free to reach out to Jc <jc@decisionarytech.com>, add an issue on GitHub,
or submit a pull request to have the change included in the Base Theme.



# Theme Mods

The following theme mods are most easily accessed and edited through the
'customizer' interface on the front end of the site:

## Site Info

### Phone Number

Displayed in the header and in the footer along with the copyright text.

### Address

Displayed in the footer along with the copyright text.

### Copyright Text

This is the text that is displayed in the footer, beneath the footer
navigation.

## Logos

### Primary Logo

Displayed in the header on the left, this is the primary logo for the site.

### Search Logo

Sets the 'search logo' in the header.  Often used for a 'powered by BLR|HCPro'
badge.

### Footer Logo

Usually an HCPro or BLR logo, this is displayed in the footer.

## Nav Menus

### Primary Nav

The primary header nav bar.

### Search Nav

A horizontal nav menu that is displayed in the header above the search bar.

### Sidebar Nav

A vertical nav menu that is displayed in the primary sidebar.

### Footer Nav

A horizontal nav menu that is displayed in the footer below the logo and above
the contact info and copyright text.

## Sidebars and Widgets

### Pre-Header Sidebar

A horizontal widget area that is displayed above the header.

### Primary Sidebar

The left column in a multi-column layout, most often used for navigation items
and menus. Menus placed in this column will receive the color-block treatment
seen on PQSH and TTMARK for their section pages.

### Secondary Sidebar

The right column in a multi-column layout, wide enough for ad placement.

### Footer Sidebar

A horizontal widget area that is displayed in the footer below the contact info
and copyright text.

### Post-Footer Sidebar

A horizontal widget area that is displayed below the footer.



# Page Templates

The following page templates are provided by default:

- Default - A three-column layout that includes both sidebars.
- Full Width - A full-width, one-column layout with no sidebars.
- Sidebar Primary - A two-column layout that includes the primary sidebar.
- Sidebar Secondary - A two-column layout that includes the secondary sidebar.



# Gulp

## Tasks

BLR Base Theme provides the following Gulp tasks to the child theme:

- `watch` - Watches asset files for changes and re-compiles them when updated.
- `release` - Compiles assets and documentation. We're working on an update to
  this task that will automatically increment the theme version number as well.
- `build` - Compiles all theme assets.
- `build/css` - Compiles Sass files into CSS.
- `build/js` - Compiles JS files.
- `build/images` - Copies images from `assest/source/images`, optimizes them,
  and outputs the optimized versions into `assets/dist/images`.
- `build/fonts` - Copies FontAwesome fonts, along with any fonts found in
  `/assets/source/fonts`.
- `docs` - Compiles the documentation for BLR Base Theme.
- `docs/js` - Compiles JavaScript docs.
- `docs/sass` - Compiles Sass docs.
- `docs/php` - Compiles PHP docs.
- `docs/usage` - Compiles Usage docs and the Style Guide page.

## Development

The Gulp development files can be found in the `gulp-src` folder. The tasks
are divided up into individual files within `gulp-src/tasks`, where each file
is a module that exports a `task` name and a `callback` function. Some tasks
also export a `config` object. The tasks utilize new features and syntax from
ES6, meaning the Gulp files must be compiled after any changes are made. To do
so, run the following command from the `blr-base-theme` folder:

```sh
npm run gulp-compile
```

### Importing Node Modules and Tasks

Since the Gulp tasks are designed to be used by a child theme, the process for
requiring node modules is slightly different - you need to use `__require()`
instead of `require()` or `import`. Since the Gulp tasks are all modules, they
can also be imported pretty easily with the `__requireTask()` function. For
example, if you wanted to import the `build/css` task module you would use
`__requireTask( 'build/css' )`.

### Adding a Task

When adding a new task, use the following as a starting point for the module:

```
/**
 * @module gulp/tasks/new-task
 */

// Gulp
const gulp = __require( 'gulp' );

/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'new-task';


/**
 * Task callback.
 *
 * Add documentation here to explain what the callback is doing and why.
 *
 * @return {Function}
 */
export const callback = function() {
	// Code goes here.
};


// Register the task.
gulp.task( task, callback );
```

If you prefer using arrow functions you can do this as well:

```
/**
 * Task callback.
 *
 * @return {Function}
 */
export const callback = () => {
	// Code goes here.
};
```



# Theme Assets

## CSS & JS

BLR Base Theme automatically enqueues the main theme CSS (`app.css`) and JS
(`app.js`) files for you if they exist. By default the theme CSS has no
dependencies, while the theme JS has one dependency (jQuery). If your theme CSS
or JS has any other dependencies, you can use the `blr/assets/css-deps` and
`blr/assets/js-deps` filters to add them. For example, let's say you're using
Underscore in your theme JS. To add Underscore as a dependency, you'd do
something like this:

```php
function customize_theme_js_deps( $deps ) {

	if ( ! in_array( 'underscore', $deps, true ) ) {
		$deps[] = 'underscore';
	}

	return $deps;
}

add_filter( 'blr/assets/js-deps', 'customize_theme_js_deps' );
```

The method for updating CSS dependencies is the same. For example, let's say
you enqueued the Bootstrap CSS and wanted to make sure that it was loaded
before the theme CSS:

```php
function customize_theme_css_deps( $deps ) {

	if ( ! in_array( 'bootstrap', $deps, true ) ) {
		$deps[] = 'bootstrap';
	}

	return $deps;
}

add_filter( 'blr/assets/css-deps', 'customize_theme_css_deps' );
```

## Helper Functions

BLR Base Theme also provides some handy asset-related helper functions. For
example, let's say you're putting together some custom template files for your
theme and you need to add some placeholder content, including some images:


```php
<?php
use BLR\Base_Theme\Assets;

$image_url = Assets\asset_url( 'images/image-file.png' );
?>

<img alt="Placeholder Image" src="<?php echo esc_url( $image_url ); ?>">

<p>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.
</p>
```

Or, let's say you want to check to see if an asset file exists. You'd simply do:

```php
use BLR\Base_Theme\Assets;

if ( file_exists( Assets\asset_path( 'path/to/asset.file' ) ) {
	// Do something.
}
```

There are also specific path and URL functions for images, CSS, and JS. So in
our first example with the template image, we could use the following instead:

```php
$image_url = Assets\image_url( 'image-file.png' );
```

These helper functions are especially useful when enqueueing custom CSS and JS:

```php
wp_enqueue_style( 'custom', Assets\css_url( 'custom.css' ), [], null );
wp_enqueue_script( 'custom', Assets\js_url( 'custom.js' ), [], null, true );
```

# Breakpoints

BLR Base Theme comes with the following breakpoints pre-defined:

```scss
$_breakpoints: (
	xs: 0px,
	sm: 572px,
	md: 756px,
	lg: 940px,
	xl: 1124px,
);
```

It also includes a `breakpoint` mixin that can be used to target any of these
breakpoints in a media query:

```scss
// Applies to viewports that are 572px or more.
@include breakpoint( sm ) {
	.example {
		display: block;
		// ...
	}
}
```

The `breakpoint` mixin accepts a 2nd argument that determines whether to use
`min-width` or `max-width` for the media query:

```scss
// Applies to viewports that are 571px or less.
@include breakpoint( sm, 'max' ) {
	.example {
		display: none;
		// ...
	}
}
```



# Grid System

BLR Base Theme includes the [Susy grid system](http://susy.oddbird.net/), as
well as some basic helper classes for quick prototyping:

```html_example
<div class="grid">
	<div class="grid-col--span-6">
		1/4
	</div>
	<div class="grid-col--span-12">
		1/2
	</div>
	<div class="grid-col--span-6">
		1/4
	</div>
	<div class="grid-col--span-8">
		1/3
	</div>
	<div class="grid-col--span-8">
		1/3
	</div>
	<div class="grid-col--span-8">
		1/3
	</div>
</div>
```



# Theme Colors

The following color variables are made available to the child theme:

<span class="color-swatch--base">`$color-base`</span>
<span class="color-swatch--light">`$color-light`</span>
<span class="color-swatch--medium">`$color-medium`</span>
<span class="color-swatch--dark">`$color-dark`</span>
<span class="color-swatch--primary">`$color-primary`</span>
<span class="color-swatch--secondary">`$color-secondary`</span>
<span class="color-swatch--tertiary">`$color-tertiary`</span>
<span class="color-swatch--success">`$color-success`</span>
<span class="color-swatch--error">`$color-error`</span>
<span class="color-swatch--info">`$color-info`</span>
<span class="color-swatch--alert">`$color-alert`</span>



# Buttons

BLR Base Theme allows for buttons in both `<button>` and `<a>` elements.
Regardless of which method you pick, the buttons should appear identical,
giving you flexibility in implementation. That being said, if your button does
not actually link to another page you should use a `<button>` element. When you
do need to use an `<a>` element, you should add the `button` ARIA role for
accessibility purposes.

```html_example
<button class="button--primary">This is a button</button>
<a class="button--primary" role="button" href="...">This is a button link.</a>
```



# Button Colors

Buttons come in the following colors:

```html_example
<button class="button--default">Default text color</button>
<button class="button--primary">Primary branding color</button>
<button class="button--secondary">Secondary branding color</button>
<button class="button--tertiary">Tertiary branding color</button>
<button class="button--success">Success state color</button>
<button class="button--error">Error state color</button>
<button class="button--info">Info state color</button>
<button class="button--alert">Alert state color</button>
```

Each button color also has a corresponding solid version:

```html_example
<button class="button--default--solid">Default text color</button>
<button class="button--primary--solid">Primary branding color</button>
<button class="button--secondary--solid">Secondary branding color</button>
<button class="button--tertiary--solid">Tertiary branding color</button>
<button class="button--success--solid">Success state color</button>
<button class="button--error--solid">Error state color</button>
<button class="button--info--solid">Info state color</button>
<button class="button--alert--solid">Alert state color</button>
```



# Button Styles

BLR Base Theme includes a number of Sass placeholders and mixins that can be
used to create different types of buttons.

```scss
// Regular button using placeholder.
.my-button {
	@extend %button;
}

// Regular button using mixin

// Full-width button.
.my-button {
	@extend %button--block;
}

// Button with slightly rounded corners.
.my-button {
	@extend %button--rounded;
}

// Pill-shaped button with completely round corners.
.my-button {
	@extend %button--pill;
}
```

Each of these placeholders also corresponds to a CSS class that you can use.
The placeholder method is recommended as it's easier to maintain, though the
helper classes are useful for prototyping or placeholder content.

```html_example
<button class="button--primary button--block">This is a full-width button</button>
<button class="button--primary button--rounded">This is a rounded button</button>
<button class="button--primary button--pill">This is a pill-shaped button</button>
<button class="button--primary--solid button--block">This is a full-width button</button>
<button class="button--primary--solid button--rounded">This is a rounded button</button>
<button class="button--primary--solid button--pill">This is a pill-shaped button</button>
```
