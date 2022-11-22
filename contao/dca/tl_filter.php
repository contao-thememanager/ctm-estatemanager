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

// Extend the regular palette
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$palette = PaletteManipulator::create()
    ->addLegend('style_manager_legend', 'expert_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField(['styleManager'], 'style_manager_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_filter');

// Extend fields
$GLOBALS['TL_DCA']['tl_filter']['fields']['styleManager'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_filter']['styleManager'],
    'exclude'   => true,
    'inputType' => 'stylemanager',
    'eval'      => ['tl_class'=>'clr stylemanager'],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_filter']['fields']['cssID']['sql'] = "text NULL";
$GLOBALS['TL_DCA']['tl_filter']['fields']['cssID']['eval']['alwaysSave'] = true;

$GLOBALS['TL_DCA']['tl_filter']['fields']['attributes']['load_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onLoad'];
$GLOBALS['TL_DCA']['tl_filter']['fields']['attributes']['save_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onSave'];
