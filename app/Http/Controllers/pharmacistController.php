<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class pharmacistController extends Controller
{
    //
    public function index(){

        $drugs=Drug::all();
       // dd($drugs);
        return view('dashboard.dashboard',compact('drugs'));
    }

    public function fetchNdcData(Request $request)
{
    $ndc = $request->ndc;
    $url = "https://ndclist.com/ndc/$ndc";

    // Use GuzzleHttp to make the request
    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->get($url);
        $content = $response->getBody()->getContents();

        return response()->json([
            'success' => true,
            'data' => $content
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch NDC data.'
        ], 500);
    }
}

}
