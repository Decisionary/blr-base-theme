/**
 * @module gulp/files/build-css
 */

export default {
	watch:  'assets/source/css/**/*.scss',
	source: [
		'assets/source/css/**/*.scss',
		'!assets/source/css/**/_*.scss',
	],
	dest: 'assets/dist/css/',
};
