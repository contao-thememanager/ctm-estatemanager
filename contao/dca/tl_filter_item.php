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
    ->addField(['styleManager'], 'style_manager_legend', PaletteManipulator::POSITION_APPEND);

foreach ($GLOBALS['TL_DCA']['tl_filter_item']['palettes'] as $key=>$value)
{
    if ($key === '__selector__')
    {
        continue;
    }

    $palette->applyToPalette($key, 'tl_filter_item');
}

// Extend fields
$GLOBALS['TL_DCA']['tl_filter_item']['fields']['styleManager'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_form_field']['styleManager'],
    'exclude'   => true,
    'inputType' => 'stylemanager',
    'eval'      => ['tl_class'=>'clr stylemanager'],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_filter_item']['fields']['cssID']['sql'] = "text NULL";
$GLOBALS['TL_DCA']['tl_filter_item']['fields']['cssID']['eval']['alwaysSave'] = true;

$GLOBALS['TL_DCA']['tl_filter_item']['fields']['class']['load_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onLoad'];
$GLOBALS['TL_DCA']['tl_filter_item']['fields']['class']['save_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onSave'];
