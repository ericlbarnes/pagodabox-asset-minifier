<?php namespace Minify;

class Route {

	/**
	 * Parse the commands and run something
	 * @return string
	 */
	public static function run()
	{
		$opts = getopt('t:f:o:');
		$type = $opts['t'] ?: 'js';

		if ( ! $opts['f'])
		{
			die('The -f File is required');
		}

		if ( ! $opts['o'])
		{
			die('The -o ouput directory is required');
		}

		require_once(BASE.'cli/File.php');

		$files = explode(' ', $opts['f']);

		// Do the good stuff
		if ($type == 'js')
		{
			static::__('Starting compressing js files');
			require_once(BASE.'cli/js.php');
			$compressed = Js::compress($files, $opts['o']);
		}
		else
		{
			static::__('Starting compressing css files');
			require_once(BASE.'cli/css.php');
			$compressed = Css::compress($files, $opts['o']);
		}

		static::__('Finishing compressing files. '.$compressed.' bytes written');
		return $compressed;
	}

	/**
	 * Echo a string to cli
	 * @param  string $string
	 * @return string
	 */
	public static function __($string)
	{
		echo $string."\n";
	}
}