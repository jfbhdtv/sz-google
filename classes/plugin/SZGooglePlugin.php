<?php
/**
 * Classe SZGooglePlugin per la definizione di alcuni metodi statici
 * legati al plugin che devono eseguire alcune funzioni particolari,
 * come ad esempio la funzione di attivazione o disattivazione. 
 *
 * @package SZGoogle
 */
if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();

/**
 * Prima della definizione della classe controllo se esiste
 * una definizione con lo stesso nome o già definita la stessa.
 */
if (!class_exists('SZGooglePlugin'))
{
	class SZGooglePlugin
	{
		/**
		 * Esecuzione funzione di disattivazionbe plugin, questo metodo viene
		 * collegato in wordpress tramite la funzione register_deactivation_hook()
		 *
		 * @return void
		 */
		public static function deactivate() 
		{
			SZGooglePluginCommon::rewriteFlushRules();
		}

		/**
		 * Esecuzione funzione di attivazionbe plugin, questo metodo viene
		 * collegato in wordpress tramite la funzione register_activation_hook()
		 *
		 * @return void
		 */
		public static function activate()
		{
			// Impostazione valori di default che riguardano  
			// parametri di base come l'attivazione dei moduli 

			$settings_base = array(
				'plus'                              => SZ_PLUGIN_GOOGLE_VALUE_YES,
				'analytics'                         => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'authenticator'                     => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'calendar'                          => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'drive'                             => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'fonts'                             => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups'                            => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'hangouts'                          => SZ_PLUGIN_GOOGLE_VALUE_NO,
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
				'plus_enable_author'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'plus_enable_publisher'             => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'plus_enable_recommendations'       => SZ_PLUGIN_GOOGLE_VALUE_NO,
			);

			// Impostazione valori di default che riguardano
			// il modulo collegato alle funzioni di Google Analytics

			$settings_ga = array(
				'ga_type'                           => SZ_PLUGIN_GOOGLE_GA_TYPE,
				'ga_uacode'                         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'ga_position'                       => SZ_PLUGIN_GOOGLE_GA_HEADER,
				'ga_enable_front'                   => SZ_PLUGIN_GOOGLE_VALUE_YES,
				'ga_enable_admin'                   => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'ga_enable_administrator'           => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'ga_enable_logged'                  => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'ga_enable_subdomain'               => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'ga_enable_multiple'                => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'ga_enable_advertiser'              => SZ_PLUGIN_GOOGLE_VALUE_NO,
			);

			// Impostazione valori di default che riguardano
			// il modulo collegato alle funzioni di Google Authenticator

			$settings_authenticator = array(
				'authenticator_login_enable'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
				'authenticator_login_type'          => SZ_PLUGIN_GOOGLE_VALUE_ONE,
				'authenticator_discrepancy'         => SZ_PLUGIN_GOOGLE_VALUE_ONE,
			);

			// Impostazione valori di default che riguardano
			// il modulo collegato alle funzioni di Google Calendar

			$settings_calendar = array(
				'calendar_o_calendars'              => SZ_PLUGIN_GOOGLE_CALENDAR_O_CALENDARS,
				'calendar_o_title'                  => SZ_PLUGIN_GOOGLE_CALENDAR_O_TITLE,
				'calendar_o_mode'                   => SZ_PLUGIN_GOOGLE_CALENDAR_O_MODE,
				'calendar_o_weekstart'              => SZ_PLUGIN_GOOGLE_CALENDAR_O_WEEKSTART,
				'calendar_o_language'               => SZ_PLUGIN_GOOGLE_CALENDAR_O_LANGUAGE,
				'calendar_o_timezone'               => SZ_PLUGIN_GOOGLE_CALENDAR_O_TIMEZONE,
				'calendar_s_enable'                 => SZ_PLUGIN_GOOGLE_CALENDAR_S_ENABLE,
				'calendar_s_calendars'              => SZ_PLUGIN_GOOGLE_CALENDAR_S_CALENDARS,
				'calendar_s_title'                  => SZ_PLUGIN_GOOGLE_CALENDAR_S_TITLE,
				'calendar_s_width'                  => SZ_PLUGIN_GOOGLE_CALENDAR_S_WIDTH,
				'calendar_s_height'                 => SZ_PLUGIN_GOOGLE_CALENDAR_S_HEIGHT,
				'calendar_s_show_title'             => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_TITLE,
				'calendar_s_show_navs'              => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_NAVS,
				'calendar_s_show_date'              => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_DATE,
				'calendar_s_show_print'             => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_PRINT,
				'calendar_s_show_tabs'              => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_TABS,
				'calendar_s_show_calendars'         => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_CALENDARS,
				'calendar_s_show_timezone'          => SZ_PLUGIN_GOOGLE_CALENDAR_S_SHOW_TIMEZONE,
				'calendar_w_enable'                 => SZ_PLUGIN_GOOGLE_CALENDAR_W_ENABLE,
				'calendar_w_calendars'              => SZ_PLUGIN_GOOGLE_CALENDAR_W_CALENDARS,
				'calendar_w_title'                  => SZ_PLUGIN_GOOGLE_CALENDAR_W_TITLE,
				'calendar_w_width'                  => SZ_PLUGIN_GOOGLE_CALENDAR_W_WIDTH,
				'calendar_w_height'                 => SZ_PLUGIN_GOOGLE_CALENDAR_W_HEIGHT,
				'calendar_w_show_title'             => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_TITLE,
				'calendar_w_show_navs'              => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_NAVS,
				'calendar_w_show_date'              => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_DATE,
				'calendar_w_show_print'             => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_PRINT,
				'calendar_w_show_tabs'              => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_TABS,
				'calendar_w_show_calendars'         => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_CALENDARS,
				'calendar_w_show_timezone'          => SZ_PLUGIN_GOOGLE_CALENDAR_W_SHOW_TIMEZONE,
			);

			// Impostazione valori di default che riguardano
			// il modulo collegato alle funzioni di Google Drive

			$settings_drive = array(
				'drive_sitename'                    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'drive_savebutton_widget'           => SZ_PLUGIN_GOOGLE_VALUE_YES,
				'drive_savebutton_shortcode'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
			);

			// Impostazione valori di default che riguardano
			// il modulo collegato alle funzioni di Google Fonts

			$settings_fonts = array(
				'fonts_family_L1_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_L2_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_L3_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_L4_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_L5_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_L6_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_B1_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_P1_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_B2_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H1_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H2_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H3_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H4_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H5_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'fonts_family_H6_name'              => SZ_PLUGIN_GOOGLE_VALUE_NULL,
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
			// il modulo collegato alle funzioni di Google Hangouts

			$settings_hangouts = array(
				'hangouts_start_widget'             => SZ_PLUGIN_GOOGLE_VALUE_YES,
				'hangouts_start_shortcode'          => SZ_PLUGIN_GOOGLE_VALUE_YES,
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

			self::checkOptions('sz_google_options_base'         ,$settings_base); 
			self::checkOptions('sz_google_options_plus'         ,$settings_plus); 
			self::checkOptions('sz_google_options_ga'           ,$settings_ga);
			self::checkOptions('sz_google_options_authenticator',$settings_authenticator);
			self::checkOptions('sz_google_options_calendar'     ,$settings_calendar); 
			self::checkOptions('sz_google_options_drive'        ,$settings_drive); 
			self::checkOptions('sz_google_options_fonts'        ,$settings_fonts); 
			self::checkOptions('sz_google_options_groups'       ,$settings_groups);
			self::checkOptions('sz_google_options_hangouts'     ,$settings_hangouts);
			self::checkOptions('sz_google_options_panoramio'    ,$settings_panoramio);
			self::checkOptions('sz_google_options_translate'    ,$settings_translate);
			self::checkOptions('sz_google_options_youtube'      ,$settings_youtube);

			// Esecuzione flush rules per regole di rewrite personalizzate

			add_action('wp_loaded',array('SZGooglePluginCommon','rewriteFlushRules'));
		}

		/**
		 * Esecuzione funzione di attivazione plugin, questo metodo viene
		 * collegato in wordpress tramite la funzione register_activation_hook()
		 *
		 * @param  string,array $name,$values
		 * @return void
		 */
		public static function checkOptions($name,$values) 
		{
			if (is_array($values)) {

				// Controllo se esistono le opzioni richieste, in caso
				// affermativo passo al controllo di ogni singola opzione 

				if ($options = get_option($name)) 
				{
					if (!is_array($options)) $options=array(); 

					// Controllo se nelle opzioni ci sono degli indici che non
					// vengono più utilizzati li tolgo da array generale

					foreach ($options as $key=>$item) {
						if (!isset($values[$key])) unset($options[$key]);
					}

					// Controllo le opzioni che sono state inserite nel nuovo
					// release e le aggiungo al contenitore array generale

					foreach ($values as $key=>$item) {
						if (!isset($options[$key])) $options[$key]=$item;
					}

					update_option($name,$options);

				} else {

					// Se le opzioni non esistono in quanto il plugin potrebbe
					// essere la prima volta che viene installato -> aggiungo array 

					add_option($name,$values);
				}
			}
		}

		/**
		 * Esecuzione funzione per aggiungere un testo comune di commento HTML
		 * nella parte iniziale del codice che viene aggiunto nella varie sezioni
		 *
		 * @return void
		 */
		public static function getCommonSectionHead()
		{
			$HTML  = "\n";
			$HTML .= "<!-- This section is created with the SZ-Google for WordPress plugin ".SZ_PLUGIN_GOOGLE_VERSION." -->\n";
			$HTML .= "<!-- ===================================================================== -->\n";

			return $HTML;
		}

		/**
		 * Esecuzione funzione per aggiungere un testo comune di commento HTML
		 * nella parte finale del codice che viene aggiunto nella varie sezioni
		 *
		 * @return void
		 */
		public static function getCommonSectionFooter()
		{
			$HTML  = "<!-- ===================================================================== -->\n";
			$HTML .= "\n";

			return $HTML;
		}

		/**
		 * Esecuzione funzione per aggiungere dei valori alla sezione <head>
		 * della pagina HTML collegata con WP_HEAD tramite action(szgoogle-head)
		 *
		 * @return void
		 */
		public static function addSectionHead()
		{
			if(has_action('szgoogle_head')) {				
				echo self::getCommonSectionHead(); do_action('szgoogle_head'); echo self::getCommonSectionFooter();
			}
		}

		/**
		 * Esecuzione funzione per aggiungere dei valori alla sezione <head>
		 * della pagina HTML collegata con WP_HEAD tramite action(szgoogle-head)
		 *
		 * @return void
		 */
		public static function addSectionCSSInline()
		{
			if(has_action('szgoogle_css_inline')) {
				echo self::getCommonSectionHead(); do_action('szgoogle_css_inline'); echo self::getCommonSectionFooter();
			}
		}

		/**
		 * Esecuzione funzione per aggiungere dei valori alla sezione <footer>
		 * della pagina HTML collegata con WP_FOOTER tramite action(szgoogle-footer)
		 *
		 * @return void
		 */
		public static function addSectionFooter()
		{
			if(has_action('SZGoogleFooter')) {
				echo self::getCommonSectionHead(); do_action('SZGoogleFooter'); echo self::getCommonSectionFooter();
			}
		}
	}
}