<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->promotions = new Promotion();
    }
    public function index(Request $request)
    {
        $filter = '';
        if (!empty($request->voucher_group)) {
            $filter = $request->voucher_group;
        }
        $promotions = $this->promotions->getAllPromotion($filter);
        return view('admin.ecommerce.promotion', compact('promotions'));
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
        $request->validate([
            'voucher-type' => 'required',
            'voucher-value' => 'required',
            'voucher-code' => 'required|unique:promotion,CODE',
            'voucher-start-date' => 'required|date',
            'voucher-end-date' => 'required|date|after:voucher-start-date',
            'voucher-constraint' => 'required',
            'voucher-quantity' => 'required'
        ],[
            'voucher-code.unique' => 'This CODE already exists!'
        ]);
        $new_promotion = new Promotion();
        $new_promotion->Group = $request->input('voucher-type');
        $new_promotion->CODE = $request->input('voucher-code');
        $new_promotion->Value = $request->input('voucher-value');
        $new_promotion->DateEnd = $request->input('voucher-end-date');
        $new_promotion->DateStart = $request->input('voucher-start-date');
        $new_promotion->Quantity = $request->input('voucher-quantity');
        $new_promotion->Constraint = $request->input('voucher-constraint');
        $new_promotion->save();
        return response()->json(['status'=>'success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $ids = $request->ids;
        Promotion::where('PromotionID', $ids)->delete();
        return response()->json(['status' => 'success']);
    }
    public function pagination(Request $request)
    {
        $filter = '';
        if (!empty($request->voucher_group)) {
            $filter = $request->voucher_group;
        }
        $promotions = $this->promotions->getAllPromotion($filter);
        return view('admin.ecommerce.promotion_pagination', compact('promotions'))->render();
    }
    public function search(Request $request)
    {
        $promotion = new Promotion();
        $filter = '';
        if(!empty($request->voucher_group)) {
            $filter = $request->voucher_group;
        }
        $promotions = $promotion->getAllPromotionBySearch($filter, $request->search_string);
        if ($promotions->count() >= 1) {
            return view('admin.ecommerce.promotion_pagination', compact('promotions'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
}
