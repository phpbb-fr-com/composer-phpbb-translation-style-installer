<?php

namespace phpbbfr\PhpbbTranslationStyleInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        $name = explode('/', $package->getName())[1];

        if (!preg_match('#^([a-z0-9]+)-([a-z_]{2,})$#i', $name, $matches))
        {
            throw new \InvalidArgumentException('Invalid phpbb-translation-style composer package.');
        }

        $style = isset($extra['phpbb-style']) ? $extra['phpbb-style'] : $matches[1];
        $lang  = isset($extra['phpbb-language']) ? $extra['phpbb-language'] : $matches[2];

        return sprintf('styles/%s/theme/%s', $style, $lang);
    }

    public function supports($packageType)
    {
        return $packageType == 'phpbb-translation-style';
    }
}