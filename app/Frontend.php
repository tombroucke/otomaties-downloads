<?php

namespace Otomaties\Downloads;

use Otomaties\Downloads\Models\Download;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @subpackage Downloads/public
 */

class Frontend
{
    /**
     * Initialize the class and set its properties.
     */
    public function __construct()
    {
    }

    public function downloadAttachment() : void
    {
        global $wp_query;
        if (get_query_var('post_type') != 'download' || !is_int(get_query_var('p')) || get_query_var('p') < 1) {
            return;
        }

        $downloadId = get_query_var('p');
        if (get_post_type($downloadId) !== 'download') {
            return;
        }

        $download = new Download($downloadId);
    
        if (get_post_status($downloadId) !== 'publish') {
            $defaultLanguage = apply_filters('wpml_default_language', null);
            $originalId = apply_filters('wpml_object_id', $downloadId, 'download', true, $defaultLanguage);
            $download = new Download($originalId);
        }

        if (!$download->fileId()) {
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            return;
        }
        
        $file = get_attached_file($download->fileId());
        if ($file) {
            $filename       = basename($file);
            $filetype       = wp_check_filetype($filename);
            $filename       = esc_attr($filename);

            header("Content-Description: File Transfer");
            header("Content-Type: {$filetype[ "type" ]}", true, 200);
            header("Content-Disposition: attachment; filename={$filename}");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: no-cache");
            header("Content-Length: " . filesize($file));
            readfile($file);
            exit;
        }
    }
}
