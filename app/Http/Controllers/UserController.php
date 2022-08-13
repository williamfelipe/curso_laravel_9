<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        //dd('UserController@index');
        $users = User::get();
        //dd($users);
        return view('users.index',compact('users'));
    }

    public function show($id){
        
        //$user = User::where('id',$id)->first();
        if(!$user  = User::find($id)){
        //return redirect()->back();
            return redirect()->route('users.index');
        }else{
            return view('users.show',compact('user'));
        }
        
        //dd($user);
        //dd('users.show', $id);
        //return view('users.index');
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return redirect()->route('users.index');
        //return redirect()->route('users.show', $user->id);
        //Jeitos diferentes de se fazer
        //dd($request->all());
        /*
        dd($request->only([
            'name','email','password'
        ]
        ));
        */
        /*
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        */
        //dd('cadastrar');
        //return view('users.create');
    }

    public function edit($id){
        if(!$user  = User::find($id)){
            return redirect()->route('users.index');
        }else{
            return view('users.edit',compact('user'));
        }
    }

    public function update(Request $request, $id){
        if(!$user  = User::find($id)){
            return redirect()->route('users.index');
        }else{
            /*
            $user->name = $request->name;
            $user->save();
            */
            $data = $request->only('name','email');
            if($request->password)
            {
                $data['password'] = bcrypt($request->password);
            }
            $user->update($data);
            return redirect()->route('users.index');
            //dd($request->all());
        }
    }
    public function delete($id)
    {
        if(!$user  = User::find($id)){
            return redirect()->route('users.index');
        }else{
            $user->delete();
            return redirect()->route('users.index');
        }
    }
}
