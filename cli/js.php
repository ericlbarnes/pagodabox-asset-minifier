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
		$js = require BASE.'config/js.php';
		$written = 0;
		foreach ($files as $file)
		{
			if ( ! is_file($file))
			{
				continue;
			}

			File::make(rtrim($output, '/'));
			$compiled = static::request($file, $js);
			$written .= File::write(rtrim($output, '/').'/'.basename($file), $compiled['compiled_code']);
			if ($compiled['warnings'])
			{
				$warnings = json_decode($compiled['warnings']);
				foreach ($warnings as $warning)
				{
					print 'You have some javascript issues:'."\n";
					foreach ($warning as $error)
					{
						print $error->type.' - '.$error->warning.' - Line #'.$error->lineno."\n";
					}
				}
			}
		}
		return $written;
	}

	/**
	 * Curl call to connect to closure
	 *
	 * @param  string $data
	 * @return mixed
	 */
	protected static function request($data, $js)
	{
		$warning_args = array(
			'compilation_level' => $js['compilation_level'],
			'output_format' => 'json',
			'output_info' => 'warnings',
			'warning_level' => 'VERBOSE'
		);

		$compiled_args = array(
			'compilation_level' => $js['compilation_level'],
			'output_format' => 'text',
			'output_info' => 'compiled_code',
			'warning_level' => 'VERBOSE'
		);

		return array(
			'compiled_code' => static::curl($data, $compiled_args),
			'warnings' => static::curl($data, $warning_args),
		);
	}

	protected static function curl($data, $args)
	{
		$curl_args = 'js_code='.urlencode(file_get_contents($data)).'&';
		$curl_args .= http_build_query($args);

		// API call using cURL
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => 'http://closure-compiler.appspot.com/compile',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $curl_args,
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