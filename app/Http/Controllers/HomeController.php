<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormValidationRequest;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){

        return view("index");
    }


    public function getExternalData(){

        $response = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
    }

    public function submitForm(FormValidationRequest $request)
    {
        $enteredCompanySymbol = $request->input('company_symbol');

        $historicalData = $this->fetchHistoricalData($enteredCompanySymbol);

        if (empty($historicalData)) {
            return redirect()->back()->with('error', 'No historical data found for the Company Symbol.');
        }

    $externalData = $this->getExternalData();
    $matchingCompany = collect($externalData)->first(function ($item) use ($enteredCompanySymbol) {
        return $item['Symbol'] === $enteredCompanySymbol;
    });

    return view('result', ['matchingCompany' => $matchingCompany, 'historicalData' => $historicalData]);
    }

    private function fetchHistoricalData($companySymbol)
    {
        $headers = [
            'X-RapidAPI-Key' => '8be355d39bmshb79f195369c6209p19dd30jsnf883bfff1fd3',
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
        ];

        $params = [
            'symbol' => $companySymbol,
        ];

        $response = Http::withHeaders($headers)->get('https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data', $params);

        if ($response->successful()) {
            return $response->json()['prices'];
        }
        return [];
    }
}