<?php

namespace Otomaties\Downloads;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 */

class Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     */
    public static function activate() : void
    {
        (new CustomPostTypes())->addDownloads();
        flush_rewrite_rules();
    }
}
