<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $q = Question::create([
            'question' => 'You’re really busy at work and a colleague is telling you their life story and personal woes. You:',
        ]);

        $q->answers()->create(['answer' => 'Don’t dare to interrupt them', 'rank' => 1]);
        $q->answers()->create(['answer' => 'Think it’s more important to give them some of your time; work can wait', 'rank' => 2]);
        $q->answers()->create(['answer' => 'Listen, but with only with half an ear', 'rank' => 3]);
        $q->answers()->create(['answer' => 'Interrupt and explain that you are really busy at the moment', 'rank' => 4]);
       
        $q = Question::create([
            'question' => 'You’ve been sitting in the doctor’s waiting room for more than 25 minutes. You:',
        ]);

        $q->answers()->create(['answer' => 'Look at your watch every two minutes', 'rank' => 1]);
        $q->answers()->create(['answer' => 'Bubble with inner anger, but keep quiet', 'rank' => 2]);
        $q->answers()->create(['answer' => 'Explain to other equally impatient people in the room that the doctor is always running late', 'rank' => 3]);
        $q->answers()->create(['answer' => 'Complain in a loud voice, while tapping your foot impatiently', 'rank' => 4]);
       
        $q = Question::create([
            'question' => 'You’re having an animated discussion with a colleague regarding a project that you’re in charge of. You:',
        ]);

        $q->answers()->create(['answer' => 'Don’t dare contradict them', 'rank' => 1]);
        $q->answers()->create(['answer' => 'Think that they are obviously right', 'rank' => 2]);
        $q->answers()->create(['answer' => 'Defend your own point of view, tooth and nail', 'rank' => 3]);
        $q->answers()->create(['answer' => 'Continuously interrupt your colleague', 'rank' => 4]);
       
        $q = Question::create([
            'question' => 'You are taking part in a guided tour of a museum. You:',
        ]);

        $q->answers()->create(['answer' => 'Are a bit too far towards the back so don’t really hear what the guide is saying', 'rank' => 1]);
        $q->answers()->create(['answer' => 'Follow the group without question', 'rank' => 2]);
        $q->answers()->create(['answer' => 'Make sure that everyone is able to hear properly', 'rank' => 3]);
        $q->answers()->create(['answer' => 'Are right up the front, adding your own comments in a loud voice', 'rank' => 4]);
       
    }
}
