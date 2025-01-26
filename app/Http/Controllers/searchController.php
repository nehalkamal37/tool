<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Script;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function index(Request $r){

        $drugname=Drug::get();
        
        foreach($drugname as $d){

         $name=($d->drug_name);
        
          $ins=Script::where('Drug_Name', $name)->get();
          $ndc=Script::select('NDC')->where('Drug_Name',$name)->get();
      //  dd($ndc);
         //    foreach($ins as $i){

         return view('search',compact('drugname','ins','ndc'));

        }
          


        




    }
 

    
    public function getDependentData(Request $request)
    {
        $drugName = $request->input('drug_name');
    
        // Fetch related data for the second and third dropdowns
        $ins = Script::where('Drug_Name', $drugName)->pluck('Ins', 'id'); // Adjust columns as needed
        $ndc = Script::where('Drug_Name', $drugName)->pluck('NDC', 'id'); // Adjust columns as needed
    
        return response()->json([
            'ins' => $ins,
            'ndc' => $ndc,
        ]);
    }
    

    public function searchStabeOne(Request $request)
    {

        $normalizedNDC = str_replace('-', '', $request->ndc);

      // getting data for our choosen drug from select options with latest date
$data= Script::where('Drug_Name', $request->drug_name)
->where('Ins', $request->insurance)
->where('NDC', $normalizedNDC)
->distinct()
->get()
->groupBy(function ($item) {
      return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
  })
  ->map(function ($group) {
      return $group->sortBy('Date')->first();
  }); 

      //  getting class from script DB if not there then get it from drugs DB
      $class = Script::where('Drug_Name', $request->drug_name)
              ->where('Ins', $request->insurance)
           //  ->where('NDC', str_replace('-', '', $request->ndc))
              // ->where('NDC', $request->ndc)
              ->distinct()
              ->pluck('Class')
              ->first();
$classs=Drug::where('drug_name', $request->drug_name)
->where('ndc', $request->ndc)
->distinct()
->pluck('drug_class')
->first();
$class = trim($classs); // Remove any leading/trailing whitespace, including \r and \n

    //  dd($class);
     
    
      // getting alternatives depending on class with latest date
      $script=Script::where('Class',$class)
      ->where('Ins',$request->insurance)
      ->where('NDC','!=',$normalizedNDC)
      ->distinct()
      ->get()
      ->groupBy(function ($item) {
            return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
        })
        ->map(function ($group) {
            return $group->sortBy('Date')->first();
        });
    
           // if drug was not found in script DB then search for it in drugs DB  //orrrrr
          //if drug is not dound in script DB then search in DRugs data
      if(($script->isEmpty() ) || $data->isEmpty() ){
        $drug_data= Drug::where('drug_name', $request->drug_name)
        ->where('ndc', $request->ndc)
        ->distinct()
        ->get(); 

        $drugs=Drug::where('drug_name',$request->drug_name)->get();
      //  dd($drug_data);

        return view('drugResult', compact('data','drug_data','request','script','class','drugs'));

      }
     
      return view('drugResult', compact('data','drug_data','request','script','class','drugs'));

    }
//oldddddddd
   
 

// filter displayed data basedOn (awp or netprofit)
public function searchDrug(Request $request)
{
    // Normalize inputs
    $normalizedDrugName = trim($request->input('drug_name'));
    $normalizedNDC = str_replace('-', '', trim($request->input('ndc')));
    $normalizedInsurance = trim($request->input('insurance'));
  
    $drugname=$request->drug_name;
    $ndc=$request->ndc;
    $ins=$request->insurance;
   
    $class = Script::where('Drug_Name', $request->drug_name)
              ->where('Ins', $request->insurance)
              ->distinct()
              ->pluck('Class')
              ->first();

$dclass=Drug::where('drug_name', $request->drug_name)
//->where('ndc', $request->ndc)     
->distinct()     
->pluck('drug_class')    
->first();               

    // Base query for Scripts
    $scriptQuery = Script::where('Class', $class)
      //  ->where('NDC',$normalizedNDC)
        ->where('Ins', $normalizedInsurance)
        ->distinct()
        ->get()
->groupBy(function ($item) {
      return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
  })
  ->map(function ($group) {
      return $group->sortByDesc('Date')->first();
  }); 


    // Apply sorting
    if ($request->has('sort_by')) {
        $sortBy = $request->input('sort_by');
        if ($sortBy === 'net_profit_desc') {
            $scriptQuery = $scriptQuery->sortByDesc(function ($item) {
                return $item->Net_profit;   
            });

        } elseif ($sortBy === 'awp_asc') {
            $scriptQuery = Drug::where('drug_class', $dclass)
    ->orWhere('ndc', $request->ndc)
    ->select('drug_class', 'drug_name', 'ndc', 'form', 'strength', 'rxCUI','awp', 'mfg', 'rxcui', 'acq') // Specify columns
    ->distinct()
    ->orderBy('awp', 'asc')
    ->get();
        
        }
    }

    // Return the results to the view
    return view('filteredData', [
        'scriptData'=>$scriptQuery,
        //'scriptData' => $scriptData,
        'normalizedDrugName' => $normalizedDrugName ?? $drugname,
        'normalizedNDC' => $normalizedNDC ,
        'normalizedInsurance' => $normalizedInsurance ?? $ins, 
        'sortBy' => $request->input('sort_by'),
        'ndc'=>$ndc,
        'ins'=>$ins,
        'drugname'=>$drugname,
    ]);
}


//oldddddddd





public function search(Request $request)
{
    $normalizedNDC = $request->ndc ? str_replace('-', '', $request->ndc) : null;

    // If no NDC and no insurance is provided
    if (!$normalizedNDC && !$request->insurance) {
        // Fetch all data related to the drug name from `drugs` table
        $drugData = Drug::where('drug_name', $request->drug_name)
            ->distinct()
            ->get();
            $dataFromDrugs = Drug::where('drug_name', $request->drug_name)
            ->distinct()
            ->get();

        $class2 = Drug::where('drug_name', $request->drug_name)
            ->pluck('drug_class')
            ->first();


       
    $alternativesFromDrugs = Drug::where('drug_class', $class2)
    ->where('drug_name', '!=', $request->drug_name)
    ->select('drug_class', 'drug_name', 'ndc', 'form', 'strength', 'rxCUI','acq','awp', 'mfg', 'rxcui') // Exclude 'id' or other columns you don't care about
    ->distinct()
    ->get();

   //insurances related to the chosen drug
    $insurances = Script::where('Drug_Name', $request->drug_name)
    ->distinct()
    ->pluck('Ins')
    ->all();

        return view('drugResult', [
            'data' => collect(),
            'drug_data' => $drugData,
            'request' => $request,
            'script' => collect(),
            'class' => $class2,
            'drugs' => (trim($class2) == 'Other' || trim($class2) == 'Other NDC') ? collect() : $alternativesFromDrugs,
             'insurances' => $insurances,
        ]);
    }

    // If NDC is not provided
    if (!$normalizedNDC) {
        // Step 1: Fetch all data from `scripts` based on `Drug_Name` and `Insurance`
        $dataFromScripts = Script::where('Drug_Name', $request->drug_name)
            ->where('Ins', $request->insurance)
            ->distinct()
            ->get()
            ->groupBy(function ($item) {
                return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
            })
            ->map(function ($group) {
                return $group->sortByDesc(function ($item) {
                    return strtotime($item['Date']);
                })->first();
            });

        $dataFromDrugs = Drug::where('drug_name', $request->drug_name)
            ->distinct()
            ->get();

        $class = Script::where('Drug_Name', $request->drug_name)
            ->where('Ins', $request->insurance)
            ->pluck('Class')
            ->first();

        $class = trim($class);

        $class2 = Drug::where('drug_name', $request->drug_name)
            ->pluck('drug_class')
            ->first();

        $alternativesFromScripts = Script::where('Class', $class)
            ->where('Ins', $request->insurance)
            ->where('NDC', '!=', $normalizedNDC)
           // ->where('Drug_Name', '!=', $request->drug_name)  
         // ->select('Drug_Name', 'Ins', 'NDC', 'Date', 'Class', 'Net_profit', 'RxCUI') // Exclude 'id' or other columns you don't care about
            ->distinct()
            ->get()
            ->groupBy(function ($item) {
                return $item['Drug_Name'] . '-' . $item['Ins'];
            })
            ->map(function ($group) {
                return $group->sortByDesc('Date')->first();
            });

            $alternativesFromDrugs = Drug::where('drug_class', $class2)
            ->select('drug_class', 'drug_name', 'ndc', 'form', 'strength', 'rxCUI','acq','awp', 'mfg') // Exclude 'id' or other columns you don't care about
            ->distinct()
            ->get();


             //insurances related to the chosen drug
    $insurances = Script::where('Drug_Name', $request->drug_name)
    ->distinct()
    ->pluck('Ins')
    ->all();

            return view('drugResult', [
            'data' => $dataFromScripts,
            'request' => $request,
            'script' => (trim($class) == 'Other' || trim($class) == 'Other NDC') ? collect() : $alternativesFromScripts,
            'class' => $class,
            'drugs' => (trim($class2) == 'Other' || trim($class2) == 'Other NDC' || trim($class) == 'Other') ? collect() : $alternativesFromDrugs,
            'insurances' => $insurances,]);
    }

    // If NDC is provided
    $selectedDrugData = Script::where('Drug_Name', $request->drug_name)
        ->where('NDC', $normalizedNDC)
        ->where('Ins', $request->insurance)
        ->distinct()
        ->get()
        ->groupBy(function ($item) {
            return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
        })
        ->map(function ($group) {
            return $group->sortByDesc(function ($item) {
                return strtotime($item['Date']);
            })->first();
        });

    $class = Script::where('Drug_Name', $request->drug_name)
        ->where('Ins', $request->insurance)
        ->pluck('Class')
        ->first();

    if (!$class) {
        $class = Drug::where('drug_name', $request->drug_name)
            ->where('ndc', $normalizedNDC)
            ->pluck('drug_class')
            ->first();
    }

    $class = trim($class);

    $class2 = Drug::where('drug_name', $request->drug_name)
        ->pluck('drug_class')
        ->first();

    $alternativesFromScripts = Script::where('Class', $class)
        ->where('Ins', $request->insurance)
        ->where('NDC', '!=', $normalizedNDC)
        ->where('Drug_Name', '!=', $request->drug_name)
        ->distinct()
        ->get()
        ->groupBy(function ($item) {
            return $item['Drug_Name'] . '-' . $item['Ins'] . '-' . $item['NDC'];
        })
        ->map(function ($group) {
            return $group->sortByDesc('Date')->first();
        });

    $alternativesFromDrugs = Drug::where('drug_class', $class2)
    ->select('drug_class', 'drug_name', 'ndc', 'form', 'strength','rxCUI', 'acq','awp', 'mfg', 'rxcui') // Exclude 'id' or other columns you don't care about
    ->distinct()
    ->get();

       $drugData = Drug::where('drug_name', $request->drug_name)
        ->Where('ndc', $request->ndc)
        ->select('drug_class', 'drug_name', 'ndc', 'form', 'strength','rxCUI', 'acq','awp', 'mfg', 'rxcui') // Exclude 'id' or other columns you don't care about
        ->distinct()
        ->get();

         //insurances related to the chosen drug
    $insurances = Script::where('Drug_Name', $request->drug_name)
    ->distinct()
    ->pluck('Ins')
    ->all();

    return view('drugResult', [
        'data' => $selectedDrugData,
        'drug_data' => $drugData,
        'request' => $request,
        'script' => (trim($class) == 'Other' || trim($class) == 'Other NDC') ? collect() : $alternativesFromScripts,
        'class' => $class,
        'drugs' => (trim($class2) == 'Other' || trim($class2) == 'Other NDC' || trim($class) == 'Other' ) ? collect() : $alternativesFromDrugs,
  'insurances' => $insurances,
    ]);
}




}
