<?php
/**
 * Codice HTML per il form di impostazione collegato 
 * al widget presente nella parte di amministrazione, questo
 * codice è su file separato per escluderlo dal frontend
 *
 * @package SZGoogle
 * @subpackage SZGoogleWidgets 
 */
if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();
?>
<!-- WIDGETS (Tabella per contenere il FORM del widget) -->
<table id="SZGoogleWidgetPlusPage" class="sz-google-table-widget">

<!-- WIDGETS (Campo con inserimento del titolo widget) -->
<tr class="only-widgets">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_title ?>"><?php echo ucfirst(__('title','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_title ?>" name="<?php echo $NAME_title ?>" type="text" value="<?php echo $VALUE_title ?>" placeholder="<?php echo __('insert title for widget','szgoogleadmin') ?>"/></td>
</td></tr>

<!-- WIDGETS (Campo per selezione ID di configurazione o specifico) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_method ?>"><?php echo ucfirst(__('page','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="sz-google-switch-hidden widefat" data-switch="sz-google-switch-specific" data-close="1" onchange="szgoogle_switch_hidden_onchange(this);" id="<?php echo $ID_method ?>" name="<?php echo $NAME_method ?>">
			<option value="1" <?php selected("1",$VALUE_method) ?>><?php echo ucfirst(__('configuration ID','szgoogleadmin')) ?></option>
			<option value="2" <?php selected("2",$VALUE_method) ?>><?php echo ucfirst(__('specific ID','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<!-- WIDGETS (Campo per inserimento di uno specifico ID) -->
<tr class="sz-google-switch-specific sz-google-hidden">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_specific ?>"><?php echo ucfirst(__('page ID','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_specific ?>" name="<?php echo $NAME_specific ?>" type="text" value="<?php echo $VALUE_specific ?>" placeholder="<?php echo __('insert specific ID','szgoogleadmin') ?>"/></td>
</tr>

<tr><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per inserimento tipologia badge) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_type ?>"><?php echo ucfirst(__('type','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select onchange="szgoogle_switch_select_onchange(this);" class="sz-google-row-select widefat" id="<?php echo $ID_type ?>" name="<?php echo $NAME_type ?>">
			<option data-open="1" value="standard" <?php selected("standard",$VALUE_type) ?>><?php echo ucfirst(__('standard','szgoogleadmin')) ?></option>
			<option data-open="2" value="popup" <?php selected("popup",$VALUE_type) ?>><?php echo ucfirst(__('popup','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<tr><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per specificare la dimensione) -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_width ?>"><?php echo ucfirst(__('width','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input id="<?php echo $ID_width ?>" class="sz-google-checks-width widefat" name="<?php echo $NAME_width ?>" type="text" size="5" placeholder="auto" value="<?php echo $VALUE_width ?>"/></td>
	<td colspan="1" class="sz-cell-vals"><input id="<?php echo $ID_width_auto ?>" class="sz-google-checks-hidden checkbox" data-switch="sz-google-checks-width" onchange="szgoogle_checks_hidden_onchange(this);" name="<?php echo $NAME_width_auto ?>" type="checkbox" value="1" <?php echo checked($VALUE_width_auto,true,false) ?>>&nbsp;<?php echo ucfirst(__('auto','szgoogleadmin')) ?></td>
</tr>

<tr class="sz-google-row-tab sz-google-row-tab-1"><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per specificare il parametro layout -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label><?php echo ucfirst(__('layout','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_layout ?>" value="portrait"  <?php if ($VALUE_layout == 'portrait') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('V','szgoogleadmin')) ?></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_layout ?>" value="landscape" <?php if ($VALUE_layout != 'portrait') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('H','szgoogleadmin')) ?></td>
</tr>

<!-- WIDGETS (Campo per specificare il parametro theme -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label><?php echo ucfirst(__('theme','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_theme ?>" value="light" <?php if ($VALUE_theme == 'light') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('light','szgoogleadmin')) ?></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_theme ?>" value="dark"  <?php if ($VALUE_theme != 'light') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('dark','szgoogleadmin')) ?></td>
</tr>

<!-- WIDGETS (Campo per specificare il parametro cover -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label><?php echo ucfirst(__('cover','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_cover ?>" value="true"  <?php if ($VALUE_cover == 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('yes','szgoogleadmin')) ?></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_cover ?>" value="false" <?php if ($VALUE_cover != 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('no','szgoogleadmin')) ?></td>
</tr>

<!-- WIDGETS (Campo per specificare il parametro tagline -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label><?php echo ucfirst(__('tagline','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_tagline ?>" value="true"  <?php if ($VALUE_tagline == 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('yes','szgoogleadmin')) ?></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_tagline ?>" value="false" <?php if ($VALUE_tagline != 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('no','szgoogleadmin')) ?></td>
</tr>

<!-- WIDGETS (Campo per specificare il parametro publisher -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label><?php echo ucfirst(__('publisher','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_publisher ?>" value="true"  <?php if ($VALUE_publisher == 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('yes','szgoogleadmin')) ?></td>
	<td colspan="1" class="sz-cell-vals"><input type="radio" name="<?php echo $NAME_publisher ?>" value="false" <?php if ($VALUE_publisher != 'true') echo ' checked'?>>&nbsp;<?php echo ucfirst(__('no','szgoogleadmin')) ?></td>
</tr>

<tr class="sz-google-row-tab sz-google-row-tab-1"><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per specificare il parametro align -->
<tr class="sz-google-row-tab sz-google-row-tab-1">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_align ?>"><?php echo ucfirst(__('align','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="widefat" id="<?php echo $ID_align ?>" name="<?php echo $NAME_align ?>">
			<option value="none"   <?php echo selected("none"  ,$VALUE_align) ?>><?php echo __('none'  ,'szgoogleadmin') ?></option>
			<option value="left"   <?php echo selected("left"  ,$VALUE_align) ?>><?php echo __('left'  ,'szgoogleadmin') ?></option>
			<option value="center" <?php echo selected("center",$VALUE_align) ?>><?php echo __('center','szgoogleadmin') ?></option>
			<option value="right"  <?php echo selected("right" ,$VALUE_align) ?>><?php echo __('right' ,'szgoogleadmin') ?></option>
		</select>
	</td>
</tr>

<!-- WIDGETS (Campo per inserimento testo) -->
<tr class="sz-google-row-tab sz-google-row-tab-2">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_text ?>"><?php echo ucfirst(__('text','szgoogleadmin')) ?>:</label></td>
	<td colspan="2"><textarea class="widefat" rows="3" cols="20" id="<?php echo $ID_text ?>" name="<?php echo $NAME_text ?>" placeholder="<?php echo __('insert text for badge','szgoogleadmin') ?>"><?php echo $VALUE_text ?></textarea></td>
</tr>

<!-- WIDGETS (Campo per inserimento immagine da usare come badge) -->
<tr class="sz-google-row-tab sz-google-row-tab-2">
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_image ?>"><?php echo ucfirst(__('image','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input class="sz-upload-image-url-2 widefat" id="<?php echo $ID_image ?>" name="<?php echo $NAME_image ?>" type="text" value="<?php echo $VALUE_image ?>" placeholder="<?php echo __('choose image for badge','szgoogleadmin') ?>"/></td>
	<td colspan="1" class="sz-cell-vals"><input class="sz-upload-image-button button" type="button" value="<?php echo ucfirst(__('file','szgoogleadmin')) ?>" data-field-url="sz-upload-image-url-2" data-title="<?php echo ucfirst(__('select or upload a file','szgoogleadmin')) ?>" data-button-text="<?php echo ucfirst(__('confirm selection','szgoogleadmin')) ?>"/></td>
</tr>

<tr class="sz-google-row-tab sz-google-row-tab-2"><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Chiusura tabella principale widget form) -->
</table>

<!-- WIDGETS (Codice javascript per funzioni UI) -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		if (typeof(szgoogle_checks_hidden_onload) == 'function') { szgoogle_checks_hidden_onload('SZGoogleWidgetPlusPage'); }
		if (typeof(szgoogle_switch_hidden_onload) == 'function') { szgoogle_switch_hidden_onload('SZGoogleWidgetPlusPage'); }
		if (typeof(szgoogle_switch_select_onload) == 'function') { szgoogle_switch_select_onload('SZGoogleWidgetPlusPage'); }
		if (typeof(szgoogle_upload_select_media)  == 'function') { szgoogle_upload_select_media(); }
	});
</script>