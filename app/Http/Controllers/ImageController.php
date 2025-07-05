<?php

namespace App\Http\Controllers;

use App\Structures\CourseStructure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenAI;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $apiKey = config('services.openai.api_key');
        $client = OpenAI::client($apiKey);

        $topic = $request->input('topic');
        $prompt = $this->generatePrompt($topic);

        $result = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => $prompt,
            'n' => 1,
            'size' => '1024x1024',
            'response_format' => 'url',
        ]);

        $response = $result->data[0]->url;

        return new Response($response);
    }

    private function generatePrompt(string $topic): string
    {
        return <<<TEXT
            Course cover image for "$topic". Portray a mac laptop with VS Code IDE
            open in dark theme with a browser window in the background running
            multiple processes. Keep space in the upper part for adding overlay
            of course title.
        TEXT;
    }
}
