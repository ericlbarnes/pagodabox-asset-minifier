<?php
return array(

	// See - http://code.google.com/p/cssmin/wiki/Configuration
	'css_filters' => array(
		"ImportImports"                 => false,
		"RemoveComments"                => true,
		"RemoveEmptyRulesets"           => true,
		"RemoveEmptyAtBlocks"           => true,
		"ConvertLevel3AtKeyframes"      => false,
		"ConvertLevel3Properties"       => false,
		"Variables"                     => true,
		"RemoveLastDelarationSemiColon" => true
	),

	// See - http://code.google.com/p/cssmin/wiki/Configuration
	'css_plugins' => array(
		"Variables"                     => true,
		"ConvertFontWeight"             => false,
		"ConvertHslColors"              => false,
		"ConvertRgbColors"              => false,
		"ConvertNamedColors"            => false,
		"CompressColorValues"           => false,
		"CompressUnitValues"            => false,
		"CompressExpressionValues"      => false
	)
);
