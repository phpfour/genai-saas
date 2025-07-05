<?php

namespace App\Http\Controllers;

use App\Structures\CourseStructure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenAI;

class CourseController extends Controller
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
                // ['role' => 'system', 'content' => '']
                ['role' => 'user', 'content' => $prompt],
            ],
            // 'max_tokens' => 500
        ]);

        $response = $result->choices[0]->message->content;

        return new Response($result);
    }

    private function generatePrompt(string $topic): string
    {
        $structure = (new CourseStructure())->generate();

        return <<<TEXT

            You are a 10-years expeirenced Laravel Developer and have long history as an educator.
            Generate a course on: $topic.

            Ensure the following structure is maintained. Replace the placeholders with the actual content:

            $structure

            Format the response as a JSON. Keep it as raw JSON and don't add ```json markups.

            If the response is limited by token, ensure the final JSON response is valid.
        TEXT;
    }
}
