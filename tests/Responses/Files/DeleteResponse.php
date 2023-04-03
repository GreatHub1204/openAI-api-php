<?php

use OpenAI\Responses\Files\DeleteResponse;

test('from', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->deleted->toBe(true);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result->toArray())
        ->toBe(fileDeleteResource());
});

test('fake', function () {
    $response = DeleteResponse::fake();

    expect($response)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = DeleteResponse::fake([
        'id' => 'file-1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('file-1234')
        ->deleted->toBe(false);
});
