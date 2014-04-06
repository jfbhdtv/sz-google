<?php
/**
 * Modulo GOOGLE GROUPS per la definizione delle funzioni che riguardano
 * sia i widget che i shortcode ma anche filtri e azioni che il modulo
 * può integrare durante l'aggiunta di funzionalità a wordpress.
 *
 * @package SZGoogle
 */
if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();

/**
 * Prima della definizione della classe controllo se esiste
 * una definizione con lo stesso nome o già definita la stessa.
 */
if (!class_exists('SZGoogleModuleGroups'))
{
	/**
	 * Definizione della classe principale da utilizzare per questo
	 * modulo. La classe deve essere una extends di SZGoogleModule
	 * dove bisogna ridefinire il metodo per il calcolo delle opzioni.
	 */
	class SZGoogleModuleGroups extends SZGoogleModule
	{
		/**
		 * Definizione della funzione costruttore che viene richiamata
		 * nel momento della creazione di un'istanza con questa classe
		 */
		function __construct()
		{
			parent::__construct('SZGoogleModuleGroups');

			$this->moduleShortcodes = array(
				'groups_shortcode' => array('sz-ggroups',array($this,'getGoogleGroupsShortcode')),
			);

			$this->moduleWidgets = array(
				'groups_widget'    => 'SZGoogleWidgetGroups',
			);

			// Esecuzione dei componenti esistenti legati al modulo come
			// le azioni generali e la generazione di shortcode e widget.

			$this->moduleAddShortcodes();
			$this->moduleAddWidgets();
		}

		/**
		 * Calcolo le opzioni legate al modulo con esecuzione dei 
		 * controlli formali di coerenza e impostazione dei default
		 *
		 * @return array
		 */
		function getOptions()
		{
			$options = get_option('sz_google_options_groups');

			// Controllo delle opzioni in caso di valori non esistenti
			// richiamo della funzione per il controllo isset()

			$options = $this->checkOptionIsSet($options,array(
				'groups_widget'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_shortcode'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_language'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_name'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_showsearch'  => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_showtabs'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_hidetitle'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_hidesubject' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_width'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'groups_height'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			));

			// Controllo delle opzioni in caso di valori non conformi
			// richiamo della funzione per il controllo isnull()

			$options = $this->checkOptionIsNull($options,array(
				'groups_language'    => SZ_PLUGIN_GOOGLE_VALUE_LANG,
				'groups_name'        => SZ_PLUGIN_GOOGLE_GROUPS_NAME,
				'groups_width'       => SZ_PLUGIN_GOOGLE_GROUPS_WIDTH,
				'groups_height'      => SZ_PLUGIN_GOOGLE_GROUPS_HEIGHT,
			));

			// Controllo delle opzioni in caso di valori non conformi
			// richiamo della funzione per il controllo Yes o No

			$options = $this->checkOptionIsYesNo($options,array(
				'groups_widget'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups_shortcode'   => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups_showsearch'  => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups_showtabs'    => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups_hidetitle'   => SZ_PLUGIN_GOOGLE_VALUE_NO,
				'groups_hidesubject' => SZ_PLUGIN_GOOGLE_VALUE_NO,
			));

			// Ritorno indietro il gruppo di opzioni corretto dai
			// controlli formali della funzione di reperimento opzioni

			return $options;
		}

		/**
		 * Esecuzione codice per lo shortcode legato al widget
		 * di google gruppi in embed tramite tecnica di iframe.
		 *
		 * @return void
		 */
		function getGoogleGroupsShortcode($atts,$content=null)
		{
			return $this->getGoogleGroupsCode(shortcode_atts(array(
				'name'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'width'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'height'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'showsearch'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'showtabs'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hideforumtitle' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hidesubject'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hl'             => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'action'         => SZ_PLUGIN_GOOGLE_VALUE_TEXT_SHORTCODE,
			),$atts),$content);
		}

		/**
		 * Esecuzione codice per lo shortcode legato al widget
		 * di google gruppi in embed tramite tecnica di iframe.
		 *
		 * @return void
		 */
		function getGoogleGroupsCode($atts=array(),$content=null)
		{
			$options = $this->getOptions();

			if ($options['groups_showsearch']  == SZ_PLUGIN_GOOGLE_VALUE_YES) $options['groups_showsearch']  = 'true'; else $options['groups_showsearch']  = 'false';  
			if ($options['groups_showtabs']    == SZ_PLUGIN_GOOGLE_VALUE_YES) $options['groups_showtabs']    = 'true'; else $options['groups_showtabs']    = 'false';  
			if ($options['groups_hidetitle']   == SZ_PLUGIN_GOOGLE_VALUE_YES) $options['groups_hidetitle']   = 'true'; else $options['groups_hidetitle']   = 'false';  
			if ($options['groups_hidesubject'] == SZ_PLUGIN_GOOGLE_VALUE_YES) $options['groups_hidesubject'] = 'true'; else $options['groups_hidesubject'] = 'false';  

			// Se non è specificvata nessuna lingua o quella del tema richiamo
			// la funzione nativa di wordpress per calcolare la lingua di sistema

			if ($options['groups_language'] == SZ_PLUGIN_GOOGLE_VALUE_LANG) $language = substr(get_bloginfo('language'),0,2);	
				else $language = trim($options['groups_language']);

			// Estrazione dei valori specificati nello shortcode, i valori ritornati
			// sono contenuti nei nomi di variabili corrispondenti alla chiave

			if (!is_array($atts)) $atts = array();

			extract(shortcode_atts(array(
				'name'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'width'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'height'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'showsearch'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'showtabs'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hideforumtitle' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hidesubject'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'hl'             => SZ_PLUGIN_GOOGLE_VALUE_NULL,
				'action'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			),$atts));

			// Controllo le variabili che devono avere obbligatorio il valore 
			// di true o false, in caso diverso prendo il valore di default specificato 

			$hl             = trim($hl);
			$name           = trim($name);
			$showsearch     = strtolower(trim($showsearch));
			$showtabs       = strtolower(trim($showtabs));
			$hideforumtitle = strtolower(trim($hideforumtitle));
			$hidesubject    = strtolower(trim($hidesubject));

			if (!in_array($showsearch,    array('true','false'))) $showsearch     = $options['groups_showsearch']; 
			if (!in_array($showtabs,      array('true','false'))) $showtabs       = $options['groups_showtabs']; 
			if (!in_array($hideforumtitle,array('true','false'))) $hideforumtitle = $options['groups_hidetitle']; 
			if (!in_array($hidesubject,   array('true','false'))) $hidesubject    = $options['groups_hidesubject']; 

			// Se non sono riuscito ad assegnare nessun valore con le istruzioni
			// precedenti metto dei default assoluti che possono essere cambiati

			if ($name == SZ_PLUGIN_GOOGLE_VALUE_NULL) $name = $options['groups_name'];
			if ($name == SZ_PLUGIN_GOOGLE_VALUE_NULL) $name = SZ_PLUGIN_GOOGLE_GROUPS_NAME;

			// Se non sono riuscito ad assegnare nessun valore con le istruzioni
			// precedenti metto dei default assoluti che possono essere cambiati

			if ($width  == SZ_PLUGIN_GOOGLE_VALUE_NULL or $width  == SZ_PLUGIN_GOOGLE_VALUE_NO or !is_numeric($width))  $width  = $options['groups_width'];
			if ($height == SZ_PLUGIN_GOOGLE_VALUE_NULL or $height == SZ_PLUGIN_GOOGLE_VALUE_NO or !is_numeric($height)) $height = $options['groups_height'];

			if ($width  == SZ_PLUGIN_GOOGLE_VALUE_NULL or $width  == SZ_PLUGIN_GOOGLE_VALUE_NO or !is_numeric($width))  $width  = '100%';
			if ($height == SZ_PLUGIN_GOOGLE_VALUE_NULL or $height == SZ_PLUGIN_GOOGLE_VALUE_NO or !is_numeric($height)) $height = SZ_PLUGIN_GOOGLE_GROUPS_HEIGHT;

			// Creazione codice HTML per embed code da inserire nella pagina wordpress
			// prima praparo il codice del bottone singolo e poi chiamo funzione di wrapping

			$HTML  = '<script type="text/javascript">';
			$HTML .= "var h='<'+'";
			$HTML .= 'iframe src="https://groups.google.com/forum/embed/?place='.urlencode('forum/'.$name);
			$HTML .= '&amp;hl='.$hl;
			$HTML .= '&amp;showsearch='.$showsearch;
			$HTML .= '&amp;showtabs='.$showtabs;
			$HTML .= '&amp;hideforumtitle='.$hideforumtitle;
			$HTML .= '&amp;hidesubject='.$hidesubject;
			$HTML .= '&amp;showpopout=true';

			// Se sono in locahost non calcolo URL della pagina attuale, in caso
			// contrario allego la funzione javascript per inserire il parametro in URL

			if (isset($_SERVER['HTTP_HOST']) and strtolower($_SERVER['HTTP_HOST']) == 'localhost') 
			{
				$HTML .= '" ';

			} else {

				$HTML .= "&amp;parenturl=' + encodeURIComponent(window.location.href) + '\"' + ";
				$HTML .= "' ";
			}

			$HTML .= 'width="' .$width .'" ';
			$HTML .= 'height="'.$height.'" ';
			$HTML .= 'style="border-width:0" ';
			$HTML .= 'frameborder="0" scrolling="no"';
			$HTML .= "></'+'iframe'+'>';";
			$HTML .= "document.write(h);";
			$HTML .= '</script>';

			// Ritorno per la funzione con tutta la stringa contenente
			// il codice HTML per l'inserimento del codice nella pagina

			return $HTML;
		}
	}

	/**
	 * DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE
	 * DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE
	 * DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE
	 * DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE - DEVELOPER PHP CODE
	 */
	if (!function_exists('szgoogle_groups_get_object')) {
		function szgoogle_groups_get_object() { 
			if (!is_a(SZGoogleModule::$SZGoogleModuleGroups,'SZGoogleModuleGroups')) return false;
				else return SZGoogleModule::$SZGoogleModuleGroups;
		}
	}

	if (!function_exists('szgoogle_groups_get_code')) {
		function szgoogle_groups_get_code($options=array()) {
			if (!$object = szgoogle_groups_get_object()) return false;
				else return $object->getGoogleGroupsCode($options);
		}
	}
}