<?php
/**
 * Page title template.
 *
 * @package BLR_Base_Theme\Templates
 */

use BLR_Base_Theme\Titles;
?>

<header class="page-heading">
	<h1 class="page-title">
		<?php echo esc_html( Titles\title() ); ?>
	</h1>
</header>
