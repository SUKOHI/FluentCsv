# FluentCsv

A Laravel package that allows you to generate or save csv file being encoded.  
This package is maintained under Larave 5.8.

# Installation

Execute composer command.

    composer require sukohi/fluent-csv:2.*

# Preparation

If your Laravel's version is less than 5.4, set the service provider and alias in app.php

    'providers' => [
        ...Others...,  
        Sukohi\FluentCsv\FluentCsvServiceProvider::class,
    ]

    'aliases' => [
        ...Others...,  
        'FluentCsv'   => Sukohi\FluentCsv\Facades\FluentCsv::class
    ]

# Usage

## The simplest way

[Download]

    $csv_data = [   // UTF-8 
        ['データ 1-1', 'データ 1-2', 'データ 1-3'],
        ['データ 2-1', 'データ 2-2', 'データ 2-3'],
        ['データ 3-1', 'データ 3-2', 'データ 3-3'],
    ];
    $to_encoding = 'SJIS-win';
    $fluent = \FluentCsv::setData($csv_data, $to_encoding);
    return $fluent->download('テスト.csv');    // File name can be multi-byte character.
    
[Save]

    $csv_data = [   // UTF-8 
        ['データ 1-1', 'データ 1-2', 'データ 1-3'],
        ['データ 2-1', 'データ 2-2', 'データ 2-3'],
        ['データ 3-1', 'データ 3-2', 'データ 3-3'],
    ];
    $fluent = \FluentCsv::setData($csv_data, 'SJIS-win');

    if($fluent->save(storage_path('app/public/test.csv'))) {

        echo 'Complete!';

    }

## Add data in loop

    $items = \App\Item::get();
    $fluent = \FluentCsv::setEncoding('SJIS-win');

    foreach($items as $item) {

        $fluent->addData($item->only(['id', 'name']));

    }

    return $fluent->download('test.csv');

## Clear data

    $fluent->clearData();

# License

This package is licensed under the MIT License.

Copyright 2017 Sukohi Kuhoh