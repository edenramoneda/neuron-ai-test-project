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
        return "You are a grammar expert, Please correct the grammar with explanation based on the user input. 
            Return only the text.";
    }

}

$agent = MyAgent::make();
$response = $agent->chat(
    new UserMessage("Who are them?")
);

echo $response->getContent();