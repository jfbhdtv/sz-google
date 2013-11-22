<?php
/**
 * Modulo GOOGLE ANALYTICS per la definizione delle funzioni che riguardano
 * sia i widget che i shortcode ma anche filtri e azioni che il modulo
 * può integrare durante l'aggiunta di funzionalità a wordpress.
 *
 * @package SZGoogle
 */
if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();

/**
 * Definizione della classe principale da utilizzare per questo
 * modulo. La classe deve essere una extends di SZGoogleModule
 * dove bisogna ridefinire il metodo per il calcolo delle opzioni.
 */
class SZGoogleModuleAnalytics extends SZGoogleModule
{
	function __construct() 
	{
		parent::__construct();
	}

	/**
	 * Calcolo le opzioni legate al modulo con esecuzione dei 
	 * controlli formali di coerenza e impostazione dei default
	 *
	 * @return array
	 */
	function getOptions()
	{
		$options = get_option('sz_google_options_ga');

		// Controllo delle opzioni in caso di valori non esistenti
		// richiamo della funzione per il controllo isset()

		$options = $this->checkOptionIsSet($options,array(
			'ga_type'                 => SZ_PLUGIN_GOOGLE_GA_TYPE,
			'ga_uacode'               => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'ga_position'             => SZ_PLUGIN_GOOGLE_GA_HEADER,
			'ga_enable_front'         => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'ga_enable_admin'         => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_administrator' => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_logged'        => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_subdomain'     => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_multiple'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_advertiser'    => SZ_PLUGIN_GOOGLE_VALUE_NO,
		));

		// Controllo delle opzioni in caso di valori non conformi
		// richiamo della funzione per il controllo yes or no

		$options = $this->checkOptionIsYesNo($options,array(
			'ga_enable_front'         => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'ga_enable_admin'         => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_administrator' => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_logged'        => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_subdomain'     => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_multiple'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'ga_enable_advertiser'    => SZ_PLUGIN_GOOGLE_VALUE_NO,
		));	

		// Ritorno indietro il gruppo di opzioni corretto dai
		// controlli formali della funzione di reperimento opzioni

		return $options;
	}

	/**
	 * Aggiungo le azioni del modulo corrente, questa funzione deve
	 * essere implementate per ogni modulo in maniera personalizzata
	 * non è possibile creare una funzione di standardizzazione
	 *
	 * @return void
	 */
	function moduleAddActions()
	{
		$options = $this->getOptions();

		// Se sono sul front end aggiungo azione header o footer in
		// base a quello che è stato specificato nell'opzione di configurazione 

		if (!is_admin() and $options['ga_enable_front'] == SZ_PLUGIN_GOOGLE_VALUE_YES)
		{
			if (SZ_PLUGIN_GOOGLE_DEBUG) {
				SZGoogleDebug::log('execute exec-mods point register google analytics');
			}

			if ($options['ga_position'] == SZ_PLUGIN_GOOGLE_GA_HEADER) add_action('wp_head'  ,'sz_google_module_analytics_add_script');
			if ($options['ga_position'] == SZ_PLUGIN_GOOGLE_GA_FOOTER) add_action('wp_footer','sz_google_module_analytics_add_script');
		}
	}
}


global $SZ_ANALYTICS_OBJECT;

$SZ_ANALYTICS_OBJECT = new SZGoogleModuleAnalytics();
$SZ_ANALYTICS_OBJECT->moduleAddActions();

/* ************************************************************************** */ 
/* Scrittura del codice javascript necessario alla visualizzazione widgets    */
/* ************************************************************************** */ 

function sz_google_module_analytics_add_script() {
	echo sz_google_module_analytics_get_code(array());
}

/* ************************************************************************** */ 
/* Scrittura del codice javascript necessario alla visualizzazione widgets    */
/* ************************************************************************** */ 

function sz_google_module_analytics_get_ID()
{
	global $SZ_ANALYTICS_OBJECT;
	$options = $SZ_ANALYTICS_OBJECT->getOptions();

	$guacode = trim($options['ga_uacode']);   

	return $guacode;
}

/* ************************************************************************** */ 
/* Scrittura del codice javascript necessario alla visualizzazione widgets    */
/* ************************************************************************** */ 

function sz_google_module_analytics_get_code($atts=array())
{
	global $SZ_ANALYTICS_OBJECT;
	$options = $SZ_ANALYTICS_OBJECT->getOptions();

	// Estrazione dei valori specificati nello shortcode, i valori ritornati
	// sono contenuti nei nomi di variabili corrispondenti alla chiave

	if (!is_array($atts)) $atts = array();

	extract(shortcode_atts(array(
		'ga_type'                 => trim($options['ga_type']),
		'ga_uacode'               => trim($options['ga_uacode']),
		'ga_position'             => trim($options['ga_position']),
		'ga_enable_front'         => trim($options['ga_enable_front']),
		'ga_enable_admin'         => trim($options['ga_enable_admin']),
		'ga_enable_administrator' => trim($options['ga_enable_administrator']),
		'ga_enable_logged'        => trim($options['ga_enable_logged']),
		'ga_enable_subdomain'     => trim($options['ga_enable_subdomain']),
		'ga_enable_multiple'      => trim($options['ga_enable_multiple']),
		'ga_enable_advertiser'    => trim($options['ga_enable_advertiser']),
	),$atts));

	// Elimino spazi aggiunti di troppo ed esegui la trasformazione in
	// stringa minuscolo per il controllo di valori speciali come "auto"

	$ga_uacode               = trim($ga_uacode);
	$ga_type                 = strtolower(trim($ga_type));
	$ga_position             = strtolower(trim($ga_position));
	$ga_enable_front         = strtolower(trim($ga_enable_front));
	$ga_enable_admin         = strtolower(trim($ga_enable_admin));
	$ga_enable_administrator = strtolower(trim($ga_enable_administrator));
	$ga_enable_logged        = strtolower(trim($ga_enable_logged));
	$ga_enable_subdomain     = strtolower(trim($ga_enable_subdomain));
	$ga_enable_multiple      = strtolower(trim($ga_enable_multiple));
	$ga_enable_advertiser    = strtolower(trim($ga_enable_advertiser));

	// Conversione dei valori specificati direttamete nei parametri con
	// i valori usati per la memorizzazione dei valori di default

	if ($ga_enable_front         == 'yes' or $ga_enable_front         == 'y') $ga_enable_front         = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_admin         == 'yes' or $ga_enable_admin         == 'y') $ga_enable_admin         = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_administrator == 'yes' or $ga_enable_administrator == 'y') $ga_enable_administrator = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_logged        == 'yes' or $ga_enable_logged        == 'y') $ga_enable_logged        = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_subdomain     == 'yes' or $ga_enable_subdomain     == 'y') $ga_enable_subdomain     = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_multiple      == 'yes' or $ga_enable_multiple      == 'y') $ga_enable_multiple      = SZ_PLUGIN_GOOGLE_VALUE_YES; 
	if ($ga_enable_advertiser    == 'yes' or $ga_enable_advertiser    == 'y') $ga_enable_advertiser    = SZ_PLUGIN_GOOGLE_VALUE_YES; 

	if ($ga_enable_front         == 'no'  or $ga_enable_front         == 'n') $ga_enable_front         = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_admin         == 'no'  or $ga_enable_admin         == 'n') $ga_enable_admin         = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_administrator == 'no'  or $ga_enable_administrator == 'n') $ga_enable_administrator = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_logged        == 'no'  or $ga_enable_logged        == 'n') $ga_enable_logged        = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_subdomain     == 'no'  or $ga_enable_subdomain     == 'n') $ga_enable_subdomain     = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_multiple      == 'no'  or $ga_enable_multiple      == 'n') $ga_enable_multiple      = SZ_PLUGIN_GOOGLE_VALUE_NO; 
	if ($ga_enable_advertiser    == 'no'  or $ga_enable_advertiser    == 'n') $ga_enable_advertiser    = SZ_PLUGIN_GOOGLE_VALUE_NO; 

	// Controllo se sono loggato come amministratore o utente registrato
	// e disattivo il caricamento del codice se le opzioni sono disattivate 

	$useract = true;

	if (current_user_can('manage_options')) {
		if ($ga_enable_administrator == SZ_PLUGIN_GOOGLE_VALUE_NO) $useract = false;
	} else {
		if (is_user_logged_in() and $ga_enable_logged == SZ_PLUGIN_GOOGLE_VALUE_NO) $useract = false;   
	}

	// Controllo se sono in backend o frontend e abilito l'esecuzione del codice
	// solo se le opzioni corrispondenti sono state attivate in configurazione

	if ( is_admin() and $ga_enable_admin == SZ_PLUGIN_GOOGLE_VALUE_NO) $useract = false;
	if (!is_admin() and $ga_enable_front == SZ_PLUGIN_GOOGLE_VALUE_NO) $useract = false;

	// Se il codice non deve essere attivato in base alle opzioni passate
	// ritorno un valore di false e non elaboro la creazione del monitoraggio

	if (!$useract or strlen($ga_uacode) <= 0) {
		return false;
	}

	// Conversione dei valori specificati direttamete nei parametri con
	// i valori usati per la memorizzazione dei valori di default

	if ($ga_uacode   == SZ_PLUGIN_GOOGLE_VALUE_NULL)  $ga_uacode   = sz_google_module_analytics_get_ID();   
	if ($ga_position == SZ_PLUGIN_GOOGLE_VALUE_NULL)  $ga_position = SZ_PLUGIN_GOOGLE_GA_HEADER;   

	if (!in_array($ga_type,array('classic','universal'))) $ga_type = SZ_PLUGIN_GOOGLE_GA_TYPE;

	// Creazione codice di google analytics UNIVERSAL da inserire su pagina HTML
	// che può essere differente in base a google classic o universal analytics

	if ($ga_type == SZ_PLUGIN_GOOGLE_GA_UNIVERSAL) 
	{
		$HTML  = '<script type="text/javascript">//<![CDATA['."\n";
		$HTML .= "// SZ-Google ".SZ_PLUGIN_GOOGLE_VERSION." module for Google Analytics => ".SZ_PLUGIN_GOOGLE_REPOSITORY."\n";
		$HTML .= "// SZ-Google ".SZ_PLUGIN_GOOGLE_VERSION." module for Google Analytics => activated mode ".strtoupper($ga_type)."\n";

		$HTML .= "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){"."\n";
		$HTML .= "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),"."\n";
		$HTML .= "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)"."\n";
		$HTML .= "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');"."\n";

		$HTML .= "ga('create','".trim($ga_uacode)."','".trim(SZGoogleCommon::getCurrentDomain())."');"."\n";
		$HTML .= "ga('send','pageview');"."\n";

		$HTML .= "//]]></script>"."\n";

		return $HTML;
	}

	// Creazione codice di google analytics CLASSIC da inserire su pagina HTML
	// che può essere differente in base a google classic o universal analytics

	if ($ga_type == SZ_PLUGIN_GOOGLE_GA_CLASSIC) 
	{
		$HTML  = '<script type="text/javascript">//<![CDATA['."\n";
		$HTML .= "// SZ-Google ".SZ_PLUGIN_GOOGLE_VERSION." module for Google Analytics => ".SZ_PLUGIN_GOOGLE_REPOSITORY."\n";
		$HTML .= "// SZ-Google ".SZ_PLUGIN_GOOGLE_VERSION." module for Google Analytics => activated mode ".strtoupper($ga_type)."\n";

		$HTML .= "var _gaq = _gaq || [];"."\n";

		$HTML .= "_gaq.push(['_setAccount','".$ga_uacode."']);"."\n";

		// Se opzione subdomains o multiple risulta attivata aggiungo una nuova riga
		// di codice contenente il _setDomainName del domino corrente visualizzato

		if ($ga_enable_subdomain == SZ_PLUGIN_GOOGLE_VALUE_YES or $ga_enable_multiple  == SZ_PLUGIN_GOOGLE_VALUE_YES) {
			$HTML .= "_gaq.push(['_setDomainName','".trim(SZGoogleCommon::getCurrentDomain())."']);"."\n";
		}

		// Se opzione multiple risulta attivata aggiungo una nuova riga con il codice
		// javascript di google analytics con l'impostazione di _setAllowLinker

		if ($ga_enable_multiple == SZ_PLUGIN_GOOGLE_VALUE_YES) {
			$HTML .= "_gaq.push(['_setAllowLinker',true]);"."\n";
		}

		$HTML .= "_gaq.push(['_trackPageview']);"."\n";

		$HTML .= "(function () {"."\n";
		$HTML .= "var ga = document.createElement('script');"."\n";
		$HTML .= "ga.type = 'text/javascript';"."\n";
		$HTML .= "ga.async = true;"."\n";

		if ($ga_enable_advertiser == SZ_PLUGIN_GOOGLE_VALUE_YES) $HTML .= "ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';"."\n";
			else $HTML .= "ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';"."\n";

		$HTML .= "var s = document.getElementsByTagName('script')[0];"."\n";
		$HTML .= "s.parentNode.insertBefore(ga, s);"."\n";
		$HTML .= "})();"."\n";
		$HTML .= "//]]></script>"."\n";
	
		return $HTML;
	}
}
