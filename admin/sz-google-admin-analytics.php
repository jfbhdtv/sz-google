<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_GOOGLE_ADMIN') or !SZ_PLUGIN_GOOGLE_ADMIN) die();

/* ************************************************************************** */ 
/* Controllo le opzioni generali per saper i moduli che devo essere caricati  */
/* ************************************************************************** */ 

$options = sz_google_modules_analytics_options();

// Se sono sul pannello di amministrazione devo controllare se è stata
// attivata l'opzione per abilitare il modulo su amministrazione 

if (is_admin() and $options['ga_enable_admin'] == '1') 
{
	if ($options['ga_position'] == 'H') add_action('admin_head'  ,'sz_google_modules_analytics_add_script');
	if ($options['ga_position'] == 'F') add_action('admin_footer','sz_google_modules_analytics_add_script');
}

/* ************************************************************************** */
/* Creazione e aggiunta menu di amministrazione                               */
/* ************************************************************************** */

function sz_google_admin_analytics_menu() 
{
	if (function_exists('add_submenu_page')) {
		add_submenu_page(SZ_PLUGIN_GOOGLE_ADMIN_BASENAME,'SZ-Google - '.ucwords(__('google analytics','szgoogleadmin')),ucwords(__('google analytics','szgoogleadmin')),'manage_options','sz-google-admin-analytics.php','sz_google_admin_analytics_callback'); 
	}
}

/* ************************************************************************** */
/* Registrazione delle opzioni legate al plugin                               */
/* ************************************************************************** */

function sz_google_admin_analytics_fields()
{
	register_setting('sz_google_options_ga','sz_google_options_ga','sz_google_admin_analytics_validate');

	// Definizione sezione per configurazione GOOGLE ANALYTICS ID

	add_settings_section('sz_google_analytics_section','','sz_google_admin_analytics_section','sz-google-admin-analytics.php');
	add_settings_field('ga_uacode',ucfirst(__('UA code','szgoogleadmin')),'sz_google_admin_analytics_uacode','sz-google-admin-analytics.php','sz_google_analytics_section');
	add_settings_field('ga_position',ucfirst(__('position','szgoogleadmin')),'sz_google_admin_analytics_position','sz-google-admin-analytics.php','sz_google_analytics_section');

	// Definizione sezione per configurazione GOOGLE ANALYTICS ENABLED

	add_settings_section('sz_google_analytics_enabled','','sz_google_admin_analytics_section','sz-google-admin-analytics-enabled.php');
	add_settings_field('ga_enable_front',ucfirst(__('enable frontend','szgoogleadmin')),'sz_google_admin_analytics_enable_front','sz-google-admin-analytics-enabled.php','sz_google_analytics_enabled');
	add_settings_field('ga_enable_admin',ucfirst(__('enable admin panel','szgoogleadmin')),'sz_google_admin_analytics_enable_admin','sz-google-admin-analytics-enabled.php','sz_google_analytics_enabled');
	add_settings_field('ga_enable_admin_administrator',ucfirst(__('enable administrator','szgoogleadmin')),'sz_google_admin_analytics_enable_administrator','sz-google-admin-analytics-enabled.php','sz_google_analytics_enabled');
	add_settings_field('ga_enable_admin_logged',ucfirst(__('enable user logged','szgoogleadmin')),'sz_google_admin_analytics_enable_logged','sz-google-admin-analytics-enabled.php','sz_google_analytics_enabled');
}

/* ************************************************************************** */
/* Aggiungo le funzioni per l'esecuzione in admin                             */
/* ************************************************************************** */

add_action('admin_menu','sz_google_admin_analytics_menu');
add_action('admin_init','sz_google_admin_analytics_fields');

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione Google analytics                       */
/* ************************************************************************** */

function sz_google_admin_analytics_callback() 
{
	// Definizione delle sezioni che devono essere composte in HTML
	// le sezioni devono essere passate come un array con nome => titolo

	$sections = array(
		'sz-google-admin-analytics.php'         => ucwords(__('general settings','szgoogleadmin')),
		'sz-google-admin-analytics-enabled.php' => ucwords(__('activation tracking code' ,'szgoogleadmin')),
	);

	// Chiamata alla funzione generale per la creazione del form generale
	// le sezioni devono essere passate come un array con nome => titolo

	sz_google_common_form(ucfirst(__('google Analytics configuration','szgoogleadmin')),'sz_google_options_ga',$sections); 
}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione GOOGLE ANALYTICS                       */
/* ************************************************************************** */

function sz_google_admin_analytics_uacode() 
{
	sz_google_common_form_text('sz_google_options_ga','ga_uacode','medium',__('insert your UA code','szgoogleadmin'));
	sz_google_common_form_description(__('specify the code assigned to the profile of google analytics, to find enough to enter the admin panel google analytics and see the code assigned such as UA-12345-12. If this code is not specified will not be generated the tracking code for google analytics.','szgoogleadmin'));
}

function sz_google_admin_analytics_position() 
{
	$values = array(
		'H' => __('header (default)','szgoogleadmin'),
		'F' => __('footer','szgoogleadmin'),
		'M' => __('insert manually','szgoogleadmin'),
	); 

	sz_google_common_form_select('sz_google_options_ga','ga_position',$values,'medium','');
	sz_google_common_form_description(__('specifies the location of the tracking code in the page HTML. The recommended position is the header that does not allow the loss of access statistics. If you specify the manual mode you have to use the <code>szgoogle_get_analytics_code()</code> and insert it into the code of your theme.','szgoogleadmin'));
}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione GOOGLE ANALYTICS                       */
/* ************************************************************************** */

function sz_google_admin_analytics_enable_front() 
{ 
	sz_google_common_form_checkbox_yesno('sz_google_options_ga','ga_enable_front');
	sz_google_common_form_description(__('enable this option to activate the tracking code to the public pages of your website. This option can also be used to disable the code without disabling the module. To check the tracking code on the basis of connected users use the options to follow as admin or users logged.','szgoogleadmin'));
}

function sz_google_admin_analytics_enable_admin() 
{ 
	sz_google_common_form_checkbox_yesno('sz_google_options_ga','ga_enable_admin');
	sz_google_common_form_description(__('this option allows you to insert the tracking code in the admin pages. Useful function for some tests but not recommended during normal operation. Do not confuse this option with the administrator user which controls the type of user logged and not the execution environment.','szgoogleadmin'));
}

function sz_google_admin_analytics_enable_administrator() 
{ 
	sz_google_common_form_checkbox_yesno('sz_google_options_ga','ga_enable_administrator');
	sz_google_common_form_description(__('this option allows you to enter the tracking code when you browse the website as an administrator user. It is recommended to leave this option off as not to affect access statistics. This option is used for both the frontend and backend environment.','szgoogleadmin'));
}

function sz_google_admin_analytics_enable_logged() 
{ 
	sz_google_common_form_checkbox_yesno('sz_google_options_ga','ga_enable_logged');
	sz_google_common_form_description(__('with this option, you can check the tracking code for users who are connected to the website. The behavior of this option is similar to option regarding the administrator user. This option is used for both the frontend and backend environment.','szgoogleadmin'));
}

/* ************************************************************************** */
/* Funzioni per la definizione dei campi legati a modulo                      */
/* ************************************************************************** */

function sz_google_admin_analytics_validate($plugin_options) {
  return $plugin_options;
}

function sz_google_admin_analytics_section() {}