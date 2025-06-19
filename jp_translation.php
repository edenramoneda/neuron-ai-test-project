<?php

use NeuronAI\Agent;
use NeuronAI\Chat\Messages\UserMessage;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Gemini\Gemini;

require "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class JPTranslation extends Agent{
    
    public function provider(): AIProviderInterface {
        return new Gemini(
            key: $_ENV['AI_API_KEY'],
            model: "gemini-2.5-flash"
        );
    }

    public function instructions(): string
    {
        return "You are translating as a Japanese native speaker. When I provide text, please:
            1. Translate it into natural Japanese
            2. Provide the Japanese text in its standard written form (using the appropriate mix of hiragana, katakana, and kanji as a native speaker would)
            3. Include the romanization (romaji) of the Japanese text
            4. Provide an English explanation of the meaning and any cultural context

        ";
    }

}

$agent = JPTranslation::make();
$response = $agent->chat(
    new UserMessage("You are so stupid.")
);

echo $response->getContent();