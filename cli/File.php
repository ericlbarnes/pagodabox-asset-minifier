<?php namespace Minify;

class File {

	/**
	 * Write contents to a file
	 * @param  string $path
	 * @param  string $data
	 * @return string
	 */
	public static function write($path, $data)
	{
		return file_put_contents($path, $data);
	}

	/**
	 * Make a new directory
	 *
	 * @param  string $dir
	 * @param  int $permission
	 * @param  bool $nested
	 * @return bool
	 */
	public static function make($dir, $permission = 0755, $nested = false)
	{
		// Remove links
		$dir = str_replace('../', '', $dir);
		$dir = str_replace('./', '', $dir);

		// Attempt to make the directory
		if ( ! is_dir($dir) and ! mkdir($dir, $permission, $nested))
		{
			return null;
		}

		return true;
	}
}