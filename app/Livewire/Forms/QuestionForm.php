<?php

namespace App\Livewire\Forms;

use App\Models\LessonQuestion;
use App\Models\LessonQuestionChoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class QuestionForm extends Component
{
    use WithPagination;

    public $id;

    public $module_id, $lesson_id, $type;

    public $question, $correct, $points;

    public $choice_a, $choice_b, $choice_c, $choice_d;

    public $openForm = false;
    public $to_delete_id;


    public $type_arr = [
        'Multiple Choice' => 'MC',
        'Identification' => 'I',
        'Essay' => 'E',
        'Hands-On' => 'HO'
    ];

    public function toggleForm()
    {
        $this->openForm = !$this->openForm;

        if ($this->openForm == false) {
            $this->clear();
        }
    }

    public function mount($module_id, $lesson_id, $type)
    {
        $this->module_id = $module_id;
        $this->lesson_id = $lesson_id;
        $this->type = $type;
    }

    public function clear()
    {
        $this->question = '';
        $this->points = '';
        $this->correct = '';
        $this->choice_a = '';
        $this->choice_b = '';
        $this->choice_c = '';
        $this->choice_d = '';
        $this->id = NULL;
        $this->openForm = false;
    }

    public function submit()
    {

    
        switch ($this->type) {
            case 'Multiple Choice':
                $this->validate([
                    'question' => 'required|max:1000|string',
                    'choice_a' => 'required|max:500|string',
                    'choice_b' => 'required|max:500|string',
                    'choice_c' => 'required|max:500|string',
                    'choice_d' => 'required|max:500|string',
                    'correct' => 'required|string', // Ensure only A, B, C, or D are allowed
                    'points' => 'required|integer|min:1|max:10', // Add min validation for points
                ]);

                try {
                    if ($this->correct == 'A') {
                        $this->correct = $this->choice_a;
                    } elseif ($this->correct == 'B') {
                        $this->correct = $this->choice_b;
                    } elseif ($this->correct == 'C') {
                        $this->correct = $this->choice_c;
                    } elseif ($this->correct == 'D') {
                        $this->correct = $this->choice_d;
                    }

                    if (!$this->id) {
                        // Creating a new question
                        DB::beginTransaction();

                        $question = LessonQuestion::create([
                            'module_id' => $this->module_id,
                            'lesson_id' => $this->lesson_id,
                            'question' => $this->question,
                            'correct' => $this->correct,
                            'points' => $this->points,
                            'type' => 'MC'
                        ]);

                        // Creating choices
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_a', 'value' => $this->choice_a]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_b', 'value' => $this->choice_b]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_c', 'value' => $this->choice_c]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_d', 'value' => $this->choice_d]);

                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been saved',
                            'status' => 'success'
                        ]);
                    } else {
                        // Updating an existing question
                        DB::beginTransaction();

                        $question = LessonQuestion::find($this->id);
                        $question->question = $this->question;
                        $question->correct = $this->correct;  // Fix: Correct field should be updated, not the question
                        $question->points = $this->points;
                        $question->save();

                        // Remove old choices and insert updated ones
                        LessonQuestionChoice::where('question_id', $this->id)->delete();
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_a', 'value' => $this->choice_a]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_b', 'value' => $this->choice_b]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_c', 'value' => $this->choice_c]);
                        LessonQuestionChoice::create(['question_id' => $question->id, 'key' => 'choice_d', 'value' => $this->choice_d]);

                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been updated',
                            'status' => 'success'
                        ]);
                    }

                    $this->clear();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                    $this->dispatch('error', [
                        'title' => 'Error',
                        'message' => $th->getMessage(),
                        'status' => 'error'
                    ]);
                }
                break;

            case 'Identification':
                $this->validate([
                    'question' => 'required|max:1000|string',
                    'correct' => 'required|string|max:1000',
                    'points' => 'required|integer|min:1|max:10', // Add min validation for points
                ]);

                try {


                    if (!$this->id) {
                        // Creating a new question
                        DB::beginTransaction();

                        $question = LessonQuestion::create([
                            'module_id' => $this->module_id,
                            'lesson_id' => $this->lesson_id,
                            'question' => $this->question,
                            'correct' => $this->correct,
                            'points' => $this->points,
                            'type' => 'I'
                        ]);


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been saved',
                            'status' => 'success'
                        ]);
                    } else {
                        // Updating an existing question
                        DB::beginTransaction();

                        $question = LessonQuestion::find($this->id);
                        $question->question = $this->question;
                        $question->correct = $this->correct;  // Fix: Correct field should be updated, not the question
                        $question->points = $this->points;
                        $question->save();


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been updated',
                            'status' => 'success'
                        ]);
                    }

                    $this->clear();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                    $this->dispatch('error', [
                        'title' => 'Error',
                        'message' => $th->getMessage(),
                        'status' => 'error'
                    ]);
                }

                break;

            case 'Essay':
                $this->validate([
                    'question' => 'required|max:1000|string',
                    'points' => 'required|integer|min:1|max:50', // Add min validation for points
                ]);

                try {


                    if (!$this->id) {
                        // Creating a new question
                        DB::beginTransaction();

                        $question = LessonQuestion::create([
                            'module_id' => $this->module_id,
                            'lesson_id' => $this->lesson_id,
                            'question' => $this->question,
                            'correct' => $this->correct,
                            'points' => $this->points,
                            'type' => 'E'
                        ]);


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been saved',
                            'status' => 'success'
                        ]);
                    } else {
                        // Updating an existing question
                        DB::beginTransaction();

                        $question = LessonQuestion::find($this->id);
                        $question->question = $this->question;
                        $question->correct = $this->correct;  // Fix: Correct field should be updated, not the question
                        $question->points = $this->points;
                        $question->save();


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been updated',
                            'status' => 'success'
                        ]);
                    }

                    $this->clear();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                    $this->dispatch('error', [
                        'title' => 'Error',
                        'message' => $th->getMessage(),
                        'status' => 'error'
                    ]);
                }

                break;

            case 'Hands-On':
                $this->validate([
                    'question' => 'required|max:1000|string',
                    'points' => 'required|integer|min:1|max:50', // Add min validation for points
                ]);

                try {


                    if (!$this->id) {
                        // Creating a new question
                        DB::beginTransaction();

                        $question = LessonQuestion::create([
                            'module_id' => $this->module_id,
                            'lesson_id' => $this->lesson_id,
                            'question' => $this->question,
                            'correct' => $this->correct,
                            'points' => $this->points,
                            'type' => 'HO'
                        ]);


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been saved',
                            'status' => 'success'
                        ]);
                    } else {
                        // Updating an existing question
                        DB::beginTransaction();

                        $question = LessonQuestion::find($this->id);
                        $question->question = $this->question;
                        $question->correct = $this->correct;  // Fix: Correct field should be updated, not the question
                        $question->points = $this->points;
                        $question->save();


                        DB::commit();

                        $this->dispatch('success', [
                            'title' => 'Success',
                            'message' => 'Question has been updated',
                            'status' => 'success'
                        ]);
                    }

                    $this->clear();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                    $this->dispatch('error', [
                        'title' => 'Error',
                        'message' => $th->getMessage(),
                        'status' => 'error'
                    ]);
                }

                break;
        }
    }

    #[On('edit_question')]
    public function edit_question($id, $type)
    {
        $this->id = $id;
        $this->openForm = true;
        $question = LessonQuestion::where('type', $type)->find($this->id);

        $this->question = $question->question;
        $this->correct = $question->correct;

        if ($this->type == 'Multiple Choice') {
            $correct = LessonQuestionChoice::where([
                'question_id' => $this->id,
                'value' => $question->correct
            ])->first()['key'];

            if ($correct == 'choice_a') {
                $this->correct = 'A';
            }
            if ($correct == 'choice_b') {
                $this->correct = 'B';
            }
            if ($correct == 'choice_c') {
                $this->correct = 'C';
            }
            if ($correct == 'choice_d') {
                $this->correct = 'D';
            }

            $this->choice_a =  $correct = LessonQuestionChoice::where([
                'question_id' => $this->id,
                'key' => 'choice_a'
            ])->first()['value'];

            $this->choice_b =  $correct = LessonQuestionChoice::where([
                'question_id' => $this->id,
                'key' => 'choice_b'
            ])->first()['value'];

            $this->choice_c =  $correct = LessonQuestionChoice::where([
                'question_id' => $this->id,
                'key' => 'choice_c'
            ])->first()['value'];

            $this->choice_d =  $correct = LessonQuestionChoice::where([
                'question_id' => $this->id,
                'key' => 'choice_d'
            ])->first()['value'];
        }


        $this->points = $question->points;
    }




    public function deleteItem($id)
    {
        try {
            DB::beginTransaction();

            LessonQuestion::find($id)->delete();

            DB::commit();

            $this->dispatch('success', [
                'title' => 'Success',
                'message' => 'Question has been Deleted',
                'status' => 'success'
            ]);

            $this->clear();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            $this->dispatch('error', [
                'title' => 'Error',
                'message' => $th->getMessage(),
                'status' => 'error'
            ]);
            $this->clear();
        }

        $this->dispatch('close_modal');
    }

    public function render()
    {

        $questions = LessonQuestion::where([
            'module_id' => $this->module_id,
            'lesson_id' => $this->lesson_id,
            'type' => $this->type_arr[$this->type]
        ])->orderBy('created_at', 'desc')->get();

        $total_points = 0;
        foreach ($questions as $item) {
            $total_points += $item->points;
        }
        return view('livewire.forms.question-form', compact('questions', 'total_points'));
    }
}
