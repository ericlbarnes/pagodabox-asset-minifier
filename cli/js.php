<?php namespace Minify;

class Js {

	/**
	 * Compress the js files
	 *
	 * @param  array $files
	 * @param  string $output
	 * @return string
	 */
	public static function compress($files, $output)
	{
		$js = require 'config/js.php';
		$written = 0;
		foreach ($files as $file)
		{
			if ( ! is_file($file))
			{
				continue;
			}

			File::make(rtrim($output, '/'));
			$written .= File::write(rtrim($output, '/').'/'.basename($file), static::curl($file, $js));
		}
		return $written;
	}

	/**
	 * Curl call to connect to closure
	 *
	 * @param  string $data
	 * @return mixed
	 */
	protected static function curl($data, $js)
	{
		// REST API arguments
		$api_args = array(
			'compilation_level' => $js['compilation_level'],
			'output_format' => 'text',
			'output_info' => 'compiled_code'
		);

		$args = 'js_code=' . urlencode(file_get_contents($data));
		$args .= http_build_query($api_args);

		// API call using cURL
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => 'http://closure-compiler.appspot.com/compile',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $args,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_FOLLOWLOCATION => 0
		));

		$output = curl_exec($ch);

		if ($output === false)
		{
			echo 'Curl error: ' . curl_error($ch);
			return null;
		}

		curl_close($ch);
		return $output;
	}
}