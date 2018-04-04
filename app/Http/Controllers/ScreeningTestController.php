<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScreeningTest;
use App\Question;
use App\Choice;
use App\QuestionChoice;
use DB;
use Illuminate\Support\Facades\Input;
use Log;

class ScreeningTestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = ScreeningTest::all();

        return view('tests.index', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($name)
    {
        $test = new ScreeningTest;
        $test->name = $name;

        $test->save();

        return response()->json([
            'message' => 'Screening Test Created',
            'last_insert_id' => $test->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataRows = DB::table('screening_tests')
                    ->join('questions', 'screening_tests.id', '=', 'questions.screening_test_id')
                    ->join('question_choices', 'questions.id', '=', 'question_choices.question_id')
                    ->join('choices', 'question_choices.choice_id', '=', 'choices.id')
                    ->join('languages', 'questions.language_id', '=', 'languages.id')
                    ->where('screening_tests.id', '=', $id)
                    ->select('questions.id as QID', 'question', 'type', 
                            'choices.id as CID', 'choice', 'marks', 
                            'languages.name', 
                            'screening_tests.id as test_id',
                            'screening_tests.name as test_name')
                    ->get();

        if ($dataRows->count() != 0){
            $test = (object) [
                'id' => $dataRows->first()->test_id,
                'name' => $dataRows->first()->test_name
            ];
        }
        else{
            $test = ScreeningTest::where('id', $id)->first();
        }

        $questions = $dataRows->map(function ($item) {
            return [
                'id' => $item->QID,
                'question' => $item->question,
                'type' => $item->type,
                'name' => $item->name
            ];
        })->unique();

        $english_questions = $questions->where('name', 'English');
        $malay_questions = $questions->where('name', 'Malay');

        $choices = $dataRows->map(function ($item) {
            return [
                'id' => $item->CID,
                'choice' => $item->choice,
                'marks' => $item->marks,
                'name' => $item->name
            ];
        })->unique();

        $english_choices = $choices->where('name', 'English');
        $malay_choices = $choices->where('name', 'Malay');

        return view('tests.edit', compact('english_questions', 'malay_questions', 'english_choices', 'malay_choices', 'test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $test = ScreeningTest::find($id);
            $test->name = Input::get('name');
            
            $test->save();
            
            return "Screening Test Name Changed Successfully";

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = ScreeningTest::find($id);
            $user->delete();

            return "Screening Test Deleted";

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function toggle($id)
    {
        try {
            $test = ScreeningTest::find($id);
            $test->active = !$test->active;
            
            $test->save();
            
            if ($test->active == true)
                return "Activated ".$test->name ;
            else
                return "Deactivated ".$test->name;

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function store_question($id)
    {
        $question = new Question;
        
        $question->question = Input::get('question');
        $question->type = Input::get('type');
        $question->screening_test_id = $id;
        $question->language_id = Input::get('language_id');

        $question->save();

        $choices = Choice::select('id')->where('language_id', '=', $question->language_id)->get();

        if ($choices->count() != 0){
            $data = null;

            foreach ($choices as $choice){
                $data[] = [
                    'question_id' => $question->id,
                    'choice_id' => $choice->id,
                    'created_at' => $question->created_at,
                    'updated_at' => $question->updated_at
                ];
            }

            QuestionChoice::insert($data);
        }

        return response()->json([
            'message' => 'Question Added',
            'last_insert_id' => $question->id
        ]);
    }

    public function update_question($id)
    {
        try {
            $question = Question::find(Input::get('question_id'));

            $question->question = Input::get('question');
            $question->type = Input::get('type');

            $question->save(); 

            return 'Question Updated';

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function store_choice($id)
    {
        $choice = new Choice;
        
        $choice->choice = Input::get('choice');
        $choice->marks = Input::get('marks');
        $choice->language_id = Input::get('language_id');

        $choice->save();

        $questions = Question::select('id')->where('language_id', '=', $choice->language_id)->get();

        if ($questions->count() != 0){
            $data = null;

            foreach ($questions as $question){
                $data[] = [
                    'question_id' => $question->id,
                    'choice_id' => $choice->id,
                    'created_at' => $choice->created_at,
                    'updated_at' => $choice->updated_at
                ];
            }

            QuestionChoice::insert($data);
        }

        return response()->json([
            'message' => 'Answer Added',
            'last_insert_id' => $choice->id
        ]);
    }

    public function update_choice($id)
    {
        try {
            $choice = Choice::find(Input::get('choice_id'));

            $choice->choice = Input::get('choice');
            $choice->marks = Input::get('marks');

            $choice->save(); 

            return 'Choice Updated';

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function destroy_question($id)
    {
        try {
            $question = Question::find(Input::get('data_id'));
            $question->delete();

            DB::table('question_choices')->where('question_id', '=', Input::get('data_id'))->delete();

            return "Question Deleted";

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function destroy_choice($id)
    {
        try {
            $choice = Choice::find(Input::get('data_id'));
            $choice->delete();

            DB::table('question_choices')->where('choice_id', '=', Input::get('data_id'))->delete();

            return "Answer Deleted";

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function getExceptionMessage(){
        return "Whoops, something went wrong.";
    }
}