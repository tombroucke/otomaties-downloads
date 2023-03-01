<?php
namespace Otomaties\Downloads\Models;

use Otomaties\WpModels\PostType;

class Download extends PostType
{
    public static function postType() : string
    {
        return 'download';
    }

    public function fileId() : ?int
    {
    
        $fileId = null;
    
        if (function_exists('get_field')) {
            $fileId = get_field('file', $this->getId());
        }

        return $fileId;
    }
}
