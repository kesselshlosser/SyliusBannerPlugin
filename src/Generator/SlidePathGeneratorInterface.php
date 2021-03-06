<?php
/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the Sylius LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Generator;

use Black\SyliusBannerPlugin\Entity\SlideInterface;

interface SlidePathGeneratorInterface
{
    public function generate(SlideInterface $slide): string;
}
