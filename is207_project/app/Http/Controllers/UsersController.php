<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Users;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $users;
    public function __construct()
    {
        $this->users = new Users;
    }

    public function index()
    {
        //User page
        $customersList = $this->users->getAllCustomers();
        $adminsList = $this->users->getAllAdmins();
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
    public function edit(string $id)
    {
        //
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
