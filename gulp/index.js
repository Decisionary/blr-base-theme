/**
 * @module gulp
 */

import 'babel-polyfill';

import requireDir from 'require-dir';

export default requireDir( '.', { recurse: true, camelcase: true } );
