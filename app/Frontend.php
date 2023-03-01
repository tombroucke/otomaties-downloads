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
        
        if (get_query_var('post_type') != 'download' || !is_int(get_query_var('p'))) {
            return;
        }

        $download = new Download(get_query_var('p'));

        if (!$download->fileId()) {
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            exit;
        }
        
        $file = get_attached_file($download->fileId());
        if ($file) {
            $filename       = basename($file);
            $filetype       = wp_check_filetype($filename);
            $filename       = esc_attr($filename);

            header("Content-Description: File Transfer");
            header("Content-Type: {$filetype[ "type" ]}");
            header("Content-Disposition: attachment; filename={$filename}");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: no-cache");
            header("Content-Length: " . filesize($file));
            readfile($file);
            exit;
        }
    }

    // /**
    //  * Register the stylesheets for the public-facing side of the site.
    //  *
    //  */
    // public function enqueueStyles() : void
    // {
    //     wp_enqueue_style($this->pluginName, Assets::find('css/main.css'), [], null);
    // }

    // /**
    //  * Register the JavaScript for the public-facing side of the site.
    //  *
    //  */
    // public function enqueueScripts() : void
    // {
    //     wp_enqueue_script($this->pluginName, Assets::find('js/main.js'), [], null, true);
    // }
}
