<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 28/06/2018
 * Time: 14:11
 */

namespace AppBundle\Service;
use Symfony\Component\Finder\Finder;


class DataLoader
{
    // resuper le content de file txt
    public function dataLoader($file) {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../WebsiteBundle/Resources/assets/')->name($file.'.txt');
        foreach ($finder as $file) $content = file_get_contents($file);

        return $content;
    }
}