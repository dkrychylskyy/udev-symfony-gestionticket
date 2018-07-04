<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 04/07/2018
 * Time: 11:23
 */

namespace WebsiteBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;


class ImageUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}