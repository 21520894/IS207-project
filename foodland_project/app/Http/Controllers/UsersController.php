<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\DateTime;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request)
    {
        //User page

        $filters = '';
        if(!empty($request->account_type) and $request->account_type!='All'){
            $filters = $request->account_type;
            $filters = ($filters=='Admin')?'1':'0';
        }
        $users = $this->user->getAllUsers($filters);
        return view('admin.user.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id)->getAttributes();
        //dd($user);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'up_name' => 'required',Rule::unique('products')->ignore($request->up_id),
        ],[
            'up_name.required' => 'Name is required',
            'up_name.unique' => 'Name already exists'
        ]);
        User::where('id', $request->up_id)->update([
            'name' => $request->up_name,
           'role' => $request->up_role
        ]);
        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        User::where('id',$ids)->delete();
        return response()->json(['status'=>'success']);
    }

    public function pagination(Request $request)
    {
        $filters = '';
        if(!empty($request->account_type) and $request->account_type!='All'){
            $filters = $request->account_type;
            $filters = ($filters=='Admin')?'1':'0';
        }
        $users = $this->user->getAllUsers($filters);
        return view('admin.user.pagination', compact('users'))->render();
    }
    public function search(Request $request)
    {
        $filters = '';
        if(!empty($request->account_type) and $request->account_type!='All'){
            $filters = $request->account_type;
            $filters = ($filters=='Admin')?'1':'0';
        }
        $users = $this->user->getUsersBySearch($filters,$request->search_string);
        if($users->count()>=1){
            return view('admin.user.pagination',compact('users'))->render();
        }
        else{
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function showUserByGroup(Request $request){
        $filters = '';
        if(!empty($request->account_type) and $request->account_type!='All'){
            $filters = $request->account_type;
            $filters = ($filters=='Admin')?'1':'0';
        }
        $users = $this->user->getAllUsers($filters);
        return view('admin.user.pagination',compact('users'))->render();
    }

}
