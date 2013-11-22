<?php
/**
 * Modulo GOOGLE PANORAMIO per la definizione delle funzioni che riguardano
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
class SZGoogleModulePanoramio extends SZGoogleModule
{
	function __construct()
	{
		parent::__construct();

		$this->moduleShortcodes = array(
			'panoramio_shortcode' => array('sz-panoramio','sz_google_module_panoramio_shortcode'),
		);

		$this->moduleWidgets = array(
			'panoramio_widget'    => 'sz_google_module_panoramio_widget',
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
		$options = get_option('sz_google_options_panoramio');

		// Controllo delle opzioni in caso di valori non esistenti
		// richiamo della funzione per il controllo isset()

		$options = $this->checkOptionIsSet($options,array(
			'panoramio_widget'        => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_shortcode'     => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_s_template'    => SZ_PLUGIN_GOOGLE_PANORAMIO_S_TEMPLATE,
			'panoramio_s_width'       => SZ_PLUGIN_GOOGLE_PANORAMIO_S_WIDTH,
			'panoramio_s_height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_S_HEIGHT,
			'panoramio_s_orientation' => SZ_PLUGIN_GOOGLE_PANORAMIO_S_ORIENTATION,
			'panoramio_s_list_size'   => SZ_PLUGIN_GOOGLE_PANORAMIO_S_LIST_SIZE,
			'panoramio_s_position'    => SZ_PLUGIN_GOOGLE_PANORAMIO_S_POSITION,
			'panoramio_s_paragraph'   => SZ_PLUGIN_GOOGLE_PANORAMIO_S_PARAGRAPH,
			'panoramio_s_delay'       => SZ_PLUGIN_GOOGLE_PANORAMIO_S_DELAY,
			'panoramio_s_set'         => SZ_PLUGIN_GOOGLE_PANORAMIO_S_SET,
			'panoramio_s_columns'     => SZ_PLUGIN_GOOGLE_PANORAMIO_S_COLUMNS,
			'panoramio_s_rows'        => SZ_PLUGIN_GOOGLE_PANORAMIO_S_ROWS,
			'panoramio_w_template'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_TEMPLATE,
			'panoramio_w_width'       => SZ_PLUGIN_GOOGLE_PANORAMIO_W_WIDTH,
			'panoramio_w_height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT,
			'panoramio_w_orientation' => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ORIENTATION,
			'panoramio_w_list_size'   => SZ_PLUGIN_GOOGLE_PANORAMIO_W_LIST_SIZE,
			'panoramio_w_position'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_POSITION,
			'panoramio_w_paragraph'   => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_w_delay'       => SZ_PLUGIN_GOOGLE_PANORAMIO_W_DELAY,
			'panoramio_w_set'         => SZ_PLUGIN_GOOGLE_PANORAMIO_W_SET,
			'panoramio_w_columns'     => SZ_PLUGIN_GOOGLE_PANORAMIO_W_COLUMNS,
			'panoramio_w_rows'        => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ROWS,
		));

		// Controllo delle opzioni in caso di valori non conformi
		// richiamo della funzione per il controllo isnull()

		$options = $this->checkOptionIsNull($options,array(
			'panoramio_s_template'    => SZ_PLUGIN_GOOGLE_PANORAMIO_S_TEMPLATE,
			'panoramio_s_width'       => SZ_PLUGIN_GOOGLE_PANORAMIO_S_WIDTH,
			'panoramio_s_height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_S_HEIGHT,
			'panoramio_s_orientation' => SZ_PLUGIN_GOOGLE_PANORAMIO_S_ORIENTATION,
			'panoramio_s_list_size'   => SZ_PLUGIN_GOOGLE_PANORAMIO_S_LIST_SIZE,
			'panoramio_s_position'    => SZ_PLUGIN_GOOGLE_PANORAMIO_S_POSITION,
			'panoramio_s_paragraph'   => SZ_PLUGIN_GOOGLE_PANORAMIO_S_PARAGRAPH,
			'panoramio_s_delay'       => SZ_PLUGIN_GOOGLE_PANORAMIO_S_DELAY,
			'panoramio_s_set'         => SZ_PLUGIN_GOOGLE_PANORAMIO_S_SET,
			'panoramio_s_columns'     => SZ_PLUGIN_GOOGLE_PANORAMIO_S_COLUMNS,
			'panoramio_s_rows'        => SZ_PLUGIN_GOOGLE_PANORAMIO_S_ROWS,
			'panoramio_w_template'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_TEMPLATE,
			'panoramio_w_width'       => SZ_PLUGIN_GOOGLE_PANORAMIO_W_WIDTH,
			'panoramio_w_height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT,
			'panoramio_w_orientation' => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ORIENTATION,
			'panoramio_w_list_size'   => SZ_PLUGIN_GOOGLE_PANORAMIO_W_LIST_SIZE,
			'panoramio_w_position'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_POSITION,
			'panoramio_w_paragraph'   => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_w_delay'       => SZ_PLUGIN_GOOGLE_PANORAMIO_W_DELAY,
			'panoramio_w_set'         => SZ_PLUGIN_GOOGLE_PANORAMIO_W_SET,
			'panoramio_w_columns'     => SZ_PLUGIN_GOOGLE_PANORAMIO_W_COLUMNS,
			'panoramio_w_rows'        => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ROWS,
		));

		// Controllo delle opzioni in caso di valori non conformi
		// richiamo della funzione per il controllo Yes o No

		$options = $this->checkOptionIsYesNo($options,array(
			'panoramio_widget'      => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_shortcode'   => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_s_paragraph' => SZ_PLUGIN_GOOGLE_VALUE_NO,
			'panoramio_w_paragraph' => SZ_PLUGIN_GOOGLE_VALUE_NO,
		));

		// Ritorno indietro il gruppo di opzioni corretto dai
		// controlli formali della funzione di reperimento opzioni

		return $options;
	}
}


global $SZ_PANORAMIO_OBJECT;

$SZ_PANORAMIO_OBJECT = new SZGoogleModulePanoramio();
$SZ_PANORAMIO_OBJECT->moduleAddWidgets();
$SZ_PANORAMIO_OBJECT->moduleAddShortcodes();

/* ************************************************************************** */ 
/* Funzione per la generazione di codice legato a google panoramio            */
/* ************************************************************************** */ 

function sz_google_module_panoramio_get_code($atts=array())
{
	// Estrazione dei valori specificati nello shortcode, i valori ritornati
	// sono contenuti nei nomi di variabili corrispondenti alla chiave

	if (!is_array($atts)) $atts = array();

	extract(shortcode_atts(array(
		'template'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'user'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'group'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'tag'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'set'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'width'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'height'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'bgcolor'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'delay'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'columns'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'rows'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'orientation'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'listsize'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'position'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'paragraph'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'default'        => SZ_PLUGIN_GOOGLE_VALUE_TEXT_SHORTCODE,
	),$atts));

	// Controllo le variabili che devono avere obbligatorio il valore 
	// di true o false, in caso diverso prendo il valore di default specificato 

	$user      = trim($user);
	$group     = trim($group);
	$tag       = trim($tag);
	$set       = strtolower(trim($set));
	$template  = strtolower(trim($template));
	$width     = strtolower(trim($width));
	$height    = strtolower(trim($height));
	$bgcolor   = strtolower(trim($bgcolor));
	$delay     = strtolower(trim($delay));
	$columns   = strtolower(trim($columns));
	$rows      = strtolower(trim($rows));
	$listsize  = strtolower(trim($listsize));
	$position  = strtolower(trim($position));
	$paragraph = strtolower(trim($paragraph));
	$default   = strtolower(trim($default));

	// Lettura delle opzioni per la definzione di parametri che non hanno
	// specificato nessun valore e che saranno sostituiti con quelli di default

	global $SZ_PANORAMIO_OBJECT;
	$options = $SZ_PANORAMIO_OBJECT->getOptions();

	if ($default == SZ_PLUGIN_GOOGLE_VALUE_TEXT_WIDGET) 
	{
		$DEFAULT_TEMPLATE    = $options['panoramio_w_template'];
		$DEFAULT_WIDTH       = $options['panoramio_w_width'];
		$DEFAULT_HEIGHT      = $options['panoramio_w_height'];
		$DEFAULT_LIST_SIZE   = $options['panoramio_w_list_size'];
		$DEFAULT_POSITION    = $options['panoramio_w_position'];
		$DEFAULT_ORIENTATION = $options['panoramio_w_orientation'];
		$DEFAULT_PARAGRAPH   = $options['panoramio_w_paragraph'];
		$DEFAULT_DELAY       = $options['panoramio_w_delay'];
		$DEFAULT_SET         = $options['panoramio_w_set'];
		$DEFAULT_COLUMNS     = $options['panoramio_w_columns'];
		$DEFAULT_ROWS        = $options['panoramio_w_rows'];

	} else {

		$DEFAULT_TEMPLATE    = $options['panoramio_s_template'];
		$DEFAULT_WIDTH       = $options['panoramio_s_width'];
		$DEFAULT_HEIGHT      = $options['panoramio_s_height'];
		$DEFAULT_LIST_SIZE   = $options['panoramio_s_list_size'];
		$DEFAULT_POSITION    = $options['panoramio_s_position'];
		$DEFAULT_ORIENTATION = $options['panoramio_s_orientation'];
		$DEFAULT_PARAGRAPH   = $options['panoramio_s_paragraph'];
		$DEFAULT_DELAY       = $options['panoramio_s_delay'];
		$DEFAULT_SET         = $options['panoramio_s_set'];
		$DEFAULT_COLUMNS     = $options['panoramio_s_columns'];
		$DEFAULT_ROWS        = $options['panoramio_s_rows'];
	}

	// Controllo la variabile che controlla il paragrafo vuoto da aggiungere
	// dopo il blocco di codice (shortocde) per compatibilità al post di wordpress

	if ($paragraph == 'true')  $paragraph = SZ_PLUGIN_GOOGLE_VALUE_YES;
	if ($paragraph == 'false') $paragraph = SZ_PLUGIN_GOOGLE_VALUE_NO;

	if (!in_array($paragraph,array(SZ_PLUGIN_GOOGLE_VALUE_YES,SZ_PLUGIN_GOOGLE_VALUE_NO))) $paragraph = $DEFAULT_PARAGRAPH;

	// Controllo la coerenza delle opzioni di elaborazione modulo e 
	// sostituzione con valori di default quando presentano dei problemi

	if (!in_array($template   ,array('photo','slideshow','list','photo_list'))) $template    = $DEFAULT_TEMPLATE;
	if (!in_array($set        ,array('all','public','recent')))                 $set         = $DEFAULT_SET;
	if (!in_array($orientation,array('horizontal','vertical')))                 $orientation = $DEFAULT_ORIENTATION;
	if (!in_array($position   ,array('left','top','right','bottom')))           $position    = $DEFAULT_POSITION;

 	if (!ctype_xdigit(str_replace("#","",$bgcolor))) $bgcolor = SZ_PLUGIN_GOOGLE_VALUE_NULL;
	if (!is_numeric($delay) or $delay < 0) $delay = $DEFAULT_DELAY; 

	if (!ctype_digit($columns))  $columns  = $DEFAULT_COLUMNS; 
	if (!ctype_digit($rows))     $rows     = $DEFAULT_ROWS;
	if (!ctype_digit($listsize)) $listsize = $DEFAULT_LIST_SIZE; 

	// Controllo i valori passati in array che specificano la dimensione del widget
	// in caso contrario imposto il valore su quello specificato nelle opzioni

	if (!is_numeric($width)  and $width  != SZ_PLUGIN_GOOGLE_VALUE_AUTO) $width  = $DEFAULT_WIDTH;
	if (!is_numeric($height) and $height != SZ_PLUGIN_GOOGLE_VALUE_AUTO) $height = $DEFAULT_HEIGHT;

	// Controllo la dimensione del widget e controllo formale dei valori numerici
	// se trovo qualche incongruenza applico i valori di default prestabiliti

	if ($width  == SZ_PLUGIN_GOOGLE_VALUE_AUTO) $width  = "'+w+'";
	if ($width  == SZ_PLUGIN_GOOGLE_VALUE_NULL) $width  = "'+w+'";

	if ($height == SZ_PLUGIN_GOOGLE_VALUE_AUTO) $height = $DEFAULT_HEIGHT;
	if ($height == SZ_PLUGIN_GOOGLE_VALUE_NULL) $height = $DEFAULT_HEIGHT;

	// Creazione identificativo univoco per riconoscere il codice embed 
	// nel caso la funzioine venga richiamata più volte nella stessa pagina

	$unique = md5(uniqid(),false);
	$keyIDs = 'sz-google-panoramio-'.$unique;

	// Creazione codice HTML per inserimento javascript di google 

	$HTML  = '<div class="sz-google-panoramio">';
	$HTML .= '<div class="sz-google-panoramio-wrap">';
	$HTML .= '<div class="sz-google-panoramio-iframe" id="'.$keyIDs.'"></div>';

	$HTML .= '<script type="text/javascript">';
	$HTML .= "var w=document.getElementById('".$keyIDs."').offsetWidth;";
	$HTML .= "document.write('";

	$HTML .= '<iframe src="https://ssl.panoramio.com/wapi/template/'.$template.'.html?';
	$HTML .= 'width='       .$width;
	$HTML .= '&height='     .$height;
	$HTML .= '&bgcolor='    .rawurlencode($bgcolor);
	$HTML .= '&delay='      .rawurlencode($delay);
	$HTML .= '&columns='    .rawurlencode($columns);
	$HTML .= '&rows='       .rawurlencode($rows);
	$HTML .= '&orientation='.rawurlencode($orientation);
	$HTML .= '&list_size='  .rawurlencode($listsize);
	$HTML .= '&position='   .rawurlencode($position);

	if ($user  != SZ_PLUGIN_GOOGLE_VALUE_NULL) $HTML .= '&user=' .rawurlencode($user);
	if ($group != SZ_PLUGIN_GOOGLE_VALUE_NULL) $HTML .= '&group='.rawurlencode($group);
	if ($tag   != SZ_PLUGIN_GOOGLE_VALUE_NULL) $HTML .= '&tag='  .rawurlencode($tag);


	if ($user  == SZ_PLUGIN_GOOGLE_VALUE_NULL and $group == SZ_PLUGIN_GOOGLE_VALUE_NULL and $tag == SZ_PLUGIN_GOOGLE_VALUE_NULL) {
		if ($set != SZ_PLUGIN_GOOGLE_VALUE_NULL) $HTML .= '&set='.rawurlencode($set);
	}

	$HTML .= '" ';
	$HTML .= 'scrolling="no" frameborder="0" marginwidth="0" marginheight="0" ';
 	$HTML .= 'width="'.$width.'" ';
	$HTML .= 'height="'.$height.'"';
	$HTML .= '></iframe>'."');";
	$HTML .= '</script>';

	$HTML .= '</div>';
	$HTML .= '</div>';

	if ($default != SZ_PLUGIN_GOOGLE_VALUE_TEXT_WIDGET and $paragraph == SZ_PLUGIN_GOOGLE_VALUE_YES) {
		$HTML .= '<p></p>';
	}

	// Ritorno per la funzione con tutta la stringa contenente
	// il codice HTML per l'inserimento del codice nella pagina

	return $HTML;
}

/* ************************************************************************** */
/* GOOGLE PANORAMIO definizione ed elaborazione dello shortcode               */ 
/* ************************************************************************** */

function sz_google_module_panoramio_shortcode($atts,$content=null) 
{
	// Preparazione codice HTML dello shortcode tramite la funzione
	// standard di preparazione codice sia per shortcode che widgets

	return sz_google_module_panoramio_get_code(shortcode_atts(array(
		'template'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'user'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'group'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'tag'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'set'            => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'width'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'height'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'bgcolor'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'delay'          => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'columns'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'rows'           => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'orientation'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'listsize'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'position'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'paragraph'      => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		'default'        => SZ_PLUGIN_GOOGLE_VALUE_TEXT_SHORTCODE,
	),$atts),$content);
}

/* ************************************************************************** */ 
/* GOOGLE PANORAMIO definizione ed elaborazione del widget su sidebar         */ 
/* ************************************************************************** */ 

class sz_google_module_panoramio_widget extends SZGoogleWidget
{
	// Costruttore principale della classe widget, definizione 
	// delle opzioni legate al widget e al controllo dello stesso

	function __construct() 
	{
		parent::__construct('sz-google-panoramio',__('SZ-Google - Panoramio','szgoogleadmin'),array(
			'classname'   => 'sz-widget-google sz-widget-google-panoramio sz-widget-google-panoramio-iframe', 
			'description' => ucfirst(__('widget for photos in panoramio','szgoogleadmin'))
		));
	}

	// Funzione per la visualizzazione del widget con lettura parametri
	// di configurazione e preparazione codice HTML da usare nella sidebar

	function widget($args,$instance) 
	{
		// Controllo se esistono le variabili che servono durante l'elaborazione
		// dello script e assegno dei valori di default nel caso non fossero specificati

		$options = $this->common_empty(array(
			'template'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'default'     => SZ_PLUGIN_GOOGLE_VALUE_TEXT_WIDGET,
			'width'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT,
			'user'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'group'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'tag'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'set'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'columns'     => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'rows'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'orientation' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'position'    => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		),$instance);

		// Definizione delle variabili di controllo del widget, questi valori non
		// interessano le opzioni della funzione base ma incidono su alcuni aspetti

		$controls = $this->common_empty(array(
			'width_auto' => SZ_PLUGIN_GOOGLE_VALUE_NULL,
		),$instance);

		// Correzione del valore di dimensione nel caso venga
		// specificata la maniera automatica e quindi usare javascript

		if ($controls['width_auto'] == SZ_PLUGIN_GOOGLE_VALUE_YES) $options['width'] = SZ_PLUGIN_GOOGLE_VALUE_AUTO;

		// Creazione del codice HTML per il widget attuale richiamando la
		// funzione base che viene richiamata anche dallo shortcode corrispondente

		$HTML = sz_google_module_panoramio_get_code($options);

		// Output del codice HTML legato al widget da visualizzare
		// chiamata alla funzione generale per wrap standard

		echo $this->common_widget($args,$instance,$HTML);
	}

	// Funzione per modifica parametri collegati al widget con 
	// memorizzazione dei valori direttamente nel database wordpress

	function update($new_instance,$old_instance) 
	{
		return $this->common_update(array(
			'title'       => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'template'    => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'width'       => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'width_auto'  => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'height'      => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'user'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'group'       => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'tag'         => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'set'         => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'columns'     => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'rows'        => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'orientation' => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'position'    => SZ_PLUGIN_GOOGLE_VALUE_YES,
		),$new_instance,$old_instance);
	}

	// Funzione per la visualizzazione del form presente sulle 
	// sidebar nel pannello di amministrazione di wordpress
	
	function form($instance) 
	{
		$array = array(
			'title'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'template'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_TEMPLATE,
			'width'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'width_auto'  => SZ_PLUGIN_GOOGLE_VALUE_YES,
			'height'      => SZ_PLUGIN_GOOGLE_PANORAMIO_W_HEIGHT,
			'user'        => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'group'       => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'tag'         => SZ_PLUGIN_GOOGLE_VALUE_NULL,
			'set'         => SZ_PLUGIN_GOOGLE_PANORAMIO_W_SET,
			'columns'     => SZ_PLUGIN_GOOGLE_PANORAMIO_W_COLUMNS,
			'rows'        => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ROWS,
			'orientation' => SZ_PLUGIN_GOOGLE_PANORAMIO_W_ORIENTATION,
			'position'    => SZ_PLUGIN_GOOGLE_PANORAMIO_W_POSITION,
		);

		// Creazione array per elenco campi da recuperare su FORM

		$instance = wp_parse_args((array) $instance,$array);

		$title       = trim(strip_tags($instance['title']));
		$template    = trim(strip_tags($instance['template']));
		$width       = trim(strip_tags($instance['width']));
		$width_auto  = trim(strip_tags($instance['width_auto']));
		$height      = trim(strip_tags($instance['height']));
		$user        = trim(strip_tags($instance['user']));
		$group       = trim(strip_tags($instance['group']));
		$tag         = trim(strip_tags($instance['tag']));
		$set         = trim(strip_tags($instance['set']));
		$columns     = trim(strip_tags($instance['columns']));
		$rows        = trim(strip_tags($instance['rows']));
		$orientation = trim(strip_tags($instance['orientation']));
		$position    = trim(strip_tags($instance['position']));

		// Richiamo il template per la visualizzazione della
		// parte che riguarda il pannello di amministrazione

		@require(SZ_PLUGIN_GOOGLE_BASENAME_ADMIN_WIDGETS.'sz-google-widget-panoramio.php');
	}
}
