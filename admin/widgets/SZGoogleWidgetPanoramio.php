<?php
/**
 * Codice HTML per il form di impostazione collegato 
 * al widget presente nella parte di amministrazione, questo
 * codice è su file separato per escluderlo dal frontend
 *
 * @package SZGoogle
 */
if (!defined('SZ_PLUGIN_GOOGLE') or !SZ_PLUGIN_GOOGLE) die();

/**
 * Definizione variabili che sono legata alla istanza del 
 * widget richiamato com memorizzazione delle opzioni.
 */
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

/**
 * Creazione HTML CSS (id) per tutte le variabili 
 * elencate sopra e presenti nelle opzioni del widget.
 */
$ID_title          = $this->get_field_id('title');
$ID_template       = $this->get_field_id('template');
$ID_width          = $this->get_field_id('width');
$ID_width_auto     = $this->get_field_id('width_auto');
$ID_height         = $this->get_field_id('height');
$ID_user           = $this->get_field_id('user');
$ID_group          = $this->get_field_id('group');
$ID_tag            = $this->get_field_id('tag');
$ID_set            = $this->get_field_id('set');
$ID_columns        = $this->get_field_id('columns');
$ID_rows           = $this->get_field_id('rows');
$ID_orientation    = $this->get_field_id('orientation');
$ID_position       = $this->get_field_id('position');

/**
 * Creazione HTML CSS (name) per tutte le variabili 
 * elencate sopra e presenti nelle opzioni del widget.
 */
$NAME_title        = $this->get_field_name('title');
$NAME_template     = $this->get_field_name('template');
$NAME_width        = $this->get_field_name('width');
$NAME_width_auto   = $this->get_field_name('width_auto');
$NAME_height       = $this->get_field_name('height');
$NAME_user         = $this->get_field_name('user');
$NAME_group        = $this->get_field_name('group');
$NAME_tag          = $this->get_field_name('tag');
$NAME_set          = $this->get_field_name('set');
$NAME_columns      = $this->get_field_name('columns');
$NAME_rows         = $this->get_field_name('rows');
$NAME_orientation  = $this->get_field_name('orientation');
$NAME_position     = $this->get_field_name('position');

/**
 * Creazione HTML CSS (value) per tutte le variabili 
 * elencate sopra e presenti nelle opzioni del widget.
 */
$VALUE_title       = esc_attr($title);
$VALUE_template    = esc_attr($template);
$VALUE_width       = esc_attr($width);
$VALUE_width_auto  = esc_attr($width_auto);
$VALUE_height      = esc_attr($height);
$VALUE_user        = esc_attr($user);
$VALUE_group       = esc_attr($group);
$VALUE_tag         = esc_attr($tag);
$VALUE_set         = esc_attr($set);
$VALUE_columns     = esc_attr($columns);
$VALUE_rows        = esc_attr($rows);
$VALUE_orientation = esc_attr($orientation);
$VALUE_position    = esc_attr($position);

?>
<!-- WIDGETS (Tabella per contenere il FORM del widget) -->
<p><table id="SZGoogleWidgetPanoramio" class="sz-google-table-widget">

<!-- WIDGETS (Campo con inserimento del titolo widget) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_title ?>"><?php echo ucfirst(__('title','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_title ?>" name="<?php echo $NAME_title ?>" type="text" value="<?php echo $VALUE_title ?>" placeholder="<?php echo __('insert title for widget','szgoogleadmin') ?>"/></td>
</tr>

<!-- WIDGETS (Campo per selezione ID di configurazione o specifico) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_template ?>"><?php echo ucfirst(__('template','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="widefat" id="<?php echo $ID_template ?>" name="<?php echo $NAME_template ?>">
			<option value="photo" <?php selected("photo",$VALUE_template) ?>><?php echo ucfirst(__('template photo','szgoogleadmin')) ?></option>
			<option value="slideshow" <?php selected("slideshow",$VALUE_template) ?>><?php echo ucfirst(__('template slideshow','szgoogleadmin')) ?></option>
			<option value="list" <?php selected("list",$VALUE_template) ?>><?php echo ucfirst(__('template list','szgoogleadmin')) ?></option>
			<option value="photo_list" <?php selected("photo_list",$VALUE_template) ?>><?php echo ucfirst(__('template photo_list','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<tr><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per selezione campi di ricerca fotografie nel widget) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_user ?>"><?php echo ucfirst(__('user','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_user ?>" name="<?php echo $NAME_user ?>" type="text" value="<?php echo $VALUE_user ?>" placeholder="<?php echo __('specify search user','szgoogleadmin') ?>"/></td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_group ?>"><?php echo ucfirst(__('group','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_group ?>" name="<?php echo $NAME_group ?>" type="text" value="<?php echo $VALUE_group ?>" placeholder="<?php echo __('specify search group','szgoogleadmin') ?>"/></td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_tag ?>"><?php echo ucfirst(__('tag','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input class="widefat" id="<?php echo $ID_tag ?>" name="<?php echo $NAME_tag ?>" type="text" value="<?php echo $VALUE_tag ?>" placeholder="<?php echo __('specify search tag','szgoogleadmin') ?>"/></td>
</tr>

<!-- WIDGETS (Campo per selezione campo SET) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_set ?>"><?php echo ucfirst(__('set','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="widefat" id="<?php echo $ID_set ?>" name="<?php echo $NAME_set ?>">
			<option value="all" <?php selected("all",$VALUE_set) ?>><?php echo ucfirst(__('all','szgoogleadmin')) ?></option>
			<option value="public" <?php selected("public",$VALUE_set) ?>><?php echo ucfirst(__('public','szgoogleadmin')) ?></option>
			<option value="recent" <?php selected("recent",$VALUE_set) ?>><?php echo ucfirst(__('recent','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<tr><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per specificare la dimensione) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_width ?>"><?php echo ucfirst(__('width','szgoogleadmin')) ?>:</label></td>
	<td colspan="1" class="sz-cell-vals"><input id="<?php echo $ID_width ?>" class="sz-google-checks-width" name="<?php echo $NAME_width ?>" type="number" size="5" step="1" min="180" max="450" value="<?php echo $VALUE_width ?>"/></td>
	<td colspan="1" class="sz-cell-vals"><input id="<?php echo $ID_width_auto ?>" class="sz-google-checks-hidden checkbox" data-switch="sz-google-checks-width" onchange="szgoogle_checks_hidden_onchange(this);" name="<?php echo $NAME_width_auto ?>" type="checkbox" value="1" <?php echo checked($VALUE_width_auto) ?>>&nbsp;<?php echo ucfirst(__('auto','szgoogleadmin')) ?></td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_height ?>"><?php echo ucfirst(__('height','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input id="<?php echo $ID_height ?>" name="<?php echo $NAME_height ?>" type="number" size="5" step="1" min="180" max="450" value="<?php echo $VALUE_height ?>"/></td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_columns ?>"><?php echo ucfirst(__('columns','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input id="<?php echo $ID_columns ?>" name="<?php echo $NAME_columns ?>" type="number" size="5" step="1" min="1" max="100" value="<?php echo $VALUE_columns ?>"/></td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_rows ?>"><?php echo ucfirst(__('rows','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals"><input id="<?php echo $ID_rows ?>" name="<?php echo $NAME_rows ?>" type="number" size="5" step="1" min="1" max="100" value="<?php echo $VALUE_rows ?>"/></td>
</tr>

<tr><td colspan="3"><hr></td></tr>

<!-- WIDGETS (Campo per selezione campi orientation e position) -->
<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_orientation ?>"><?php echo ucfirst(__('orientation','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="widefat" id="<?php echo $ID_orientation ?>" name="<?php echo $NAME_orientation ?>">
			<option value="horizontal" <?php selected("horizontal",$VALUE_orientation) ?>><?php echo ucfirst(__('horizontal','szgoogleadmin')) ?></option>
			<option value="vertical" <?php selected("vertical",$VALUE_orientation) ?>><?php echo ucfirst(__('vertical','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<tr>
	<td colspan="1" class="sz-cell-keys"><label for="<?php echo $ID_position ?>"><?php echo ucfirst(__('position','szgoogleadmin')) ?>:</label></td>
	<td colspan="2" class="sz-cell-vals">
		<select class="widefat" id="<?php echo $ID_position ?>" name="<?php echo $NAME_position ?>">
			<option value="bottom" <?php selected("bottom",$VALUE_position) ?>><?php echo ucfirst(__('bottom','szgoogleadmin')) ?></option>
			<option value="top" <?php selected("top",$VALUE_position) ?>><?php echo ucfirst(__('top','szgoogleadmin')) ?></option>
			<option value="left" <?php selected("left",$VALUE_position) ?>><?php echo ucfirst(__('right','szgoogleadmin')) ?></option>
			<option value="right" <?php selected("right",$VALUE_position) ?>><?php echo ucfirst(__('right','szgoogleadmin')) ?></option>
		</select>
	</td>
</tr>

<!-- WIDGETS (Chiusura tabella principale widget form) -->
</table></p>

<!-- WIDGETS (Codice javascript per funzioni UI) -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		szgoogle_switch_hidden_onload('SZGoogleWidgetPanoramio');
		szgoogle_checks_hidden_onload('SZGoogleWidgetPanoramio');
	});
</script>