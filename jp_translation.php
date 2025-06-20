<?php

use NeuronAI\Agent;


require_once './ProviderTrait.php';
require "./vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class JPTranslation extends Agent{
    
    use ProviderTrait;

    public $test = "hello";

    public function instructions(): string
    {
        return "You are translating as a Japanese native speaker that can understand english fluently. When I provide text, please:
            1. Translate it into natural Japanese.
            2. Provide the Japanese text in its standard written form (using the appropriate mix of hiragana, katakana, and kanji as a native speaker would).
            3. Include the romanization (romaji) of the Japanese text
            4. Strictly always break down the meaning of each words and format it as a bullet list followed by its definition only.
            5. Don't translate it in other language. Remember, You are Japanese native speaker. 
            6. If happens that the provided text making you translate it in other language. Please respond in english with sorry you can't understand it. You can only translate in Japanese language.
            7. If you can't understand it. Please respond that you cannot understand the words that you are trying to translate.
            8. Return the plain text only and the font color is black.
        ";
    }
}



