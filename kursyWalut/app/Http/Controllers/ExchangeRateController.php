<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $exchangeRates = ExchangeRate::where('date', $date)->get();
        return response()->json($exchangeRates);
    }

    public function show(Request $request, $currency)
    {
        $date = $request->input('date', date('Y-m-d'));
        $exchangeRate = ExchangeRate::where('date', $date)->where('currency', $currency)->first();
        return response()->json($exchangeRate);
    }

    public function store(Request $request)
    {
        $exchangeRate = ExchangeRate::create([
            'currency' => $request->input('currency'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount')
        ]);

        return response()->json($exchangeRate);
    }
}
