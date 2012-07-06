Pagoda CLI Minifier
===================

Compress js and css files for your application.

## Examples:

	php minify -t css -f "tests/css/style.css" -o min
	php minify -t js -f "tests/js/test.js" -o min
	php minify -c -t css -f "tests/css/reset.css tests/css/style.css" -o min

## Arguments:

* `-t` - Type of asset. (js or css)
* `-f` - List of files. Example: `-f "js/main.js js/plugin.js"`
* `-o` - Output Directory. Example: `-o minfolder`
* `-c` - Concatenate all files. File is written to output directory as min.css or min.js, respectively.

**Note: Output files are named the same as the original.**

## Configuring Deploy Hooks

	web1
		php_extensions:
			- curl
		after_build:
			- "php minify -t css -f css/style.css -o css/min"

**Note: Curl is required**