<?php
##################################################################
#### Main Library Routes
##################################################################

$base_middleware = ['web'];
$config_middleware = config('multilingual.custom_middleware') ?? [];
$final_middleware = array_merge($base_middleware, $config_middleware);

Route::prefix(config('multilingual.route_prefix'))
    ->namespace("SethPhat\Multilingual\Controllers")
    ->middleware($final_middleware)
    ->group(function () {

        // dashboard
        Route::get("/", "PageController@index")->name('multilingual.index');

        // this is where the fun begins
        Route::resources([
            'lml-language' => 'LanguageController',
            'lml-text-bundle' => 'TextBundleController',
            'lml-text-bundle-item' => 'TextBundleItemController',
        ]);
});