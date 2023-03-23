<?php //phpcs:ignore
namespace Otomaties\Downloads;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Create custom post types and taxonomies
 */
class CustomPostTypes
{

    /**
     * Register post type downloads
     */
    public function addDownloads() : void
    {
        $postType = 'download';
        $slug = 'downloads';
        $postSingularName = __('Download', 'otomaties-downloads');
        $postPluralName = __('Downloads', 'otomaties-downloads');

        register_extended_post_type(
            $postType,
            [
                'show_in_feed' => false,
                'show_in_rest' => true,
                'has_archive' => false,
                'labels' => $this->postTypeLabels($postSingularName, $postPluralName),
                'menu_icon' => 'dashicons-download',
                'dashboard_activity' => true,
                'supports' => ['title', 'thumbnail'],
                'admin_cols' => [
                    'download_url' => [
                        'title'  => __('Url', 'otomaties-downloads'),
                        'function' => function () {
                            printf(
                                '<input type="text" value="%s" readonly>',
                                get_the_permalink(),
                            );
                        },
                    ],
                    'download_featured_image' => [
                        'title'          => __('Preview', 'otomaties-downloads'),
                        'featured_image' => 'thumbnail',
                        'width' => 100,
                        'height' => 100,
                    ],
                ],

            ],
            [
                'singular' => $postSingularName,
                'plural'   => $postPluralName,
                'slug'     => $slug,
            ]
        );
    }

    public function addDownloadFields() : void
    {
        $download = new FieldsBuilder('otomaties-download', [
            'style' => 'seamless',
            'position' => 'acf_after_title',
        ]);
        $download
            ->addFile('file', [
                'label' => __('File', 'sage'),
                'required' => 0,
                'return_format' => 'ID',
                'wpml_cf_preferences' => 2,
            ])
            ->setLocation('post_type', '==', 'download');
        acf_add_local_field_group($download->build());
    }

    /**
     * Translate post type labels
     *
     * @param  string $singular_name The singular name for the post type.
     * @param  string $plural_name   The plural name for the post type.
     * @return array<string, string>
     */
    private function postTypeLabels(string $singular_name, string $plural_name) : array
    {
        return [
            'add_new' => __('Add New', 'otomaties-downloads'),
            /* translators: %s: singular post name */
            'add_new_item' => sprintf(
                __('Add New %s', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'edit_item' => sprintf(
                __('Edit %s', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'new_item' => sprintf(
                __('New %s', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'view_item' => sprintf(
                __('View %s', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: plural post name */
            'view_items' => sprintf(
                __('View %s', 'otomaties-downloads'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'search_items' => sprintf(
                __('Search %s', 'otomaties-downloads'),
                $plural_name
            ),
            /* translators: %s: plural post name to lower */
            'not_found' => sprintf(
                __('No %s found.', 'otomaties-downloads'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural post name to lower */
            'not_found_in_trash' => sprintf(
                __('No %s found in trash.', 'otomaties-downloads'),
                strtolower($plural_name)
            ),
            /* translators: %s: singular post name */
            'parent_item_colon' => sprintf(
                __('Parent %s:', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'all_items' => sprintf(
                __('All %s', 'otomaties-downloads'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'archives' => sprintf(
                __('%s Archives', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'attributes' => sprintf(
                __('%s Attributes', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name to lower */
            'insert_into_item' => sprintf(
                __('Insert into %s', 'otomaties-downloads'),
                strtolower($singular_name)
            ),
            /* translators: %s: singular post name to lower */
            'uploaded_to_this_item'    => sprintf(
                __('Uploaded to this %s', 'otomaties-downloads'),
                strtolower($singular_name)
            ),
            /* translators: %s: plural post name to lower */
            'filter_items_list' => sprintf(
                __('Filter %s list', 'otomaties-downloads'),
                strtolower($plural_name)
            ),
            /* translators: %s: singular post name */
            'items_list_navigation' => sprintf(
                __('%s list navigation', 'otomaties-downloads'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'items_list' => sprintf(
                __('%s list', 'otomaties-downloads'),
                $plural_name
            ),
            /* translators: %s: singular post name */
            'item_published' => sprintf(
                __('%s published.', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_published_privately' => sprintf(
                __('%s published privately.', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_reverted_to_draft' => sprintf(
                __('%s reverted to draft.', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_scheduled' => sprintf(
                __('%s scheduled.', 'otomaties-downloads'),
                $singular_name
            ),
            /* translators: %s: singular post name */
            'item_updated' => sprintf(
                __('%s updated.', 'otomaties-downloads'),
                $singular_name
            ),
        ];
    }

    // /**
    //  * Translate taxonomy labels
    //  *
    //  * @param  string $singular_name The singular name for the taxonomy.
    //  * @param  string $plural_name   The plural name for the taxonomy.
    //  * @return array<string, string>
    //  */
    // private function taxonomyLabels($singular_name, $plural_name)
    // {
    //     return [
    //         /* translators: %s: plural taxonomy name */
    //         'search_items' => sprintf(
    //             __('Search %s', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         /* translators: %s: plural taxonomy name */
    //         'popular_items' => sprintf(
    //             __('Popular %s', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         /* translators: %s: plural taxonomy name */
    //         'all_items' => sprintf(
    //             __('All %s', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'parent_item' => sprintf(
    //             __('Parent %s', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'parent_item_colon' => sprintf(
    //             __('Parent %s:', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'edit_item' => sprintf(
    //             __('Edit %s', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'view_item' => sprintf(
    //             __('View %s', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'update_item' => sprintf(
    //             __('Update %s', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'add_new_item' => sprintf(
    //             __('Add New %s', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: singular taxonomy name */
    //         'new_item_name' => sprintf(
    //             __('New %s Name', 'otomaties-downloads'),
    //             $singular_name
    //         ),
    //         /* translators: %s: plural taxonomy name to lower */
    //         'separate_items_with_commas' => sprintf(
    //             __('Separate %s with commas', 'otomaties-downloads'),
    //             strtolower($plural_name)
    //         ),
    //         /* translators: %s: plural taxonomy name to lower */
    //         'add_or_remove_items' => sprintf(
    //             __('Add or remove %s', 'otomaties-downloads'),
    //             strtolower($plural_name)
    //         ),
    //         /* translators: %s: plural taxonomy name to lower */
    //         'choose_from_most_used' => sprintf(
    //             __('Choose from most used %s', 'otomaties-downloads'),
    //             strtolower($plural_name)
    //         ),
    //         /* translators: %s: plural taxonomy name to lower */
    //         'not_found' => sprintf(
    //             __('No %s found', 'otomaties-downloads'),
    //             strtolower($plural_name)
    //         ),
    //         /* translators: %s: plural taxonomy name to lower */
    //         'no_terms' => sprintf(
    //             __('No %s', 'otomaties-downloads'),
    //             strtolower($plural_name)
    //         ),
    //         /* translators: %s: plural taxonomy name */
    //         'items_list_navigation' => sprintf(
    //             __('%s list navigation', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         /* translators: %s: plural taxonomy name */
    //         'items_list' => sprintf(
    //             __('%s list', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         'most_used' => 'Most Used',
    //         /* translators: %s: plural taxonomy name */
    //         'back_to_items' => sprintf(
    //             __('&larr; Back to %s', 'otomaties-downloads'),
    //             $plural_name
    //         ),
    //         /* translators: %s: singular taxonomy name to lower */
    //         'no_item' => sprintf(
    //             __('No %s', 'otomaties-downloads'),
    //             strtolower($singular_name)
    //         ),
    //         /* translators: %s: singular taxonomy name to lower */
    //         'filter_by' => sprintf(
    //             __('Filter by %s', 'otomaties-downloads'),
    //             strtolower($singular_name)
    //         ),
    //     ];
    // }
}
