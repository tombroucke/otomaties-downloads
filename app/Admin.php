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

    public function preventAttachmentToDownloadPost($attach, $attachment_id, $post_id)
    {
        if (get_post_type($post_id) == 'download') {
            return false;
        }
        return $attach;
    }
}
