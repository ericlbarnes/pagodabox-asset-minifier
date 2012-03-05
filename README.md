Pagoda CLI Minifier
===================

Compress js and css files for your application.

## Examples:

	php minify -t css -f "tests/css/style.css" -o min
	php minify -t js -f "tests/js/test.js" -o min

## Arguments:

* `-t` - Type of asset. (js or css)
* `-f` - List of files. Example: -f "js/main.js js/plugin.js"
* `-o` - Output Directory. Example: -o min

**Note: Output files are named the same as the original.**
