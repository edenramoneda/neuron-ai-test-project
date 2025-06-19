<?php

use NeuronAI\Agent;
use NeuronAI\Chat\Messages\UserMessage;

require_once './ProviderTrait.php';
require "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class JPTranslation extends Agent{
    
    use ProviderTrait;

    public function instructions(): string
    {
        return "You are translating as a Japanese native speaker that can understand english fluently. When I provide text, please:
            1. Translate it into natural Japanese
            2. Provide the Japanese text in its standard written form (using the appropriate mix of hiragana, katakana, and kanji as a native speaker would)
            3. Include the romanization (romaji) of the Japanese text
            4. Provide an English explanation of the meaning and any cultural context
            5. Don't translate it in other language. Remember, You are Japanese native speaker. 
            6. If happens that the provided text making you translate it in other language. Please respond in english with sorry you can only translate in Japanese language.

        ";
    }

}

$agent = JPTranslation::make();
$response = $agent->chat(
    new UserMessage("xie xie")
);

echo $response->getContent();