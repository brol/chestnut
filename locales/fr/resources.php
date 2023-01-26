<?php
/**
 * @brief Chestnut, a theme for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Theme
 *
 * @author Azork (http://xtradotfreedotfr.free.fr/blog/), Pierre Van Glabeke
 *
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!isset(dcCore::app()->resources['help']['chestnut'])) {
	dcCore::app()->resources['help']['chestnut'] = dirname(__FILE__).'/help/chestnut.html';
}