<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{

    public function index(){

        $jsonFile = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json'),true) : [];

        usort($jsonFile, function ($item1, $item2) {
            return $item2['date_added'] <=> $item1['date_added'];
        });
        $sum = 0;
        foreach($jsonFile as $item){

            $sum += $item['quantity']*$item['price'];

        }

        return view('form')->with('data', $jsonFile)->with('sum',$sum);
    }

    public function addProduct(Request $request){

        $jsonFile = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json'),true) : [];


        $data = $request->validate([
            'product_name' => 'required|max:100',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $data['date_added'] = Carbon::now();

        $jsonFile[] = $data;

        Storage::disk('local')->put('data.json', json_encode($jsonFile,JSON_PRETTY_PRINT));

        $request->session()->flash('status', 'Added new product!');

        return redirect('/form')->with('status', 'Added new product!');
    }

}
