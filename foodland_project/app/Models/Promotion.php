<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    public  function getAllPromotion($filters = '')
    {
        if($filters!='' and $filters!='All')
        {
            if($filters=='Available'){
                $promotions = DB::table($this->table)
                    ->select('promotion.*')
                    ->where('promotion.DateEnd','>=',Carbon::today())
                    ->paginate(10);
            }
            else if($filters=='Expired') {
                $promotions = DB::table($this->table)
                    ->select('promotion.*')
                    ->where('promotion.DateEnd','<',Carbon::today())
                    ->paginate(10);
            }
            return $promotions;
        }
        else {
            $promotions = DB::table($this->table)
                ->select('promotion.*')
                ->paginate(10);
            return $promotions;
        }

    }
    public function getAllPromotionBySearch($filters,$search_string)
    {
        if($filters!='' and $filters!='All')
        {
            if($filters=='Available'){
                $promotions = DB::table($this->table)
                    ->select('promotion.*')
                    ->where('promotion.DateEnd','>=',Carbon::today())
                    ->where(function ($query) use ($search_string) {
                        $query->where('CODE', 'like', '%' . $search_string . '%')
                            ->orWhere('Group', 'like', '%' . $search_string . '%');
                    })
                    ->paginate(10);
            }
            else if($filters=='Expired') {
                $promotions = DB::table($this->table)
                    ->select('promotion.*')
                    ->where('promotion.DateEnd','<',Carbon::today())
                    ->where(function ($query) use ($search_string) {
                        $query->where('CODE', 'like', '%' . $search_string . '%')
                            ->orWhere('Group', 'like', '%' . $search_string . '%');
                    })
                    ->paginate(10);
            }
            return $promotions;
        }
        else {
            $promotions = DB::table($this->table)
                ->select('promotion.*')
                ->where(function ($query) use ($search_string) {
                    $query->where('CODE', 'like', '%' . $search_string . '%')
                        ->orWhere('Group', 'like', '%' . $search_string . '%');
                })
                ->paginate(10);
            return $promotions;
        }
    }
}
