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
        }

        return null;
    }
}