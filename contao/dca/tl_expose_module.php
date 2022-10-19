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

foreach ($GLOBALS['TL_DCA']['tl_expose_module']['palettes'] as $key => $value)
{

    if ($key === '__selector__' || $key === 'default' || $key === 'html')
    {
        continue;
    }

    $palette->applyToPalette($key, 'tl_expose_module');
}

// Adding more headline options
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline']['options'] = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div'];

// Extend fields
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['styleManager'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_form_field']['styleManager'],
    'exclude'   => true,
    'inputType' => 'stylemanager',
    'eval'      => ['tl_class'=>'clr stylemanager'],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headlineStyle'] = [
	'label'     => &$GLOBALS['TL_LANG']['tl_expose_module']['headlineStyle'],
	'exclude'   => true,
	'inputType' => 'select',
	'options'   => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
	'eval'      => ['includeBlankOption'=>true, 'tl_class'=>'w50'],
	'sql'       => "varchar(2) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline2'] = [
	'label'     => &$GLOBALS['TL_LANG']['tl_expose_module']['headline2'],
	'exclude'   => true,
	'search'    => true,
	'inputType' => 'inputUnit',
	'options'   => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div'],
	'eval'      => ['tl_class'=>'w50 clr'],
	'sql'       => "mediumtext NULL"
];

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline2Style'] = [
	'label'     => &$GLOBALS['TL_LANG']['tl_expose_module']['headline2Style'],
	'exclude'   => true,
	'inputType' => 'select',
	'options'   => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
	'eval'      => ['includeBlankOption'=>true, 'tl_class'=>'w50'],
	'sql'       => "varchar(2) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['sql'] = "text NULL";
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['eval']['alwaysSave'] = true;

$GLOBALS['TL_DCA']['tl_expose_module']['config']['onload_callback'][]        = ['ContaoThemeManager\Core\ThemeManager', 'extendHeadlineField'];

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['load_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onLoad'];
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['save_callback'][] = ['Oveleon\ContaoComponentStyleManager\StyleManager\StyleManager', 'onSave'];
