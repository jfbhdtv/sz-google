<?php
/**
 * Modulo GOOGLE DRIVE per la definizione delle funzioni che riguardano
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
class SZGoogleModuleDrive extends SZGoogleModule
{
	/**
	 * Definizione della funzione costruttore che viene richiamata
	 * nel momento della creazione di un'istanza con questa classe
	 */
	function __construct()
	{
		parent::__construct('SZGoogleModuleDrive');

		$this->moduleShortcodes = array(
			'drive_savebutton_shortcode' => array('sz-drive-save','sz_google_module_drive_shortcodes_savebutton'),
		);

		$this->moduleWidgets = array(
			'drive_savebutton_widget'    => 'sz_google_module_drive_widget_savebutton',
		);
	}

	/**
	 * Calcolo le opzioni legate al modulo con esecuzione dei 
	 * controlli formali di coerenza e impostazione dei default
	 *
	 * @return array
	 */
	function getOptions()
	{
		$options = get_option('sz_google_options_drive');

		// Controllo delle opzioni in caso di valori non esistenti
		// richiamo della funzione per il controllo isset()

		$options = $this->checkOptionIsSet($options,array(
			'drive_sitename'             => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'drive_savebutton_widget'    => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'drive_savebutton_shortcode' => SZ_PLUGIN_GOOGLE_VALUE_NO,
		));

		// Controllo delle opzioni in caso di valori non conformi
		// richiamo della funzione per il controllo Yes o No

		$options = $this->checkOptionIsYesNo($options,array(
			'drive_savebutton_widget'    => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'drive_savebutton_shortcode' => SZ_PLUGIN_GOOGLE_VALUE_NO,
		));

		// Ritorno indietro il gruppo di opzioni corretto dai
		// controlli formali della funzione di reperimento opzioni

		return $options;
	}
}

global $SZ_DRIVE_OBJECT;

/**
 * Creazione oggetto principale per creazione ed elaborazione del
 * modulo richiesto, controllare il costruttore per azioni iniziali
 */
$SZ_DRIVE_OBJECT = new SZGoogleModuleDrive();
$SZ_DRIVE_OBJECT->moduleAddWidgets();
$SZ_DRIVE_OBJECT->moduleAddShortcodes();

/* ************************************************************************** */
/* SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SA */
/* SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SA */
/* SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SA */
/* SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SA */
/* SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SAVE BUTTON SA */
/* ************************************************************************** */

function sz_google_module_drive_get_code_savebutton($atts=array(),$content=null)
{
	// Estrazione dei valori specificati nello shortcode, i valori ritornati
	// sono contenuti nei nomi di variabili corrispondenti alla chiave

	if (!is_array($atts)) $atts = array();

	extract(shortcode_atts(array(
		'url'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'filename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'sitename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'text'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'img'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'position'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'align'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'margintop'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginright'  => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginbottom' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginleft'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginunit'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
	),$atts));

	$DEFAULT_ALIGN      = 'none';
	$DEFAULT_POSITION   = 'outside';

	// Elimino spazi aggiunti di troppo ed esegui la trasformazione in
	// stringa minuscolo per il controllo di valori speciali come "auto"

	$url          = trim($url);
	$filename     = trim($filename);
	$sitename     = trim($sitename);
	$text         = trim($text);
	$img          = trim($img);

	$position     = strtolower(trim($position));
	$align        = strtolower(trim($align));
	$margintop    = strtolower(trim($margintop));
	$marginright  = strtolower(trim($marginright));
	$marginbottom = strtolower(trim($marginbottom));
	$marginleft   = strtolower(trim($marginleft));
	$marginunit   = strtolower(trim($marginunit));

	// Se non specifico un URL valido per la creazione del bottone
	// esco dalla funzione e ritorno una stringa vuota

	if (empty($url)) { return SZ_PLUGIN_GOOGLE_VALUE_NULL; }

	// Imposto i valori di default nel caso siano specificati dei valori
	// che non appartengono al range dei valori accettati

	if (!in_array($align,array('none','left','right','center'))) $align = $DEFAULT_ALIGN; 
	if (!in_array($position,array('top','center','bottom','outside'))) $position = $DEFAULT_POSITION; 

	if (empty($sitename)) $sitename = get_bloginfo('name'); 
	if (empty($sitename)) $sitename = SZ_PLUGIN_GOOGLE_DRIVE_SITENAME; 
	if (empty($filename)) $filename = basename($url);

	// Calcolo il nome host attuale di wordpress in maniera da preparare
	// la stringa per la sostituzione sonlo se link è sullo stesso dominio

	$URLBlog = home_url('/');
	$URLBlog = parse_url($URLBlog);

	if(isset($URLBlog['host'])) {
		$url = preg_replace('#^https?://'.$URLBlog['host'].'#','', $url);
	}

	// Creazione codice HTML per embed code da inserire nella pagina wordpress

	$HTML  = '<div class="g-savetodrive"';
	$HTML .= ' data-src="'     .$url     .'"';
	$HTML .= ' data-filename="'.$filename.'"';
	$HTML .= ' data-sitename="'.$sitename.'"';
	$HTML .= '></div>';

	$HTML = SZGoogleCommon::getCodeButtonWrap(array(
		'html'         => $HTML,
		'text'         => $text,
		'image'        => $img,
		'content'      => $content,
		'align'        => $align,
		'position'     => $position,
		'margintop'    => $margintop,
		'marginright'  => $marginright,
		'marginbottom' => $marginbottom,
		'marginleft'   => $marginleft,
		'marginunit'   => $marginunit,
		'class'        => 'sz-google-savetodrive',
	));

	// Aggiunta del codice javascript per il rendering dei widget, questo codice		 
	// viene aggiungo anche dalla sidebar però viene inserito una sola volta

	add_action('SZGoogleFooter','sz_google_module_plus_add_script_footer');

	// Ritorno per la funzione con tutta la stringa contenente
	// il codice HTML per l'inserimento del codice nella pagina

	return $HTML;
}

/* ************************************************************************** */
/* DRIVE SAVE BUTTON funzione per elaborazione shortcode (sz-drive-save)      */
/* ************************************************************************** */

function sz_google_module_drive_shortcodes_savebutton($atts,$content=null) 
{
	// Preparazione codice HTML dello shortcode tramite la funzione
	// standard di preparazione codice sia per shortcode che widgets

	return sz_google_module_drive_get_code_savebutton(shortcode_atts(array(
		'url'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'filename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'sitename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'text'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'img'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'position'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'align'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'margintop'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginright'  => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginbottom' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginleft'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'marginunit'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'action'       => SZ_PLUGIN_GOOGLE_VALUE_TEXT_SHORTCODE,
	),$atts),$content);
}

/* ************************************************************************** */ 
/* DRIVE SAVE BUTTON definizione ed elaborazione del widget su sidebar        */ 
/* ************************************************************************** */ 

class sz_google_module_drive_widget_savebutton extends SZGoogleWidget
{
	// Costruttore principale della classe widget, definizione 
	// delle opzioni legate al widget e al controllo dello stesso

	function __construct() 
	{
		parent::__construct('SZ-Google-Drive-Save-Button',__('SZ-Google - Drive Save Button','szgoogleadmin'),array(
			'classname'   => 'sz-widget-google sz-widget-google-drive sz-widget-google-drive-save-button', 
			'description' => ucfirst(__('save file to google drive with button.','szgoogleadmin'))
		));
	}

	// Funzione per la visualizzazione del widget con lettura parametri
	// di configurazione e preparazione codice HTML da usare nella sidebar

	function widget($args,$instance) 
	{
		// Controllo se esistono le variabili che servono durante l'elaborazione
		// dello script e assegno dei valori di default nel caso non fossero specificati

		$options = $this->common_empty(array(
			'url'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'filename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'sitename'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'text'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'img'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'position'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'align'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'margintop'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'marginright'  => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'marginbottom' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'marginleft'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'marginunit'   => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'action'       => SZ_PLUGIN_GOOGLE_VALUE_TEXT_WIDGET,
		),$instance);

		// Definizione delle variabili di controllo del widget, questi valori non
		// interessano le opzioni della funzione base ma incidono su alcuni aspetti

		$controls = $this->common_empty(array(
			'badge'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		),$instance);

		// Se sul widget ho escluso il badeg dal pulsante azzero anche
		// le variabili del badge eventualmente impostate e memorizzate 

		if ($controls['badge'] != SZ_PLUGIN_GOOGLE_VALUE_YES) 
		{
			$options['img']      = SZ_PLUGIN_GOOGLE_VALUE_NULL;
			$options['text']     = SZ_PLUGIN_GOOGLE_VALUE_NULL;
			$options['position'] = SZ_PLUGIN_GOOGLE_VALUE_NULL;
		}

		// Creazione del codice HTML per il widget attuale richiamando la
		// funzione base che viene richiamata anche dallo shortcode corrispondente

		$HTML = sz_google_module_drive_get_code_savebutton($options);

		// Output del codice HTML legato al widget da visualizzare
		// chiamata alla funzione generale per wrap standard

		echo $this->common_widget($args,$instance,$HTML);
	}

	// Funzione per modifica parametri collegati al widget con 
	// memorizzazione dei valori direttamente nel database wordpress

	function update($new_instance,$old_instance) 
	{
		return $this->common_update(array(
			'title'    => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'badge'    => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'url'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'text'     => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'img'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'align'    => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'position' => SZ_PLUGIN_GOOGLE_VALUE_YES,
		),$new_instance,$old_instance);
	}

	// Funzione per la visualizzazione del form presente sulle 
	// sidebar nel pannello di amministrazione di wordpress
	
	function form($instance) 
	{
		$array = array(
			'title'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'badge'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'url'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'text'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'img'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'align'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'position' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		);

		// Creazione array per elenco campi da recuperare su FORM

		$instance = wp_parse_args((array) $instance,$array);

		$url      = trim($instance['url']);
		$text     = trim($instance['text']);
		$img      = trim($instance['img']);

		$badge    = trim(strip_tags($instance['badge']));
		$title    = trim(strip_tags($instance['title']));
		$align    = trim(strip_tags($instance['align']));
		$position = trim(strip_tags($instance['position']));

		// Richiamo il template per la visualizzazione della
		// parte che riguarda il pannello di amministrazione

		@require(SZ_PLUGIN_GOOGLE_BASENAME_ADMIN_WIDGETS.'sz-google-widget-drive-savebutton.php');
	}
}

