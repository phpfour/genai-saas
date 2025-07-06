<?php

namespace App\Http\Controllers;

use App\Structures\SeoContentStructure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenAI;

class SeoContentController extends Controller
{
    public function create(Request $request)
    {
        $apiKey = config('services.openai.api_key');
        $client = OpenAI::client($apiKey);

        $topic = $request->input('topic');
        $prompt = $this->generatePrompt($topic);

        $result = $client->chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $response = $result->choices[0]->message->content;

        return new Response($response);
    }

    private function generatePrompt(string $topic): string
    {
        $structure = (new SeoContentStructure())->generate();

        return <<<TEXT

            You are an expert in SEO and content marketing for online education platforms.
            Generate SEO-focused content for the course: $topic.

            Ensure the following structure is maintained. Replace the placeholders with the actual content:

            $structure

            Format the response as a JSON. Keep it as raw JSON and don't add ```json markups.

            If the response is limited by token, ensure the final JSON response is valid.
        TEXT;
    }
}
