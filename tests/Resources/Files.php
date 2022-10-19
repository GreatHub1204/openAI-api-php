<?php

use OpenAI\Responses\Files\CreateResponse;
use OpenAI\Responses\Files\DeleteResponse;
use OpenAI\Responses\Files\ListResponse;
use OpenAI\Responses\Files\RetrieveResponse;

test('list', function () {
    $client = mockClient('GET', 'files', [], fileListResource());

    $result = $client->files()->list();

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], fileResource());

    $result = $client->files()->retrieve('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');
});

test('download', function () {
    $client = mockContentClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3/content', [], fileContentResource());

    $result = $client->files()->download('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)->toBeString()->toBe(fileContentResource());
});

test('upload', function () {
    $client = mockClient('POST', 'files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ], fileResource());

    $result = $client->files()->upload([
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');
});

test('delete', function () {
    $client = mockClient('DELETE', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], fileDeleteResource());

    $result = $client->files()->delete('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->deleted->toBe(true);
});
