<?php

/**
 * webtrees-extended-slide-show: add a person's lifespan to the slide show
 * Copyright (C) 2023 Steffen Hieber
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Hieberst\Webtrees\Module;

use Fisharebest\Localization\Translation;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\View;

class ExtendedSlideShowModule extends AbstractModule  implements ModuleCustomInterface
{
    use ModuleCustomTrait;

    public function boot(): void
    {
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
        View::registerCustomView('::modules/random_media/slide-show', $this->name() . '::slide-show-ext');
    }

    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    public function title(): string
    {
        return I18N::translate('Extended slide show');
    }

    public function description(): string
    {
        return I18N::translate('Random pictures from the current family tree with year of birth and year of death.');
    }

    public function customModuleAuthorName(): string
    {
        return 'Steffen Hieber';
    }

    public function customModuleVersion(): string
    {
        return '0.1.1';
    }

    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/hieberst/webtrees-extended-slide-show';
    }

    public function customTranslations(string $language): array
    {
        $messages = $this->resourcesFolder() . "lang/$language/messages.po";

        if (file_exists($messages)) {
            return (new Translation($messages))->asArray();
        }

        return [];
    }
}
