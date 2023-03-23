<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ], chatCompletion());

    $result = $client->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->message->role->toBe('assistant')
        ->message->content->toBe("\n\nHello there, how may I assist you today?")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('stop');

    expect($result->usage)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ]);
})->expectException(\OpenAI\Exceptions\InvalidArgumentException::class);

test('create streamed', function () {
    $response = new Response(
        body: new Stream(chatCompletionStream())
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class);

    expect($result->read())
        ->toBeInstanceOf(Generator::class);

    expect($result->read()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateStreamedResponseChoice::class)
        ->usage->toBeNull();

    expect($result->read()->current()->choices[0])
        ->delta->role->toBeNull()
        ->delta->content->toBe('Hello')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();
});
