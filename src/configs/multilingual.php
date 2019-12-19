<?php

return [
    /**
     * Default language
     * Default: 'en' => English
     */
    'default_lang' => 'en',

    /**
     * Table prefix
     * Please keep the underscore at the end of the string
     */
    'table_prefix' => 'lml_', //lml => laravel-multilingual =))

    /**
     * You should decided whether you want to use cache or not.
     * If you don't use cache, the library will query to the Database every time you get the text
     * If you use cache, you need to publish the text bundle before using the text. All the text bundle items will be Cached Forever until you published it again.
     * Default: false
     */
    'use_cache' => false,

    /**
     * Your custom middleware to access the Backend Pages
     * Default: [] => No-check at all
     * Suggestion: ['auth', '..'] => Only authenticated user can go in
     */
    'custom_middleware' => [], //

    /**
     * The route prefix to access the Backend Pages
     * Default: /settings/multilingual
     */
    'route_prefix' => '/settings/multilingual',
];