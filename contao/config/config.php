<?php

declare(strict_types=1);

/*
 * This file is part of Contao ThemeManager Contao EstateManager.
 *
 * @package     ctm-estatemanager
 * @license     MIT
 * @author      Daniele Sciannimanica <https://github.com/doishub>
 * @copyright   Oveleon               <https://www.oveleon.de/>
 */

// Add SCSS sources
$GLOBALS['TC_SOURCES']['configFiles'][]              = 'bundles/contaothememanagerestatemanager/framework/scss/_config.scss';
$GLOBALS['TC_SOURCES']['files'][]                    = 'bundles/contaothememanagerestatemanager/framework/scss/_realestate.scss';

// Add HOOK
$GLOBALS['TL_HOOKS']['styleManagerFindByTable'][]    = ['ContaoThemeManager\EstateManager\EstateManager', 'onFindByTable'];
$GLOBALS['TL_HOOKS']['styleManagerSkipField'][]      = ['ContaoThemeManager\EstateManager\EstateManager', 'onSkipField'];
$GLOBALS['TL_HOOKS']['styleManagerIsVisibleGroup'][] = ['ContaoThemeManager\EstateManager\EstateManager', 'isVisibleGroup'];