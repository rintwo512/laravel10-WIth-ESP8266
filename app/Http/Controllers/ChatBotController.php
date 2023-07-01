<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatBot.index', [
            'title' => 'Chat Bot'
        ]);
    }

    public function sendChat(Request $request)
    {
        $result = OpenAI::completions()->create([
            'max_tokens' => 2048,
            'model' => 'text-davinci-003',
            'prompt' => $request->input
        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn (string $result, array $choice) => $result . $choice['text'],
            ""
        );

        return $response;
    }

    public function sendChat2(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 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',
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
            'max_tokens' => 2048,
            'prompt' => 'siapa kamu',
        ]);

        $responseData = $response->json();




        // Access the desired data from the response
        $chatbotResponse = $responseData['choices'][0]['text'];
        dd($chatbotResponse);
    }
}
