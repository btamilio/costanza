<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Poem;
use App\Clients\HTTP\OpenAI;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Actions\Poem\GeneratePrompt;

use Illuminate\Support\Str;

class GeneratePoem implements ShouldQueue //, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Poem $poem) {

    }

    public function handle() {


        $this->poem->refresh();

        $this->poem->prompt = $this->poem->prompt ?? (new GeneratePrompt())->execute($this->poem);
        $this->poem->save();

        $response = json_decode((new OpenAI())->getChatCompletion([[
                "role"    => "user",
                "content" => $this->poem->prompt,
                "temperature" => 0.7  
            ]]), true) ?? NULL;

 
        if (empty($response)) {
            $this->poem->flag_response = TRUE; 
        
        } else {

            // Use JSON_PARTIAL_OUTPUT_ON_ERROR to handle slightly malformed JSON from OpenAI
            $poem = simplexml_load_string($response["choices"][0]["message"]["content"]) ?? "";

            $this->poem->title        = $poem->title ?? NULL;
            $this->poem->response     = json_encode($response) ?? NULL;
            $this->poem->lineation    = $poem->lineation ?? NULL;   
            $this->poem->authors_note = $poem->{'authors-note'} ?? NULL;

            // run the output through moderation just in case.
            if (!empty($response->choices[0]->refusal) || (new OpenAI())->getModerationStatus($this->poem->lineation))
                $this->poem->flag_content = TRUE;
            
        }


        $this->poem->save();
    }
}

