<?php
namespace Core;

use OpenAI;

class OpenAIService {
    public static function client() {
        return OpenAI::client(getenv('OPENAI_API_KEY'));
    }
}
