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
	 * Read contents to a file
	 * @param  string $path
	 * @return string
	 */
	public static function read($path)
	{
		return file_get_contents($path);
	}

	/**
	 * Make a new directory
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
	
	/**
	 * Append data to the end of a file
	 * @param  string $path
	 * @param  string $data
	 * @return bool
	 */
	public static function append($path, $data)
	{
		$handle = fopen($path, 'a+');
		fwrite($handle, $data);
		return fclose($handle);
	}
	
	/**
	 * Concatenate a bunch of files
	 * @param  array $files
	 * @param  string $output
	 * @param  string $extension
	 * @return bool
	 */
	public static function concatenate($files, $output, $extension)
	{
		foreach ($files as $file)
		{
			$data = self::read($output.'/'.basename($file));
			self::append($output.'/min.'.$extension, $data);
		}
		
		return true;
	}

}