<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $path = storage_path(). "/app/items.json";

        if (File::exists($path))
            $items = json_decode(file_get_contents($path), true); 
        else
            $items = [];

        $totalSum = 0;

        foreach($items as $key => $item){
            $items[$key]['total_value_number'] = $item['quantity_in_stock'] * $item['price_per_item'];
            $totalSum += $items[$key]['total_value_number'];
        }
        //Start Collection
        $items = collect($items)->sortBy('date_submitted')->values()->all();
        

        return view('coalition',compact('items','totalSum'));
    }

    /**
     * Store items
     */
    public function store(Request $request)
    {
        $path = storage_path(). "/app/items.json";

        if (File::exists($path))
            $items = json_decode(file_get_contents($path), true); 
        else
            $items = [];

        $productName = $request->product_name;
        $quantityInStock = $request->quantity;
        $pricePerItem = $request->price;
        $dateSubmitted = date('Y-m-d H:i:s');

        $data = [
            "product_name" => $productName,
            "quantity_in_stock" => $quantityInStock,
            "price_per_item" => $pricePerItem,
            "date_submitted" => $dateSubmitted
        ];

        array_push($items, $data);

        $contents = json_encode($items);

        Storage::put('items.json', $contents);

        return back()->with('message','Items added Successfully');
    }
}
