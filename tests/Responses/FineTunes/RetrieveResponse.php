<?php

use OpenAI\Responses\FineTunes\RetrieveResponse;
use OpenAI\Responses\FineTunes\RetrieveResponseEvent;
use OpenAI\Responses\FineTunes\RetrieveResponseFile;
use OpenAI\Responses\FineTunes\RetrieveResponseHyperparams;

test('from', function () {
    $result = RetrieveResponse::from(fineTuneResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('ft-AF1WoRqd3aJAHsqc9NY7iL8F')
        ->object->toBe('fine-tune')
        ->model->toBe('curie')
        ->createdAt->toBe(1614807352)
        ->events->toBeArray()->toHaveCount(2)
        ->events->each->toBeInstanceOf(RetrieveResponseEvent::class)
        ->fineTunedModel->toBe('curie => ft-acmeco-2021-03-03-21-44-20')
        ->hyperparams->toBeInstanceOf(RetrieveResponseHyperparams::class)
        ->organizationId->toBe('org-jwe45798ASN82s')
        ->resultFiles->toBeArray()->toHaveCount(2)
        ->resultFiles->each->toBeInstanceOf(RetrieveResponseFile::class)
        ->status->toBe('succeeded')
        ->validationFiles->toBeArray()->toHaveCount(2)
        ->validationFiles->each->toBeInstanceOf(RetrieveResponseFile::class)
        ->trainingFiles->toBeArray()->toHaveCount(2)
        ->trainingFiles->each->toBeInstanceOf(RetrieveResponseFile::class)
        ->updatedAt->toBe(1614807865);
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(fineTuneResource());

    expect($result['id'])->toBe('ft-AF1WoRqd3aJAHsqc9NY7iL8F');
});

test('to array', function () {
    $result = RetrieveResponse::from(fineTuneResource());

    expect($result->toArray())
        ->toBe(fineTuneResource());
});
