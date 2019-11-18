<?php
##################################################################
#### Main Library Routes
##################################################################

Route::prefix(config('multilingual.route_prefix'))
    ->namespace("SethPhat\Multilingual\Controllers")
    ->middleware(config('multilingual.custom_middleware'))
    ->group(function () {

    Route::get("/", "PageController@index")->name('multilingual.index');
});