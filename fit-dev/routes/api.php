<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {
    Route::get('/reception', 'ReceptionController@reception');
});
