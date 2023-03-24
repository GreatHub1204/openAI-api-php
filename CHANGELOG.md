# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## v0.4.1 (2023-03-24)
### Added
- Stream suppport ([#84](https://github.com/openai-php/client/pull/84))

## v0.4.0 (2023-03-17)
### Changed
- Removed dependency for `guzzlehttp/guzzle` and use PSR-18 client discovery instead ([#75](https://github.com/openai-php/client/pull/75))
- Add Client factory which allows for a custom HTTP client
- Client factory further accepts custom HTTP headers, query parameters and API URI

## v0.3.5 (2023-03-08)
### Fixed
- `status_details` can be a string in file responses. Affects Files and FineTunes resources ([#68](https://github.com/openai-php/client/pull/68))

## v0.3.4 (2023-03-03)
### Added
- `Audio` resource to turn audio into text powered by `whisper-1` ([#62](https://github.com/openai-php/client/pull/62))

## v0.3.3 (2023-03-02)
### Added
- `Chat` resource aka ChatGPT powered by `gpt-3.5-turbo` ([#60](https://github.com/openai-php/client/pull/60))

## v0.3.2 (2023-02-28)
### Fixed
- Nullable `finish_reason` on Completions `CreateResponse` ([#52](https://github.com/openai-php/client/pull/52), [545e0ab](https://github.com/openai-php/client/commit/545e0aba106fb0c60a86c2918f5209940b6dd26f))

## v0.3.1 (2023-02-07)
### Fixed
- Missing `events` on FineTunes `RetrieveResponse` ([#41](https://github.com/openai-php/client/pull/41))

## v0.3.0 (2023-01-03)
### Changed
- `OpenAI::client()` first argument changed from `apiToken` to `apiKey` ([#25](https://github.com/openai-php/client/pull/25))

### Fixed
- Getting contents from Guzzle's response causing issues with middleware ([#33](https://github.com/openai-php/client/pull/33))

## v0.2.1 (2022-11-09)
### Fixed
- FineTunes create response: `batch_size`, `learning_rate` and `fine_tuned_model` are nullable ([#16](https://github.com/openai-php/client/issues/16))
- File responses: add missing fields `status` and `status_details`

## v0.2.0 (2022-11-07)
### Added
- Add `images()` resource to interact with [DALL-E](https://beta.openai.com/docs/api-reference/images)

### Fixed
- Parse completions create response with logprobs correctly

## v0.1.0 (2022-10-20)
### Added
- First version
