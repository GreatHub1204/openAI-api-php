<?php

use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseUsage;

test('from', function () {
    $completion = CreateResponse::from(completion());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna')
        ->object->toBe('text_completion')
        ->created->toBe(1664136088)
        ->model->toBe('davinci')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('as array accessible', function () {
    $completion = CreateResponse::from(completion());

    expect($completion['id'])->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna');
});

test('to array', function () {
    $completion = CreateResponse::from(completion());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(completion());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('cmpl-uqkvlQyYK7bGYrRHQ0eXlWi7');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'cmpl-1234',
        'choices' => [
            [
                'text' => 'awesome!',
            ],
        ],
    ]);

    expect($response)
        ->id->toBe('cmpl-1234')
        ->and($response->choices[0])
        ->text->toBe('awesome!')
        ->index->toBe(0);
});
