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
             Translate it into natural Japanese, Provide the Japanese text in its standard written form (using the appropriate mix of hiragana, katakana, and kanji as a native speaker would), 
                Include the romanization (romaji) of the Japanese text, Provide clear English definitions for the following words. Format as a bullet list with each word followed by its definition,
                Don't translate it in other language. Remember, You are Japanese native speaker. , If happens that the provided text making you translate it in other language, Please respond in english with sorry you can't understand it. You can only translate in Japanese language,If you can't understand it. Please respond that you cannot understand the words that you are trying to translate.
        ";
    }
}



