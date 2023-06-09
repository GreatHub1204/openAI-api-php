<?php

use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\CreateResponseData;

test('from with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class);
});

test('as array accessible with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl());

    expect($response['created'])->toBe(1664136088);
});

test('to array with url', function () {
    $response = CreateResponse::from(imageCreateWithUrl());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithUrl());
});

test('from with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->created->toBe(1664136088)
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponseData::class);
});

test('as array accessible with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json());

    expect($response['created'])->toBe(1664136088);
});

test('to array with b64_json', function () {
    $response = CreateResponse::from(imageCreateWithB46Json());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(imageCreateWithB46Json());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response['data'][0])
        ->url->toBe('https://openai.com/fake-image.png');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'data' => [
            [
                'url' => 'https://openai.com/new-image.png',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->url->toBe('https://openai.com/new-image.png');
});
