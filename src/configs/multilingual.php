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
     * If you don't use cache, the library will query every time you get the text
     * If you use cache, you need to publish the text bundle before using the text
     * Default: false
     */
    'use_cache' => false,

    /**
     * Your custom middleware to access the Backend Pages
     * Default: 'auth' => authentication check of Laravel Authentication
     */
    'custom_middleware' => ['auth'], //

    /**
     * The route prefix to access the Backend Pages
     * Default: /settings/multilingual
     */
    'route_prefix' => '/settings/multilingual',
];