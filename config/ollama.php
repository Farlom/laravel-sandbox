<?php

return [
    'base_url' => env('OLLAMA_HOST', '0.0.0.0'),
    'port' => env('OLLAMA_PORT', 11434),
    'model' => env('OLLAMA_MODEL', 'gemma3:1b'),
];
