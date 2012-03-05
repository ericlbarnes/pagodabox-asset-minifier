<?php namespace Minify;

class Css {

	/**
	 * Compress the css files
	 *
	 * @param  array $files
	 * @param  string $output
	 * @return string
	 */
	public static function compress($files, $output)
	{
		$css = require BASE.'config/css.php';
		$written = 0;
		foreach ($files as $file)
		{
			if ( ! is_file($file))
			{
				continue;
			}

			File::make(rtrim($output, '/'));
			$written .= File::write(rtrim($output, '/').'/'.basename($file), static::minify($file, $css['css_filters'], $css['css_plugins']));
		}
		return $written;
	}

	/**
	 * Minify and compress the css
	 * @param  string $data
	 * @return string
	 */
	protected static function minify($data, $filters, $plugins)
	{
		require_once(BASE.'cli/lib/cssmin-v3.0.1.php');
		return \CssMin::minify(file_get_contents($data), $filters, $plugins);
	}
}