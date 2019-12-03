<?php
##################################################################
#### Main Library Routes
##################################################################

Route::prefix(config('multilingual.route_prefix'))
    ->namespace("SethPhat\Multilingual\Controllers")
    ->middleware(config('multilingual.custom_middleware'))
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