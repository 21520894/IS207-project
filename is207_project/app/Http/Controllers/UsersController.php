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
    private $customers;
    private $admins;
    public function __construct()
    {
        $this->customers = new User();
        $this->admins = new Admin();
    }

    public function index()
    {
        //User page
        $customersList = $this->customers->all();
        $adminsList = $this->admins->all();
        return view('admin.user.show', compact('customersList','adminsList'));
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
//        $user = $request->user()->getAttributes();
//        $user['created_at'] = explode(' ',$user['created_at']);
        $id = $request->query('id');
        $user = User::find($id)->getAttributes();
        $type = 'Customer';
        return view('admin.user.edit', compact('user','type'));
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
