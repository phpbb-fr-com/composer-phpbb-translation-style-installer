<?php

namespace phpbbfr\PhpbbTranslationStyleInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();

        if (empty($extra['phpbb-style']) || empty($extra['phpbb-language']))
        {
            $dir = preg_replace('#^([a-z0-9]+)-([a-z_]{2,})$#i', 'styles/$1/theme/$2', $package->getName());
            if ($dir != $package->getName())
            {
                return $dir;
            }
            else
            {
                throw new \InvalidArgumentException('Invalid phpbb-translation-style composer package.');
            }
        }

        return sprintf('styles/%s/theme/%s', $extra['phpbb-style'], $extra['phpbb-language']);
    }

    public function supports($packageType)
    {
        return $packageType == 'phpbb-translation-style';
    }
}