<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\AppHelper;
use App\User;
use App\ScreeningTest;
use App\ScreeningTestTaken;
use App\DiaryEntry;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use DB;
use Log;

class ApiController extends Controller
{
    public function login(Request $request) {
        $user = User::where('email', $request->input('email'))->get()->first();

        if($user) {
            if($user->active == false) {
                $data = [
                    'status' => 'fail',
                    'message' => 'Your account has been deactivated. Please contact administrator for assistance.'
                ];
            }
            else if(Hash::check($request->input('password'), $user->password)) {
                $data = [
                    'status' => 'success',
                    'data' => $user
                ];
            }
            else {
                $data = [
                    'status' => 'fail',
                    'message' => 'Incorrect password.'
                ];
            }
        }
        else {
            $data = [
                'status' => 'fail',
                'message' => 'User does not exist.'
            ];
        }

        return response()->json($data);
    }

    public function logout(Request $request) {
        $user = User::where('api_token', $request->input('api_token'))->get()->first();
        if($user) {
            $user->api_token = null;
            $user->save();
            $data = [
                'status' => 'success'
            ];
        }
        else {
            $data = [
                'status' => 'invalid',
                'message' => 'Invalid session.'
            ];
        }
        return response()->json($data);
    }

    public function checkUniqueEmail(Request $request) {
        //check for unique email
        $userByEmail = User::where('email', $request->input('email'))->get()->first();
        if($userByEmail) {
            $data = [
                'status' => 'fail',
                'message' => 'This email is already taken. Please use another email.'
            ];
        }
        else {
            $data = [
                'status' => 'success',
                'message' => 'This email can be used.'
            ];
        }

        return response()->json($data);
    }

    public function register(Request $request) {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->birth_date = $request->input('birth_date');
        $user->gender = $request->input('gender');
        $user->zipcode = $request->input('zipcode');
        $user->occupation = $request->input('occupation');
        $user->education_level = $request->input('education_level');

        $user->save();

        //get the newly created user
        $insertedUser = User::where('email', $request->input('email'))->get()->first();

        $data = [
            'status' => 'success',
            'data' => $insertedUser
        ];

        return response()->json($data);
    }

    public function getQsAndChoice(Request $request){
        $dataRows = DB::table('questions')
                    ->join('question_choices', 'questions.id', '=', 'question_choices.question_id')
                    ->join('choices', 'question_choices.choice_id', '=', 'choices.id')
                    ->join('languages', 'questions.language_id', '=', 'languages.id')
                    ->where([
                        ['questions.screening_test_id', '=', $request->input('test_id')],
                        ['questions.language_id', '=', $request->input('language_id')]
                    ])
                    ->select('questions.id as QID', 'question', 'type', 
                            'choices.id as CID', 'choice', 'marks', 
                            'languages.name', 
                            'questions.updated_at as question_updated_date',
                            'choices.updated_at as choice_updated_date')
                    ->get();

        $questions = $dataRows->map(function ($item) {
            return [
                'id' => $item->QID,
                'question' => $item->question,
                'type' => $item->type,
                'name' => $item->name,
                'updated_date' => $item->question_updated_date
            ];
        })->unique()->values();

        $choices = $dataRows->map(function ($item) {
            return [
                'id' => $item->CID,
                'choice' => $item->choice,
                'marks' => $item->marks,
                'name' => $item->name,
                'updated_date' => $item->choice_updated_date
            ];
        })->unique()->values();

        if ($questions->count() != 0 && $choices->count() != 0)
            return response()->json([
                'status' => 'success',
                'questions' => $questions,
                'choices' => $choices
            ]);
        else
            return response().json([
                'status' => 'fail',
                'message' => 'There is no question or choice in this screening test.'
            ]);
    }

    public function getScreeningTest(){
        $active_tests = ScreeningTest::where('active', 1)->get();

        if ($active_tests->count() != 0)
            return response()->json([
                'status' => 'success',
                'data' => $active_tests
            ]);
        else
            return response()->json([
                'status' => 'fail',
                'message' => 'There is no screening test.'
            ]);
    }

    public function saveScreeningTest(Request $request) {
        ScreeningTestTaken::insert($request->all());

        return response()->json(['status' => 'success']);
    }

    public function getTestsTaken(Request $request) {
        $testsTaken = ScreeningTestTaken::where('user_id', $request->input('user_id'))->get();

        if ($testsTaken->count() != 0)
            return response()->json([
                'status' => 'success',
                'data' => $testsTaken,
            ]);
        else
            return response().json([
                'status' => 'fail',
                'message' => 'There is no previous screening test.'
            ]);
    }

    public function getDiaryEntries(Request $request) {
        $diaryEntries = DiaryEntry::where('user_id', $request->input('user_id'))->get();

        if ($diaryEntries->count() != 0)
            return response()->json([
                'status' => 'success',
                'data' => $diaryEntries,
            ]);
        else
            return response().json([
                'status' => 'fail',
                'message' => 'There is no entry in diary.'
            ]);
    }

    public function saveDiaryEntries(Request $request) {
        DiaryEntry::insert($request->all());

        return response()->json(['status' => 'success']);
    }
}
