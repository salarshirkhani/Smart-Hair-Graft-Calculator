<?php
namespace Core;

use OpenAI;

class OpenAIService {
    public static function client() {
        $apiKey = dotenv('apikey');
        if (!$apiKey) {
            throw new \Exception('OpenAI API key is missing. Please set OPENAI_API_KEY in .env file.');
        }
        return OpenAI::client($apiKey);
    }
}
