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
if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
    /* Name */          "Chestnut",
    /* Description*/    "Dotclear Theme",
    /* Author */        "Azork, Pierre Van Glabeke",
    /* Version */       '1.3.2',
	array(
		'type'	 =>	'theme',
		'tplset' => 'mustek',
		'dc_min' => '2.9'
	)
);