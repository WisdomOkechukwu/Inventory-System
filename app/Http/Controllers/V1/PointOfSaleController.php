<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Livewire\PointOfSale;
use App\Models\Product;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    public function index(){
        $reference = '';
        return view('v1.pos', compact('reference'));
    }
}
