/**
 * @module gulp/tasks/docs
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const sass = __requireTask( 'docs/sass' );
const js   = __requireTask( 'docs/js' );
const php  = __requireTask( 'docs/php' );

// Register the task.
gulp.task( 'docs', gulp.parallel( sass.task, js.task, php.task ) );
