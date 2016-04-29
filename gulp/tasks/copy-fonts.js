/**
 * @module gulp/tasks/copy-fonts
 */

import gulp from 'gulp';
import fs   from 'fs-extra';


/**
 * Copies FontAwsome fonts into theme fonts directory.
 */
const gulpCopyFonts = () => {
	fs.copySync( 'assets/source/fonts', 'assets/dist/fonts' );
	fs.copySync( 'bower_components/font-awesome/fonts', 'assets/dist/fonts' );
};

// Register the task.
gulp.task( 'copy-fonts', gulpCopyFonts );

export default gulpCopyFonts;
