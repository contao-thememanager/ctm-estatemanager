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

namespace ContaoThemeManager\EstateManager;

use Contao\Model\Collection;
use Contao\StringUtil;
use Oveleon\ContaoComponentStyleManager\Model\StyleManagerModel;

class EstateManager
{
    /**
     * StyleManager Support
     * Find published css groups using their table
     *
     * @return Collection|StyleManagerModel[]|StyleManagerModel|null A collection of models or null if there are no css groups
     */
    public function onFindByTable($strTable, array $arrOptions)
    {
        switch ($strTable)
        {
            case 'tl_filter':
                return StyleManagerModel::findBy(['extendRealEstateFilter=1'], null, $arrOptions);

            case 'tl_filter_item':
                return StyleManagerModel::findBy(['extendRealEstateFilterItem=1'], null, $arrOptions);

            case 'tl_expose_module':
                return StyleManagerModel::findBy(['extendRealEstateExposeModule=1'], null, $arrOptions);
        }

        return null;
    }

    /**
     * StyleManager Support
     * If the field has not been selected, it is skipped
     */
    public function onSkipField($objStyleGroups, $objWidget): bool
    {
        if (!!$objStyleGroups->extendRealEstateFilterItem && 'tl_filter_item' === $objWidget->strTable)
        {
            $arrFilterItems = StringUtil::deserialize($objStyleGroups->realEstateFilterItems);

            if (null !== $arrFilterItems && !in_array($objWidget->activeRecord->type, $arrFilterItems))
            {
                return true;
            }
        }

        if (!!$objStyleGroups->extendRealEstateExposeModule && 'tl_expose_module' === $objWidget->strTable)
        {
            $arrModules = StringUtil::deserialize($objStyleGroups->realEstateExposeModules);

            if (null !== $arrModules && !in_array($objWidget->activeRecord->type, $arrModules))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * StyleManager Support
     * Check whether an element is visible in style manager widget
     */
    public function isVisibleGroup($objGroup, $strTable): bool
    {
        if (
            'tl_filter_item' === $strTable && !!$objGroup->extendRealEstateFilterItem ||
            'tl_filter' === $strTable && !!$objGroup->extendRealEstateFilter ||
            'tl_expose_module' === $strTable && !!$objGroup->extendRealEstateExposeModule
        )
        {
            return true;
        }

        return false;
    }
}
