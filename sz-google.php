<?php
/*
Plugin Name: SZ - Google
Plugin URI: http://startbyzero.com/webmaster/wordpress-plugin/sz-google/
Description: Plugin to integrate <a href="http://google.com" target="_blank">Google's</a> products in <a href="http://wordpress.org" target="_blank">WordPress</a> with particular attention to the widgets provided by the social network Google+. Before using the plug-in <em>sz-google</em> pay attention to the options to be specified in the admin panel and enter all the parameters necessary for the proper functioning of the plugin. If you want to know the latest news and releases from the plug-in <a href="http://wordpress.org/plugins/sz-google/">sz-google</a> follow the <a href="https://plus.google.com/117259631219963935481/" target="_blank">official page</a> present in the social network Google+ or subscribe to our community <a href="https://plus.google.com/communities/109254048492234113886" target="_blank">WordPress Italy+</a> always present on Google+.
Author: Massimo Della Rovere
Version: 1.6.1
Author URI: https://plus.google.com/106567288702045182616
License: GPL2

Copyright 2012 startbyzero (email: webmaster@startbyzero.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (!defined('ABSPATH')) die("Accesso diretto al file non permesso");

/* ************************************************************************** */
/* Definizione delle costanti da usare nel plugin uso generale                */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE',true);
define('SZ_PLUGIN_GOOGLE_VERSION','1.5.1');
define('SZ_PLUGIN_GOOGLE_REPOSITORY','http://wordpress.org/plugins/sz-google/');

define('SZ_PLUGIN_GOOGLE_PATH',plugin_dir_url(__FILE__));
define('SZ_PLUGIN_GOOGLE_PATH_JS',SZ_PLUGIN_GOOGLE_PATH.'includes/js/');
define('SZ_PLUGIN_GOOGLE_PATH_CSS',SZ_PLUGIN_GOOGLE_PATH.'css/');
define('SZ_PLUGIN_GOOGLE_PATH_CSS_IMAGE',SZ_PLUGIN_GOOGLE_PATH.'css/images/');
define('SZ_PLUGIN_GOOGLE_PATH_IMAGE',SZ_PLUGIN_GOOGLE_PATH.'images/');

define('SZ_PLUGIN_GOOGLE_BASENAME',dirname(__FILE__ ));
define('SZ_PLUGIN_GOOGLE_BASENAME_LANGUAGE',dirname(plugin_basename(__FILE__ )).'/languages');
define('SZ_PLUGIN_GOOGLE_BASENAME_ADMIN_WIDGETS',SZ_PLUGIN_GOOGLE_BASENAME.'/admin/widgets/');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel plugin uso generale                */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_VALUE_NO'   ,'0');
define('SZ_PLUGIN_GOOGLE_VALUE_YES'  ,'1');
define('SZ_PLUGIN_GOOGLE_VALUE_NULL' ,'');
define('SZ_PLUGIN_GOOGLE_VALUE_ZERO' ,'0');
define('SZ_PLUGIN_GOOGLE_VALUE_LANG' ,'99');
define('SZ_PLUGIN_GOOGLE_VALUE_AUTO' ,'auto');
define('SZ_PLUGIN_GOOGLE_VALUE_NONE' ,'none');
define('SZ_PLUGIN_GOOGLE_VALUE_DAY'  ,sprintf('%02d',date('d')));
define('SZ_PLUGIN_GOOGLE_VALUE_MONTH',sprintf('%02d',date('m')));
define('SZ_PLUGIN_GOOGLE_VALUE_YEAR' ,sprintf('%04d',date('Y')));
define('SZ_PLUGIN_GOOGLE_VALUE_OLD_DAY','01');
define('SZ_PLUGIN_GOOGLE_VALUE_OLD_MONTH','01');
define('SZ_PLUGIN_GOOGLE_VALUE_OLD_YEAR','2000');

define('SZ_PLUGIN_GOOGLE_VALUE_TEXT_WIDGET','widget');
define('SZ_PLUGIN_GOOGLE_VALUE_TEXT_SHORTCODE','shortcode');
define('SZ_PLUGIN_GOOGLE_VALUE_BUTTON_MARGIN_TOP','none');
define('SZ_PLUGIN_GOOGLE_VALUE_BUTTON_MARGIN_RIGHT','none');
define('SZ_PLUGIN_GOOGLE_VALUE_BUTTON_MARGIN_BOTTOM','1');
define('SZ_PLUGIN_GOOGLE_VALUE_BUTTON_MARGIN_LEFT','none');
define('SZ_PLUGIN_GOOGLE_VALUE_BUTTON_MARGIN_UNITS','em');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE+                     */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_PLUS_ID_PROFILE','106567288702045182616');
define('SZ_PLUGIN_GOOGLE_PLUS_ID_PAGE','117259631219963935481');
define('SZ_PLUGIN_GOOGLE_PLUS_ID_COMMUNITY','109254048492234113886');

define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_WIDTH','');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_LAYOUT','portrait');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_THEME','light');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_COVER','true');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_PHOTO','true');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_TAGLINE','true');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_AUTHOR','false');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_PUBLISHER','false');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_OWNER','false');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_SIZE_PORTRAIT','350');
define('SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_SIZE_LANDSCAPE','350');

define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_LAYOUT','portrait');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_THEME','light');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_COVER','true');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_PHOTO','true');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_TAGLINE','true');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_AUTHOR','false');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_PUBLISHER','false');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_OWNER','false');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_SIZE_PORTRAIT','180');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_SIZE_LANDSCAPE','275');
define('SZ_PLUGIN_GOOGLE_PLUS_WIDGET_HEIGHT','300');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE ANALYTICS            */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_GA_HEADER','H');
define('SZ_PLUGIN_GOOGLE_GA_FOOTER','F');
define('SZ_PLUGIN_GOOGLE_GA_MANUAL','M');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE DRIVE                */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_DRIVE_SITENAME','Website');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE GROUPS               */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_GROUPS_NAME'  ,'adsense-api');
define('SZ_PLUGIN_GOOGLE_GROUPS_WIDTH' ,'0');
define('SZ_PLUGIN_GOOGLE_GROUPS_HEIGHT','700');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE PANORAMIO            */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_TEMPLATE','photo');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_WIDTH' ,'auto');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_HEIGHT','300');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_ORIENTATION','horizontal');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_LIST_SIZE','6');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_POSITION','bottom');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_PARAGRAPH','1');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_DELAY','2');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_SET','public');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_COLUMNS','4');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_S_ROWS','1');

define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_TEMPLATE','photo');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_WIDTH' ,'auto');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT','300');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_ORIENTATION','horizontal');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_LIST_SIZE','6');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_POSITION','bottom');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_DELAY','2');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_SET','public');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_COLUMNS','4');
define('SZ_PLUGIN_GOOGLE_PANORAMIO_W_ROWS','1');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE TRANSLATE            */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_TRANSLATE_MODE','I1');

/* ************************************************************************** */
/* Definizione delle costanti da usare nel modulo GOOGLE YOUTUBE              */
/* ************************************************************************** */

define('SZ_PLUGIN_GOOGLE_YOUTUBE_NO' ,'n');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_YES','y');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_WIDTH' ,'600');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_HEIGHT','400');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_TOP','');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_RIGHT','');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_BOTTOM','1');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_LEFT','');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_UNIT','em');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_AUTO','auto');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_ZERO','0');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_THEME','dark');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_COVER','local');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_CHANNEL','startbyzero');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_WIDGET_WIDTH' ,'300');
define('SZ_PLUGIN_GOOGLE_YOUTUBE_WIDGET_HEIGHT','200');

/* ************************************************************************** */
/* Carico il file pluggable se nessuno ha definito le funzioni utente         */
/* ************************************************************************** */

if (!function_exists('is_user_logged_in()')) {
	require_once (ABSPATH.WPINC.'/pluggable.php');
}

/* ************************************************************************** */
/* Funzione creazione delle opzioni in attivazione                            */
/* ************************************************************************** */

function sz_google_plugin_activate()
{
	// Impostazione valori di default che riguardano  
	// parametri di base come l'attivazione dei moduli 

	$settings_base = array(
		'plus'                              => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'analytics'                         => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'drive'                             => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'groups'                            => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'panoramio'                         => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'translate'                         => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube'                           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'documentation'                     => SZ_PLUGIN_GOOGLE_VALUE_YES,
	);

	// Impostazione valori di default che riguardano  
	// il modulo collegato alle funzioni di Google PLus 

	$settings_plus = array(
		'plus_page'                         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_profile'                      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_community'                    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_language'                     => SZ_PLUGIN_GOOGLE_VALUE_LANG,
		'plus_widget_pr_enable'             => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_widget_pa_enable'             => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_widget_co_enable'             => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_widget_fl_enable'             => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_widget_size_portrait'         => SZ_PLUGIN_GOOGLE_PLUS_WIDGET_SIZE_PORTRAIT,
		'plus_widget_size_landscape'        => SZ_PLUGIN_GOOGLE_PLUS_WIDGET_SIZE_LANDSCAPE,
		'plus_shortcode_pr_enable'          => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_shortcode_pa_enable'          => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_shortcode_co_enable'          => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_shortcode_fl_enable'          => SZ_PLUGIN_GOOGLE_VALUE_YES,		
		'plus_shortcode_size_portrait'      => SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_SIZE_PORTRAIT,
		'plus_shortcode_size_landscape'     => SZ_PLUGIN_GOOGLE_PLUS_SHORTCODE_SIZE_LANDSCAPE,
		'plus_button_enable_plusone'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_button_enable_sharing'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_button_enable_follow'         => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_button_enable_widget_plusone' => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_button_enable_widget_sharing' => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_button_enable_widget_follow'  => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_comments_gp_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_wp_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_ac_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_aw_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_wd_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_sh_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_dt_enable'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_comments_dt_day'              => SZ_PLUGIN_GOOGLE_VALUE_DAY,
		'plus_comments_dt_month'            => SZ_PLUGIN_GOOGLE_VALUE_MONTH,
		'plus_comments_dt_year'             => SZ_PLUGIN_GOOGLE_VALUE_YEAR,
		'plus_comments_fixed_size'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_comments_title'               => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_comments_css_class_1'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_comments_css_class_2'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_sign'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_redirect_plus'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_redirect_curl'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_redirect_sign_url'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_plus_url'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_curl_fix'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_curl_url'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_curl_dir'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'plus_redirect_flush'               => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_system_javascript'            => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'plus_post_enable_widget'           => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'plus_post_enable_shortcode'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Analytics

	$settings_ga = array(
		'ga_uacode'                         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'ga_position'                       => SZ_PLUGIN_GOOGLE_GA_HEADER,
		'ga_enable_front'                   => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'ga_enable_admin'                   => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'ga_enable_administrator'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'ga_enable_logged'                  => SZ_PLUGIN_GOOGLE_VALUE_NO,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Drive

	$settings_drive = array(
		'drive_sitename'                    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'drive_savebutton_widget'           => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'drive_savebutton_shortcode'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Groups

	$settings_groups = array(
		'groups_widget'                     => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'groups_shortcode'                  => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'groups_language'                   => SZ_PLUGIN_GOOGLE_VALUE_LANG,
		'groups_name'                       => SZ_PLUGIN_GOOGLE_GROUPS_NAME,
		'groups_showsearch'                 => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'groups_showtabs'                   => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'groups_hidetitle'                  => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'groups_hidesubject'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'groups_width'                      => SZ_PLUGIN_GOOGLE_GROUPS_WIDTH,
		'groups_height'                     => SZ_PLUGIN_GOOGLE_GROUPS_HEIGHT,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Panoramio

	$settings_panoramio = array(
		'panoramio_widget'                  => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'panoramio_shortcode'               => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'panoramio_s_template'              => SZ_PLUGIN_GOOGLE_PANORAMIO_S_TEMPLATE,
		'panoramio_s_width'                 => SZ_PLUGIN_GOOGLE_PANORAMIO_S_WIDTH,
		'panoramio_s_height'                => SZ_PLUGIN_GOOGLE_PANORAMIO_S_HEIGHT,
		'panoramio_s_orientation'           => SZ_PLUGIN_GOOGLE_PANORAMIO_S_ORIENTATION,
		'panoramio_s_list_size'             => SZ_PLUGIN_GOOGLE_PANORAMIO_S_LIST_SIZE,
		'panoramio_s_position'              => SZ_PLUGIN_GOOGLE_PANORAMIO_S_POSITION,
		'panoramio_s_paragraph'             => SZ_PLUGIN_GOOGLE_PANORAMIO_S_PARAGRAPH,
		'panoramio_w_template'              => SZ_PLUGIN_GOOGLE_PANORAMIO_W_TEMPLATE,
		'panoramio_w_width'                 => SZ_PLUGIN_GOOGLE_PANORAMIO_W_WIDTH,
		'panoramio_w_height'                => SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT,
		'panoramio_w_orientation'           => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ORIENTATION,
		'panoramio_w_list_size'             => SZ_PLUGIN_GOOGLE_PANORAMIO_W_LIST_SIZE,
		'panoramio_w_position'              => SZ_PLUGIN_GOOGLE_PANORAMIO_W_POSITION,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Analytics

	$settings_translate = array(
		'translate_meta'                    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'translate_mode'                    => SZ_PLUGIN_GOOGLE_TRANSLATE_MODE,
		'translate_language'                => SZ_PLUGIN_GOOGLE_VALUE_LANG,
		'translate_to'                      => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'translate_widget'                  => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'translate_shortcode'               => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'translate_automatic'               => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'translate_multiple'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'translate_analytics'               => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'translate_analytics_ua'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
	);

	// Impostazione valori di default che riguardano
	// il modulo collegato alle funzioni di Google Youtube

	$settings_youtube = array(
		'youtube_channel'                   => SZ_PLUGIN_GOOGLE_YOUTUBE_CHANNEL,
		'youtube_widget'                    => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_widget_badge'              => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_widget_playlist'           => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_shortcode'                 => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_shortcode_badge'           => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_shortcode_button'          => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_shortcode_link'            => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_shortcode_playlist'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_responsive'                => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_width'                     => SZ_PLUGIN_GOOGLE_YOUTUBE_WIDTH,
		'youtube_height'                    => SZ_PLUGIN_GOOGLE_YOUTUBE_HEIGHT,
		'youtube_margin_top'                => SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_TOP,
		'youtube_margin_right'              => SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_RIGHT,
		'youtube_margin_bottom'             => SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_BOTTOM,
		'youtube_margin_left'               => SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_LEFT,
		'youtube_margin_unit'               => SZ_PLUGIN_GOOGLE_YOUTUBE_MARGIN_UNIT,
		'youtube_force_ssl'                 => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_autoplay'                  => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_loop'                      => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_fullscreen'                => SZ_PLUGIN_GOOGLE_VALUE_YES,
		'youtube_disablekeyboard'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_theme'                     => SZ_PLUGIN_GOOGLE_YOUTUBE_THEME,
		'youtube_cover'                     => SZ_PLUGIN_GOOGLE_YOUTUBE_COVER,
		'youtube_disableiframe'             => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_analytics'                 => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_delayed'                   => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_schemaorg'                 => SZ_PLUGIN_GOOGLE_VALUE_NO,
		'youtube_disablerelated'            => SZ_PLUGIN_GOOGLE_VALUE_NO,
	);

	// Controllo formale delle opzioni e memorizzazione sul database
	// in base ad una prima installazione o update del plugin 

	sz_google_module_check_options('sz_google_options_base'     ,$settings_base); 
	sz_google_module_check_options('sz_google_options_plus'     ,$settings_plus); 
	sz_google_module_check_options('sz_google_options_ga'       ,$settings_ga);
	sz_google_module_check_options('sz_google_options_drive'    ,$settings_drive); 
	sz_google_module_check_options('sz_google_options_groups'   ,$settings_groups);
	sz_google_module_check_options('sz_google_options_panoramio',$settings_panoramio);
	sz_google_module_check_options('sz_google_options_translate',$settings_translate);
	sz_google_module_check_options('sz_google_options_youtube'  ,$settings_youtube);

	// Esecuzione flush rules per regole di rewrite personalizzate

	add_action('wp_loaded','sz_google_module_flush_rules');
}

register_activation_hook( __FILE__,'sz_google_plugin_activate');

/* ************************************************************************** */
/* Funzione per esecuzione operazioni in fase di disattivazione plugin        */
/* ************************************************************************** */

function sz_google_plugin_deactivate() {
	sz_google_module_flush_rules();
}

register_deactivation_hook( __FILE__,'sz_google_plugin_deactivate');

/* ************************************************************************** */
/* Inclusione delle funzioni generali per aggiunta di tutti i componenti      */
/* ************************************************************************** */

@require_once(dirname(__FILE__).'/modules/sz-google-module.php');
@require_once(dirname(__FILE__).'/modules/sz-google-functions.php');

/* ************************************************************************** */
/* Inclusione delle funzioni da usare in admin                                */
/* ************************************************************************** */

if (is_admin()) {
	@include_once(dirname(__FILE__).'/admin/sz-google-admin.php');
}
