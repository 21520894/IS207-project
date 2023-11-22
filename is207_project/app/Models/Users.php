<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Users extends Model
{
    use HasFactory;

    public function getAllCustomers()
    {
        $customers = DB::select('SELECT * FROM users');
        return $customers;
    }
    public function getAllAdmins()
    {
        $admins = DB::select('SELECT * FROM admin');
        return $admins;
    }
}
