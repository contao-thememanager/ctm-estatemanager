<?php

declare(strict_types=1);

/*
 * This file is part of Contao ThemeManager RealEstate Plugin.
 *
 * (c) https://www.oveleon.de/
 */

namespace ContaoThemeManager\EstateManager\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoThemeManager\EstateManager\ContaoThemeManagerEstateManager;
use ContaoThemeManager\Core\ContaoThemeManagerCore;
use ContaoEstateManager\EstateManager\EstateManager;
use Oveleon\ContaoComponentStyleManager\ContaoComponentStyleManager;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoThemeManagerEstateManager::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoThemeManagerCore::class, EstateManager::class, ContaoComponentStyleManager::class])
                ->setReplace(['ctm-estatemanager']),
        ];
    }
}
