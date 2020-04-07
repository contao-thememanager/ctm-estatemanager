<?php
/*
 * This file is part of Contao ThemeManager RealEstate Plugin.
 *
 * (c) https://www.oveleon.de/
 */

// Add SCSS sources
$GLOBALS['TC_SOURCES']['configFiles'][] = 'bundles/contaothememanagerestatemanager/framework/scss/_config.scss';
$GLOBALS['TC_SOURCES']['files'][]       = 'bundles/contaothememanagerestatemanager/framework/scss/_realestate.scss';

// Add HOOK
$GLOBALS['TL_HOOKS']['styleManagerFindByTable'][] = array('\\ContaoThemeManager\\EstateManager\\EstateManager', 'onFindByTable');