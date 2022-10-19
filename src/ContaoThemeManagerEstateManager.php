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

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoThemeManagerEstateManager extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
