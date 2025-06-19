<?php

use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Gemini\Gemini;


trait ProviderTrait {

    public function provider(): AIProviderInterface {
        return new Gemini(
            key: $_ENV['AI_API_KEY'],
            model: "gemini-2.5-flash"
        );
    }

}