<?php
# -- BEGIN LICENSE BLOCK ---------------------------------------
#
# This file is part of Chestnut, a Dotclear 2 theme.
#
# Copyright (c) 2011 Azork - http://xtradotfreedotfr.free.fr
# Contributor: Pierre Van Glabeke - https://github.com/brol/chestnut
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK -----------------------------------------

if (!defined('DC_CONTEXT_ADMIN')) { return; }

// Load contextual help
if (file_exists(dirname(__FILE__).'/locales/'.$_lang.'/resources.php')) {
	require dirname(__FILE__).'/locales/'.$_lang.'/resources.php';
}

global $core;

//PARAMS

# Translations
l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

# Default values
$default_menu = 'menucat';
$default_width = 'pixel';
$default_slidenav = 'yesslidenav';
$default_slide = 0;

# Settings
$my_menu = $core->blog->settings->themes->chestnut_menu;
$my_width = $core->blog->settings->themes->chestnut_width;
$my_slidenav = $core->blog->settings->themes->chestnut_slidenav;
$my_slide = $core->blog->settings->themes->chestnut_slide;

# Menu type
$chestnut_menu_combo = array(
	__('Menu categories') => 'menucat',
	__('simpleMenu') => 'simplemenu',
	__('Menu') => 'menu',
	__('none') => 'menuno'
);

# Width type
$chestnut_width_combo = array(
	__('Pixel') => 'pixel',
	__('Percentage') => 'percentage'
);

$html_fileslide = array(); $html_contentslide = array();

# Slide1
$html_fileslide[1] = path::real($core->blog->themes_path).'/'.$core->blog->settings->system->theme.'/tpl/featured-home.html';
if (!is_writable(dirname($html_fileslide[1]))) {
    throw new Exception(
        sprintf(__('File %s does not exist and directory %s is not writable.'),
                $html_fileslide[1],dirname($html_fileslide[1]))
    );
}
$html_contentslide[1] = file_get_contents($html_fileslide[1]);

# Slide on the following pages
$chestnut_slidenav_combo = array(
	__('Yes') => 'yesslidenav',
	__('No') => 'noslidenav'
);

// POST ACTIONS

if (!empty($_POST))
{
	try
	{
		$core->blog->settings->addNamespace('themes');

		# Menu type
		if (!empty($_POST['chestnut_menu']) && in_array($_POST['chestnut_menu'],$chestnut_menu_combo))
		{
			$my_menu = $_POST['chestnut_menu'];

		} elseif (empty($_POST['chestnut_menu']))
		{
			$my_menu = $default_menu;

		}
		$core->blog->settings->themes->put('chestnut_menu',$my_menu,'string','Menu to display',true);

		# Width type
		if (!empty($_POST['chestnut_width']) && in_array($_POST['chestnut_width'],$chestnut_width_combo))
		{
			$my_width = $_POST['chestnut_width'];

		} elseif (empty($_POST['chestnut_width']))
		{
			$my_width = $default_width;

		}
		$core->blog->settings->themes->put('chestnut_width',$my_width,'string','Width to display',true);

		# Slide scheme
		if (!empty($_POST['chestnut_slide']) && ($_POST['chestnut_slide']==1 || $_POST['chestnut_slide']==2))
		{
			$my_slide = $_POST['chestnut_slide'];

            if (isset($_POST['slide'.$_POST['chestnut_slide']]))
            {
                $html_contentslide[$_POST['chestnut_slide']] = $_POST['slide'.$_POST['chestnut_slide']];
                @$fp = fopen($html_fileslide[$_POST['chestnut_slide']],'wb');
                fwrite($fp,$html_contentslide[$_POST['chestnut_slide']]);
                fclose($fp);
            }
		} else
		{
			$my_slide = $default_slide;
		}
		$core->blog->settings->themes->put('chestnut_slide',$my_slide,'integer', 'Display slide',true);

		# Slide on the following pages scheme
		if (!empty($_POST['chestnut_slidenav']) && in_array($_POST['chestnut_slidenav'],$chestnut_slidenav_combo))
		{
			$my_slidenav = $_POST['chestnut_slidenav'];
		} elseif (empty($_POST['chestnut_slidenav']))
		{
			$my_slidenav = $default_slidenav;
		}
		$core->blog->settings->themes->put('chestnut_slidenav',$my_slidenav,'string','Slidenav display',true);

		// Blog refresh
		$core->blog->triggerBlog();

		// Template cache reset
		$core->emptyTemplatesCache();

		dcPage::success(__('Theme configuration has been successfully updated.'),true,true);
	}
	catch (Exception $e)
	{
		$core->error->add($e->getMessage());
	}
}

// DISPLAY

# Menu
echo
'<div class="fieldset"><h4>'.__('Menu').'</h4>'.
'<p class="field"><label>'.__('Menu to display:').'</label>'.
form::combo('chestnut_menu',$chestnut_menu_combo,$my_menu).
'</p>'.
'<p class="info">'.__('Plugins menu allowed: <a href="http://plugins.dotaddict.org/dc2/details/menu">Menu</a> plugin or simpleMenu.').'</p>'.
'</div>';

# Width
echo
'<div class="fieldset"><h4>'.__('Width').'</h4>'.
'<p class="field"><label>'.__('Width to display:').'</label>'.
form::combo('chestnut_width',$chestnut_width_combo,$my_width).
'</p>'.
'</div>';

# Slide
echo
'<div class="fieldset"><h4>'.__('Slide').'</h4>'.
'<p>'.
	form::radio(array('chestnut_slide','chestnut_slide0'),0,($my_slide==0)).
	'<label class="classic" for="chestnut_slide0">'.
		__('No slide').
	'</label>'.
'</p>'.
'<p>'.
	form::radio(array('chestnut_slide','chestnut_slide1'),1,($my_slide==1)).
	'<label class="classic" for="chestnut_slide1">'.
		__('Slide').
	'</label>'.
'</p>'.
'<p class="info">'.__('The title and the text (limited to the first 120 characters of the ticket) appear at the right of the image.').'</p>';

echo
'<p class="area"><label for="slide1">'.__('Code:').' '.
form::textarea('slide1',60,16,html::escapeHTML($html_contentslide[1])).'</label></p>';

# Slide on the following pages
echo
'<p class="field"><label>'.__('Display on the following pages:').'</label>'.
form::combo('chestnut_slidenav',$chestnut_slidenav_combo,$my_slidenav).
'</p>'.
'</div>';

dcPage::helpBlock('chestnut');