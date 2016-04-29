
// Gulp
const gulp = __require( 'gulp' );

// Files
const fs   = __require( 'fs-extra' );


/**
 * Gulp callback for `optimize-images` task.
 */
export const callback = () => {
	fs.copySync( 'assets/source/images', 'assets/dist/images' );
};


// Register the task.
gulp.task( 'optimize-images', callback );
