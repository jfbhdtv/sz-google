<?php

/**
 * Definition of the PHP functions that can be called directly 
 * by a theme or a plugin for customizations without use shortcode
 *
 * @package SZGoogle
 * @subpackage SZGoogleFunctions
 * @author Massimo Della Rovere
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();

/**
 * Definition function to convert a string to uppercase also 
 * configured with different languages​​. Using if possible mb_()
 */

function SZGOOGLE_UPPER($string) 
{
	if (!function_exists('mb_strtoupper')) return strtoupper($string); 
		else return mb_strtoupper($string,'UTF-8');
}