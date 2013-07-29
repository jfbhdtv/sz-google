<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_GOOGLE_SHORTCODES') or !SZ_PLUGIN_GOOGLE_SHORTCODES) die();

/* ************************************************************************** */
/* Funzione shortcode per inserimento G+ BADGE su PROFILO                     */
/* ************************************************************************** */

function sz_google_shortcodes_plus_plusone($atts,$content=null) 
{
	$DEFAULT_URL        = '';
	$DEFAULT_SIZE       = 'standard';
	$DEFAULT_WIDTH      = '300'; 
	$DEFAULT_ANNOTATION = 'inline';

	/* Estrazione del valore URL dal codice shortcode */

	extract(shortcode_atts(array(
		'url'        => $DEFAULT_URL,
		'size'       => $DEFAULT_SIZE,
		'width'      => $DEFAULT_WIDTH,
		'annotation' => $DEFAULT_ANNOTATION,
	),$atts));

	// Esecuzione trim su valori specificati su shortcode

	$url        = trim($url);
	$width      = strtolower(trim($width));
	$size       = strtolower(trim($size));
	$annotation = strtolower(trim($annotation));

	// Imposto i valori di default nel caso siano specificati dei valori
	// che non appartengono al range dei valori accettati

	if ($width == '' or !is_numeric($width)) { 
		$width = $DEFAULT_WIDTH; 
	} 

	if (!in_array($size,array('small','medium','standard','tail'))) { 
		$size = $DEFAULT_SIZE; 
	} 

	if (!in_array($annotation,array('inline','bubble','none'))) { 
		$annotation = $DEFAULT_ANNOTATION; 
	} 

	// Se non specifico un URL fisso imposto il permalink attuale

	if ($url == '') $url = get_permalink();

	// Preparazione codice HTML per il badge di google plus

	$HTML  = '<div class="g-plusone"';
	$HTML .= ' data-href="'      .$url       .'"';
	$HTML .= ' data-size="'      .$size      .'"';
	$HTML .= ' data-width="'     .$width     .'"';
	$HTML .= ' data-annotation="'.$annotation.'"';
	$HTML .= '></div>';

	// Aggiunta del codice javascript per il rendering dei widget		 

	add_action('wp_footer','sz_google_modules_plus_add_script_footer');

	// Ritorno il codice HTML generato dalla funzione		 

	return $HTML;	
}

/* ************************************************************************** */
/* Aggiungo codice per esecuzione dello shortcode appena definito             */
/* ************************************************************************** */

add_shortcode('sz-gplus-one','sz_google_shortcodes_plus_plusone');
