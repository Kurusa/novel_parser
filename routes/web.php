<?php

Route::get('/', function () {
    return view('index');
});

Route::post('/parse-novel', 'NovelController@parsePage')->name('parse-novel');
