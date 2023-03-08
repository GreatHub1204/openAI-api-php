<?php

use OpenAI\Responses\Files\RetrieveResponse;

test('from', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');
});

test('from with status error', function () {
    $result = RetrieveResponse::from(fileWithErrorStatusResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-OGHjVIyNB7svNc6vaUXNgR87')
        ->object->toBe('file')
        ->bytes->toBe(181023)
        ->createdAt->toBe(1678253244)
        ->filename->toBe('mydata_corrupt.jsonl')
        ->purpose->toBe('fine-tune')
        ->status->toBe('error')
        ->statusDetails->toBe("Invalid file format. Example 1273 cannot be parsed. Error: line contains invalid json: Expecting ',' delimiter: line 1 column 79 (char 78) (line 1273)");
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result->toArray())
        ->toBe(fileResource());
});
