<?php

namespace ContaoThemeManager\EstateManager;

use Oveleon\ContaoComponentStyleManager\StyleManagerModel;

class EstateManager
{
    /**
     * StyleManager Support
     *
     * Find published css groups using their table
     *
     * @param $strTable
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|StyleManagerModel[]|StyleManagerModel|null A collection of models or null if there are no css groups
     */
    public function onFindByTable($strTable, $arrOptions)
    {
        switch($strTable)
        {
            case 'tl_filter':
                return StyleManagerModel::findBy(array('extendRealEstateFilter=1'), null, $arrOptions);
            case 'tl_filter_item':
                return StyleManagerModel::findBy(array('extendRealEstateFilterItem=1'), null, $arrOptions);
            case 'tl_expose_module':
                return StyleManagerModel::findBy(array('extendRealEstateExposeModule=1'), null, $arrOptions);
        }

        return null;
    }

    /**
     * StyleManager Support
     *
     * If the field has not been selected, it is skipped
     *
     * @param $objStyleGroups
     * @param $objWidget
     *
     * @return bool Skip field
     */
    public function onSkipField($objStyleGroups, $objWidget)
    {
        if(!!$objStyleGroups->extendRealEstateFilterItem && $objWidget->strTable === 'tl_filter_item')
        {
            $arrFilterItems = \StringUtil::deserialize($objStyleGroups->realEstateFilterItems);

            if($arrFilterItems !== null && !in_array($objWidget->activeRecord->type, $arrFilterItems))
            {
                return true;
            }
        }

        if(!!$objStyleGroups->extendRealEstateExposeModule && $objWidget->strTable === 'tl_expose_module')
        {
            $arrModules = \StringUtil::deserialize($objStyleGroups->realEstateExposeModules);

            if($arrModules !== null && !in_array($objWidget->activeRecord->type, $arrModules))
            {
                return true;
            }
        }

        return false;
    }
}