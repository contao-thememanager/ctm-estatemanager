<?php

/*
 * This file is part of Contao ThemeManager Contao EstateManager.
 *
 * @package     ctm-estatemanager
 * @license     MIT
 * @author      Daniele Sciannimanica <https://github.com/doishub>
 * @copyright   Oveleon               <https://www.oveleon.de/>
 */

use Contao\Backend;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\System;

System::loadLanguageFile('tl_filter_item');

// Extend the default palette
PaletteManipulator::create()
    ->addField(['extendRealEstateFilter', 'extendRealEstateFilterItem', 'extendRealEstateExposeModule'], 'publish_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_style_manager');

// Extend palette selector
$GLOBALS['TL_DCA']['tl_style_manager']['palettes']['__selector__'][] = 'extendRealEstateFilterItem';
$GLOBALS['TL_DCA']['tl_style_manager']['palettes']['__selector__'][] = 'extendRealEstateExposeModule';

// Extend subpalette
$GLOBALS['TL_DCA']['tl_style_manager']['subpalettes']['extendRealEstateFilterItem'] = 'realEstateFilterItems';
$GLOBALS['TL_DCA']['tl_style_manager']['subpalettes']['extendRealEstateExposeModule'] = 'realEstateExposeModules';

// Extend fields
$GLOBALS['TL_DCA']['tl_style_manager']['fields']['extendRealEstateFilter'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_style_manager']['extendRealEstateFilter'],
    'exclude'          => true,
    'filter'           => true,
    'inputType'        => 'checkbox',
    'eval'             => ['tl_class'=>'clr'],
    'sql'              => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_style_manager']['fields']['extendRealEstateFilterItem'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_style_manager']['extendRealEstateFilterItem'],
    'exclude'          => true,
    'filter'           => true,
    'inputType'        => 'checkbox',
    'eval'             => ['tl_class'=>'clr', 'submitOnChange'=>true],
    'sql'              => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_style_manager']['fields']['realEstateFilterItems'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_style_manager']['realEstateFilterItems'],
    'inputType'        => 'checkbox',
    'options_callback' => ['tl_style_manager_estatemanager', 'getRealEstateFilterItems'],
    'reference'        => &$GLOBALS['TL_LANG']['CEM_RFI'],
    'eval'             => ['multiple'=>true, 'mandatory'=>true, 'tl_class'=>'w50 clr'],
    'sql'              => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_style_manager']['fields']['extendRealEstateExposeModule'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_style_manager']['extendRealEstateExposeModule'],
    'exclude'          => true,
    'filter'           => true,
    'inputType'        => 'checkbox',
    'eval'             => ['tl_class'=>'clr', 'submitOnChange'=>true],
    'sql'              => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_style_manager']['fields']['realEstateExposeModules'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_style_manager']['realEstateExposeModules'],
    'inputType'        => 'checkbox',
    'options_callback' => ['tl_style_manager_estatemanager', 'getRealEstateExposeModules'],
    'reference'        => &$GLOBALS['TL_LANG']['FMD'],
    'eval'             => ['multiple'=>true, 'mandatory'=>true, 'tl_class'=>'w50 clr'],
    'sql'              => "blob NULL"
];


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_style_manager_estatemanager extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import(BackendUser::class, 'User');
    }

    /**
     * Return all form fields as array
     *
     * @return array
     */
    public function getRealEstateFilterItems()
    {
        return array_keys($GLOBALS['CEM_RFI']);
    }

    /**
     * Return all form fields as array
     *
     * @return array
     */
    public function getRealEstateExposeModules()
    {
        $arrReturn = [];

        foreach ($GLOBALS['CEM_FE_EXPOSE_MOD'] as $k => $v)
        {
            if (is_array($v))
            {
                $arrReturn[$k] = [];

                foreach ($v as $kk => $vv)
                {
                    if ($kk === 'html')
                    {
                        continue;
                    }

                    $arrReturn[$k][] = $kk;
                }
            }
            else
            {
                $arrReturn[] = $k;
            }
        }

        return $arrReturn;
    }
}
