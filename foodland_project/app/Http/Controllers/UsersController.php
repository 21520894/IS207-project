<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Models\Users;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
