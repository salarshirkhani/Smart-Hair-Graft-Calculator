<?php
namespace Core;

use OpenAI;

class OpenAIService {
    public static function client() {
        $apiKey = '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';
        if (!$apiKey) {
            throw new \Exception('OpenAI API key is missing. Please set OPENAI_API_KEY in .env file.');
        }
        return OpenAI::client($apiKey);
    }
}
