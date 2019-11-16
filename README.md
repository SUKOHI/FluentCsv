# FluentCsv

A Laravel package that allows you to generate or save csv file being encoded.  
This package is maintained under Laravel 5.7.

# Installation

Execute composer command.

    composer require sukohi/fluent-csv:3.*

# Usage

## Download

    $csv_data = [   // UTF-8 
        ['データ 1-1', 'データ 1-2', 'データ 1-3'],
        ['データ 2-1', 'データ 2-2', 'データ 2-3'],
        ['データ 3-1', 'データ 3-2', 'データ 3-3'],
    ];
    $to_encoding = 'SJIS-win';
    $fluent = \FluentCsv::setData($csv_data, $to_encoding);
    return $fluent->download('テスト.csv');    // File name can be multi-byte character.
    
## Save

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

# Retrieve

    // Basic way
    $path = '/PATH/TO/YOUR/CSV/FOLDER/test.csv';
    $data = \FluentCsv::parse($path);
    
    // with encoding
    $path = '/PATH/TO/YOUR/CSV/FOLDER/test.csv';
    $from_encoding = 'sjis-win';
    $data = \FluentCsv::parse($path, $from_encoding);


# License

This package is licensed under the MIT License.

Copyright 2017 Sukohi Kuhoh
