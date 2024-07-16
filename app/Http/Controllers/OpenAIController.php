<?php
namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Generate text using OpenAI's GPT-4 model
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function generate(Request $request) : JsonResponse
    {
        $prompt = $request->input('prompt', 'Escribe algo aquí...');
        $generatedText = $this->openAIService->generateText($prompt);

        return $generatedText->getJsonResponse();
    }
}
