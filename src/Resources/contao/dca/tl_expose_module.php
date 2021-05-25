<?php
/*
 * This file is part of ContaoComponentStyleManager.
 *
 * (c) https://www.oveleon.de/
 */

// Extend the regular palette
$palette = Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('style_manager_legend', 'expert_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField(array('styleManager'), 'style_manager_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND);

foreach ($GLOBALS['TL_DCA']['tl_expose_module']['palettes'] as $key=>$value){
    if($key === '__selector__' || $key === 'default' || $key === 'html')
    {
        continue;
    }

    $palette->applyToPalette($key, 'tl_expose_module');
}

// Adding more headline options
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline']['options'] = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div');

// Extend fields
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['styleManager'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['styleManager'],
    'exclude'                 => true,
    'inputType'               => 'stylemanager',
    'eval'                    => array('tl_class'=>'clr stylemanager'),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headlineStyle'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['headlineStyle'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(2) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline2'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['headline2'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'inputUnit',
	'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div'),
	'eval'                    => array('tl_class'=>'w50 clr'),
	'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['headline2Style'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_expose_module']['headline2Style'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(2) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['load_callback'][] = array('\\Oveleon\\ContaoComponentStyleManager\\StyleManager', 'onLoad');
$GLOBALS['TL_DCA']['tl_expose_module']['fields']['cssID']['save_callback'][] = array('\\Oveleon\\ContaoComponentStyleManager\\StyleManager', 'onSave');
$GLOBALS['TL_DCA']['tl_expose_module']['config']['onload_callback'][] = array('ContaoThemeManager\Core\ThemeManager', 'extendHeadlineField');
