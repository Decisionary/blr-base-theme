/**
 * @module gulp/tasks/qa
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const lint   = __requireTask( 'qa/lint' );
const test   = __requireTask( 'qa/test' );

// Register the task.
gulp.task( 'qa', gulp.parallel( lint.task, test.task ) );
