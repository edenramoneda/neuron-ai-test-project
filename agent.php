<?php

use NeuronAI\Agent;
use NeuronAI\Chat\Messages\UserMessage;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Gemini\Gemini;
use NeuronAI\Providers\Ollama\Ollama;

require "./vendor/autoload.php";

class MyAgent extends Agent{
    
    public function provider(): AIProviderInterface {
        return new Gemini(
            key: "AIzaSyD4HS_vmcD55clFW7ccM3LJsHvd-D91zFE",
            model: "gemini-2.5-flash"
        );
    }

    public function instructions(): string
    {
        return "Please correct the grammar based on the user input.";
    }

}

$agent = MyAgent::make();
$response = $agent->chat(
    new UserMessage("Hi!")
);

echo $response->getContent();