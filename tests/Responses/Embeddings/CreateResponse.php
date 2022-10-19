<?php

use OpenAI\Responses\Embeddings\CreateResponse;
use OpenAI\Responses\Embeddings\CreateResponseEmbedding;

test('from', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response->toArray())->toBeArray()->toBe(embeddingList());
});
