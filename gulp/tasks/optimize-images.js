/**
 * @module gulp/tasks/optimize-images
 */

import gulp from 'gulp';
import fs   from 'fs-extra';


/**
 * Optimizes images.
 */
const gulpOptimizeImages = () => {
	fs.copySync( 'assets/source/images', 'assets/dist/images' );
};

// Register the task.
gulp.task( 'optimize-images', gulpOptimizeImages );

export default gulpOptimizeImages;
