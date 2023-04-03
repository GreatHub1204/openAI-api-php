<?php

use OpenAI\Responses\Models\DeleteResponse;

test('from', function () {
    $result = DeleteResponse::from(fineTunedModelDeleteResource());

    expect($result)
        ->id->toBe('curie:ft-acmeco-2021-03-03-21-44-20')
        ->object->toBe('model')
        ->deleted->toBe(true);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(fineTunedModelDeleteResource());

    expect($result['id'])->toBe('curie:ft-acmeco-2021-03-03-21-44-20');
});

test('to array', function () {
    $result = DeleteResponse::from(fineTunedModelDeleteResource());

    expect($result->toArray())
        ->toBe(fineTunedModelDeleteResource());
});

test('fake', function () {
    $response = DeleteResponse::fake();

    expect($response)
        ->id->toBe('curie:ft-acmeco-2021-03-03-21-44-20');
});

test('fake with override', function () {
    $response = DeleteResponse::fake([
        'id' => 'curie:ft-1234',
    ]);

    expect($response)
        ->id->toBe('curie:ft-1234');
});
