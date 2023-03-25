<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Exceptions\InvalidArgumentException;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseUsage;
use OpenAI\Responses\Completions\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'completions', [
        'model' => 'da-vince',
        'prompt' => 'hi',
    ], completion());

    $result = $client->completions()->create([
        'model' => 'da-vince',
        'prompt' => 'hi',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna')
        ->object->toBe('text_completion')
        ->created->toBe(1664136088)
        ->model->toBe('davinci')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->text->toBe("el, she elaborates more on the Corruptor's role, suggesting K")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('length');

    expect($result->usage)
        ->promptTokens->toBe(1)
        ->completionTokens->toBe(16)
        ->totalTokens->toBe(17);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->completions()->create([
        'model' => 'da-vince',
        'prompt' => 'hi',
        'stream' => true,
    ]);
})->expectException(InvalidArgumentException::class);

test('create streamed', function () {
    $response = new Response(
        body: new Stream(completionStream())
    );

    $client = mockStreamClient('POST', 'completions', [
        'model' => 'text-davinci-003',
        'prompt' => 'hi',
    ], $response);

    $result = $client->completions()->createStreamed([
        'model' => 'text-davinci-003',
        'prompt' => 'hi',
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('cmpl-6wcyFqMKXiZffiydSfWHhjcgsf3KD')
        ->object->toBe('text_completion')
        ->created->toBe(1679430847)
        ->model->toBe('text-davinci-003')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeNull();

    expect($result->getIterator()->current()->choices[0])
        ->text->toBe('!')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();
});
