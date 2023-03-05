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

use Fisharebest\Webtrees\Webtrees;

require __DIR__ . '/ExtendedSlideShowModule.php';

return Webtrees::make(ExtendedSlideShowModule::class);
