<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $psychologists = User::where('user_level', 1)->get();

        return view('users.index', compact('psychologists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->user_level = 1;

        $user->save();

        return redirect('/users')->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $psychologist = User::findOrFail($id);

        return view('users.edit', compact('psychologist'));
    }

    public function dashboard_edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $new_rules = $this->getRules();
        $new_rules['email'] = [ 'required',
                                'string',
                                'email',
                                'max:255',
                                Rule::unique('users')->ignore($user->email, 'email')];

        $this->validate($request, $new_rules);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();
        
        return redirect('/users')->with('success', 'User Updated');
    }

    public function dashboard_update(Request $request, $id)
    {
        $user = User::find($id);

        $new_rules = $this->getRules();
        $new_rules['email'] = [ 'required',
                                'string',
                                'email',
                                'max:255',
                                Rule::unique('users')->ignore($user->email, 'email')];
        $new_rules['password'] = '';

        $this->validate($request, $new_rules);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('changePassword')){
            $this->validate($request, [
                'password' => 'required|string|min:6|correctPassword:'.$user->password,
                'new-password' => 'required|string|min:6|confirmed'
            ]);

            $user->password = Hash::make($request->input('new-password'));
        }

        $user->save();

        return redirect('/dashboard/'. $user->id)->with('user', $user)->with('success', 'Information Updated');
    }

    /**
     * Update a part of the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id)
    {
        try {
            $user = User::find($id);
            $user->active = !$user->active;
            
            $user->save();
            
            if ($user->active == true)
                return "Activated ".$user->name;
            else
                return "Deactivated ".$user->name;

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return text
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return "User Deleted";

        } catch ( Exception $ex ) {
            return $this->getExceptionMessage();
        }
    }

    public function getRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
    }

    public function getExceptionMessage(){
        return "Whoops, something went wrong.";
    }
}
