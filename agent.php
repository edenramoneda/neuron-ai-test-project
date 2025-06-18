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

    // public function instructions(): string
    // {
    //     return "You are a Linkedin post creator. 
    //         Your role is to analyze the text in input and create an amazing and engaging Linkedin post.
    //         Return the text only, Not the instruction.
    //     ";
    // }

}

$agent = MyAgent::make();
$response = $agent->chat(
    new UserMessage("Hi!")
);

echo $response->getContent();