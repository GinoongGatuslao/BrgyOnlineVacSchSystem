<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Feedback extends Component
{
    public $showFeedback = true;
    public $feedbacks = false;
    public $showThankYou = false;
    public $rating = 1;
    public function render()
    {
        //check if user has already submitted feedback
        $feedback = \App\Models\Feedback::where('user_id', auth()->user()->id)->get()->count();
        if ($feedback <= 0) {
            $this->showFeedback = true;
        } else {
            $this->showFeedback = false;
        }
        return view('livewire.components.feedback');
    }

    //store feedback rating
    public function storeFeedback($rating)
    {
        $feedback = new \App\Models\Feedback();
        $feedback->user_id = auth()->user()->id;
        $feedback->rating = $rating;
        $feedback->save();
        $this->showFeedback = false;
        $this->showThankYou = true;
        $this->rating = $rating;
        $this->render();
    }
    

}
