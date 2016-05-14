/**
 * @module gulp/tasks/build
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const css    = __requireTask( 'build/css' );
const js     = __requireTask( 'build/js' );
const images = __requireTask( 'build/images' );
const fonts  = __requireTask( 'build/fonts' );

// Register the task.
gulp.task( 'build', gulp.series( css.task, js.task, images.task, fonts.task ) );
