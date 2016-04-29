
// Gulp
const gulp = __require( 'gulp' );

// Files
const fs   = __require( 'fs-extra' );


/**
 * Gulp callback for `copy-fonts` task.
 */
export const callback = () => {
	fs.copySync( 'assets/source/fonts', 'assets/dist/fonts' );
	fs.copySync( 'bower_components/font-awesome/fonts', 'assets/dist/fonts' );
};


// Register the task.
gulp.task( 'copy-fonts', callback );
