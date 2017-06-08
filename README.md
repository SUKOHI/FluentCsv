# FluentCsv
A Laravel package to generate or save csv file with encoding like SJIS-win.
(Tested in L5.4)

Installation
====

Execute composer command.

    composer require sukohi/fluent-csv:1.*

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        Sukohi\FluentCsv\FluentCsvServiceProvider::class,
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'FluentCsv'   => Sukohi\FluentCsv\Facades\FluentCsv::class
    ]
    
# Usage

(Download)

    $csv_data = [   // UTF-8 
        ['データ 1-1', 'データ 1-2', 'データ 1-3'],
        ['データ 2-1', 'データ 2-2', 'データ 2-3'],
        ['データ 3-1', 'データ 3-2', 'データ 3-3'],
    ];
    $to_encoding = 'SJIS-win';
    $fluent = \FluentCsv::setData($csv_data, $to_encoding);

    return $fluent->download('テスト.csv');    // File name can be multi-byte character.
    
(Save)

    $csv_data = [   // UTF-8 
        ['データ 1-1', 'データ 1-2', 'データ 1-3'],
        ['データ 2-1', 'データ 2-2', 'データ 2-3'],
        ['データ 3-1', 'データ 3-2', 'データ 3-3'],
    ];
    $fluent = \FluentCsv::setData($csv_data, 'SJIS-win');

    if($fluent->save(storage_path('app/public/test.csv'))) {

        echo 'Complete!';

    }
    
License
====

This package is licensed under the MIT License.

Copyright 2017 Sukohi Kuhoh