<?php

namespace Otomaties\Downloads;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @subpackage Downloads/admin
 */

class Admin
{

    /**
     * Initialize the class and set its properties.
     */
    public function __construct()
    {
    }

    /**
     * Prevent ACF from attaching the media file to the download
     *
     * @param bool $attach
     * @param int $attachment_id
     * @param int $post_id
     * @return boolean
     */
    public function preventAttachmentToDownloadPost($attach, $attachment_id, $post_id) : bool
    {
        if (get_post_type($post_id) == 'download') {
            return false;
        }
        return $attach;
    }
}
