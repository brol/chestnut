<?php
/* BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Chestnut, a Dotclear 2 theme.
#
# Copyright (c) 2011 Azork - http://xtradotfreedotfr.free.fr
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK --------------------------------- */

if (!defined('DC_CONTEXT_ADMIN')) { return; }

global $core;

//PARAMS

# Translations
l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

# Default values
$default_menu = 'menucat';

# Settings
$my_menu = $core->blog->settings->themes->chestnut_menu;

# Menu type
$chestnut_menu_combo = array(
	__('Menu categories') => 'menucat',
	__('simpleMenu') => 'simplemenu',
	__('Menu') => 'menu',
	__('none') => 'menuno'
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
'<div class="fieldset"><h4>'.__('Customizations').'</h4>'.
'<p class="field"><label>'.__('Menu to display:').'</label>'.
form::combo('chestnut_menu',$chestnut_menu_combo,$my_menu).
'</p>'.
'<p class="info">'.__('Plugins menu allowed: <a href="http://plugins.dotaddict.org/dc2/details/menu">Menu</a> plugin or simpleMenu.').'</p>'.
'</div>';