<?php
/**
 * Created by PhpStorm.
 * User: thuyshawn
 * Date: 6/05/2015
 * Time: 4:40 PM
 */

namespace App\Services;


class DeleteFile
{

    protected $destination;
    protected $messages = [];
    protected $thumbNailDestination;
    protected $deleteThumbnail = false;
    protected $directory;
    protected $fileName;
    protected $extension;

    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("$file was not found.");
        }

        $this->destination = $file;
    }

    public function deleteFile()
    {
        unlink($this->destination);

        if($this->deleteThumbnail === true) {
            unlink($this->thumbNailDestination);
        }
    }

    public function deleteThumbnail()
    {
        $this->deleteThumbnail = true;
        $this->createThumbnailName();
    }

    protected function getNames()
    {
        $nameParts = pathinfo($this->destination);
        $this->directory = $nameParts['dirname'];
        $this->fileName = $nameParts['filename'];
        $this->extension = $nameParts['extension'];
    }

    public function getMessages ()
    {

        return $this->messages;
    }

    protected function createThumbnailName()
    {

        $this->getNames();
        $this->thumbNailDestination = $this->directory . '/' . $this->fileName . '_tn' . '.' . $this->extension;
        $this->messages[] = $this->thumbNailDestination;
    }

}

