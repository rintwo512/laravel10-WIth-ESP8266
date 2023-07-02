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
        $inputText = $request->input('input');
        $result = OpenAI::completions()->create([
            'max_tokens' => 100,
            'model' => 'text-davinci-003',
            'prompt' => $inputText
        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn (string $result, array $choice) => $result . $choice['text'],
            ""
        );

        return $response;
    }

}
