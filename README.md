# BLR Base Theme
[![Build Status](https://travis-ci.org/roots/sage.svg)](https://travis-ci.org/roots/sage)
[![devDependency Status](https://david-dm.org/roots/sage/dev-status.svg)](https://david-dm.org/roots/sage#info=devDependencies)

To compile the documentation for BLR Base Theme, run the following commands:

```sh
# Replace with the actual path to the blr-base-theme folder.
cd /path/to/blr-base-theme

npm run install-deps
npm run build
npm run docs
```

Ideally this should be done from the Vagrant guest OS. If you would prefer to
run the commands from your host OS, make sure Composer is installed and is in
your `$PATH` before running these commands.

Once the documentation is compiled, open any of the following pages in your
browser:

[Usage Docs & Style Guide](docs/usage/index.html)
[Sass Docs](docs/sass/index.html)
[JS Docs](docs/js/index.html)
[PHP Docs](docs/php/index.html)
