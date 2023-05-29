<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request){
        
        //$users = User::where('name','LIKE',"%{$request->name}%")->toSql();
        //$users = User::where('name','LIKE',"%{$request->search}%")->get();
        $users = $this->model->getUsers(search: $request->search ?? '');
        //dd($users);
        return view('users.index',compact('users'));
    }

    public function show($id){
        
        //$user = User::where('id',$id)->first();
        if(!$user  = $this->model->find($id)){
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
        
        $user = $this->model->create($data);
        return redirect()->route('users.index');
        //dd($data);
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
        if(!$user  = $this->model->find($id)){
            return redirect()->route('users.index');
        }else{
            return view('users.edit',compact('user'));
        }
    }

    public function update(StoreUpdateUserFormRequest $request, $id){
        if(!$user  = $this->model->find($id)){
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
        if(!$user  = $this->model->find($id)){
            return redirect()->route('users.index');
        }else{
            $user->delete();
            return redirect()->route('users.index');
        }
    }
}
