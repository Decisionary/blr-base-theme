<?php
/**
 * Comments template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<ul class="section-content breadcrumbs">

	<?php if ( function_exists( 'bcn_display_list' ) ) : ?>

		<?php bcn_display_list(); ?>

	<?php else : ?>

		<li class="breadcrumb">
			<i class="breadcrumb__icon icon icon-home"></i>
		</li>
		<li class="breadcrumb">
			<a class="breadcrumb__link">[Section]</a>
		</li>
		<li class="breadcrumb">
			<ul class="sub-breadcrumbs">
				<li class="sub-breadcrumb">
					[Category]
				</li>
				<li class="sub-breadcrumb is-active">
					[Category Title]
				</li>
			</ul>
		</li>

	<?php endif; ?>

</ul>
