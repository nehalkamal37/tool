



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('searchresult/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('searchresult/css/owl.carousel.min.css')}}">
    <link rel="stylesheet"  href="{{ asset('searchBar/css/styleee.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('searchresult/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('searchresult/css/style.css')}}">

    <title>Search Result</title>
  </head>
  <body>
  


  <!-- my data -->
  
  <div class="container mt-4" style="margin-bottom: px;">
    <h1 class="mb-0 text-center" >Search Results for "{{$request->drug_name}}"</h1>
    <!-- Table for Main Search Results -->

    <div class="content">
        <a href="{{ route('searchPage')}}" class="btn btn-light">Go Back</a>

        <div class="container">
    
          <div class="table-responsive">
    
            <table class="table custom-table">
              <thead>
                <tr>
                    @if($data && count($data) > 0)
                        <th>Drug Name</th>
                        <th>Ins Results</th>
                        <th>NDC Results</th>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Script</th>
                        <th>Net Profit</th>
                        <th>ACQ</th>
                        <th>QTY</th>
                        <th>INS PAY</th>
                        <th>pat_pay</th>
        
                    @elseif(isset($drug_data) && count($drug_data) > 0)
                        <th>Drug Name</th>
                        <th>NDC</th>               
                     <th>Class</th>
                        <th>Form</th>
                        <th>Strength</th>
                        <th>Manufacturer</th>
                        <th>Acquisition Cost</th>
                    @else
                        <th colspan="5" class="text-center">No Data Available</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($data && count($data) > 0)
                    @foreach ($data as $item)
                        <tr>
        
                            <td>
                                <form action="{{ route('search') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="drug_name" value="{{ $request->drug_name }}">
                                    <input type="hidden" name="ndc" value="{{ $request->ndc }}">
                                    <button type="submit" style="all: unset; cursor: pointer; color: inherit; text-decoration: underline;">
                                        {{ $request->drug_name }}
                                    </button>
                                </form>
                            </td>
                            <td>{{ $request->insurance }}</td>
                            <td>
                                <a href="https://ndclist.com/ndc/{{ $item->NDC }}" 
                                   target="_blank" 
                                   class="ndc-link" 
                                   data-ndc="{{ $item->NDC }}">
                                    {{ $item->NDC }}
                                </a>
                            </td>
                            
                            <td>{{ $class }}</td>
                            <td>
                                {{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->Date)->format('m/d/Y')}}</td>                    <td>{{ $item->Script }}</td>
                                
                                <td>{{ $item->Net_profit }}</td>
                            <td>{{ $item->ACQ }}</td>
                            <td>{{ $item->Qty }}</td>
                            <td>{{ $item->Ins_Pay }}</td>
                            <td>{{ $item->Pat_Pay }}</td>
        
        
                        </tr>
                    @endforeach
                @elseif(isset($drug_data) && count($drug_data) > 0)
                    @foreach ($drug_data as $item)
                        <tr>
                            <td>{{ $request->drug_name }}</td>
                           
                            <td style="white-space: nowrap;">
                                    
                                @php
                                    // Remove hyphens from the NDC
                                    $ndcWithoutHyphens = str_replace('-', '', $item->ndc); // e.g., 70156-0111-18 -> 70156011118
                                    $mainNdc = substr($ndcWithoutHyphens, 0, 9); // Extract first 9 digits for the main NDC
                                    $fullNdc = $ndcWithoutHyphens; // Use the full NDC for the package
                                @endphp
                                <a 
                                href="https://ndclist.com/ndc/{{ $fullNdc }}"
                                target="_blank">
                                    {{ $fullNdc }}
                                </a>
                            
                        </td>
                                                
                                    
                            
                            <td>{{ $item->drug_class }}</td>
                            <td>{{ $item->form }}</td>
                            <td>{{ $item->strength }}</td>
                            <td>{{ $item->mfg }}</td>
                            <td>{{ $item->acq }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No Data Available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
        </div>
    
<form id="filterForm2" method="post"  action="{{ route('search') }}">
    @csrf
    <input type="hidden" name="drug_name" value="{{ $request->drug_name }}">
    <input type="hidden" name="ndc" value="{{ $request->ndc ?? '' }}">

    <label for="ins"><h5>Insurances related to Drug:</h5></label>
    <select  name="insurance" id="ins" class="form-select" 
    onchange="document.getElementById('filterForm2').submit();"
      onchange="this.form.submit()">
        <option value="">-- Select --</option>
        @foreach ($insurances as $ins)
            <option value="{{ $ins }}" {{ request('insurance') == $ins ? 'selected' : '' }}>
                {{ $ins }}
            </option>
        @endforeach
    </select>
</form>

    <style>
            
            #filterForm2 { 
            margin-top: 20px;
            margin-left: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
          /*  background: white;*/
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
           /* padding: 20px 30px;  */
            max-width: 600px;
            width: 100%;
        }
        #filterForm  { 
            margin-top: 20px;
            margin-left: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
          /*  background: white;*/
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
           /* padding: 20px 30px;  */
            max-width: 600px;
            width: 100%;
        }
        #filterForm h5 {
            font-size: 1.2rem;
            margin-bottom: 1px;
            color: #333;
        }
        #filterForm select {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        #filterForm select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>



    <!-- Alternatives Section -->
   



<div class="content">
    
    
    <h3 class="mt-5">Alternative Drugs (With Insurance)</h3>
    <p>Found {{ $script->count()  }} alternatives in the same class.</p>
    <form id="filterForm" method="post" action="{{ route('searchDrug') }}">
        @csrf
        <input type="hidden" name="drug_name" value="{{ $request->drug_name }}">
        <input type="hidden" name="ndc" value="{{ $request->ndc }}">
        <input type="hidden" name="insurance" value="{{ $request->insurance }}">
    
        <label for="sort_by">Sort Alternatives By:</label>
        <select name="sort_by" id="sort_by" class="form-select" onchange="this.form.submit()">
            <option value="">-- Select --</option>
            <option value="net_profit_desc" {{ request('sort_by') === 'net_profit_desc' ? 'selected' : '' }}>
                Highest Net Profit
            </option>
           <option value="awp_asc" {{ request('sort_by') === 'awp_asc' ? 'selected' : '' }}>
                Lowest AWP
            </option>
            
        </select>
    </form>
    @if(isset($script) && $script->isNotEmpty())

    <div class="container">

      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
            <tr>
                        <th>Class</th>
                        <th>Drug Name</th>
                        <th>NDC</th>
                        <th>Insurance</th>
                        <th>Script</th>
                        <th>Date</th>
                        <th>RxCUI</th>
                        <th>Net Profit</th>
                        <th>ACQ</th>
                        <th>QTY</th>
                        <th>Insurance Pay</th>
                        <th>Patient Pay</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($script as $i)
                        @if($i->Drug_Name !== $request->drug_name || $i->NDC !== $request->ndc || $i->Ins !== $request->insurance)
                            <tr>
                                <td>{{ $i->Class }}</td>
                                <td>
                                    <form action="{{ route('search') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="drug_name" value="{{ $i->Drug_Name }}">
                                        <input type="hidden" name="ndc" value="{{ $i->NDC }}">
                                        <input type="hidden" name="insurance" value="{{ $i->Ins }}">
                                        <button type="submit" style="all: unset; cursor: pointer; color: inherit; text-decoration: underline;">
                                            {{ $i->Drug_Name }}
                                        </button>
                                    </form>
                                </td>
                                
                                <td style="white-space: nowrap;">
                                 

                                    <a href="https://ndclist.com/ndc/{{ $i->NDC }}" target="_blank">
                                        {{ $i->NDC }}
                                    </a>
                                </td>
                                
                                <td>{{ $i->Ins }}</td>
                                <td>{{ $i->Script }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $i->Date)->format('m/d/Y') }}</td>
                                <td>{{ $i->RxCUI }}</td>
                                <td>{{ $i->Net_profit }}</td>
                                <td>{{ $i->ACQ }}</td>
                                <td>{{ $i->Qty }}</td>
                                <td>{{ $i->Ins_Pay }}</td>
                                <td>{{ $i->Pat_Pay }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>

            </table>
        </div>
    @endif

    <!-- Table for Alternatives Without Insurance -->
    @if(isset($drugs) && $drugs->isNotEmpty())
        <div class="content">
            <h3 class="mt-5">Alternative Drugs (Without Insurance)</h3>

            <div class="container">
        
              <div class="table-responsive">
        
                <table class="table custom-table">
                  <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Drug Name</th>
                        <th>NDC</th>
                        <th>Form</th>
                        <th>Strength</th>
                        <th>AWP</th>
                        <th>Manufacturer</th>
                        <th>RxCUI</th>
                        <th>Acquisition Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drugs as $drug)
                        @if($drug->drug_name !== $request->drug_name || $drug->ndc !== $request->ndc)
                            <tr>
                               
                              
                                
                                <td style="font-size: 1rem">{{ $drug->drug_class }}</td>                              
                                <td>
                                    <form action="{{ route('search') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="drug_name" value="{{ $drug->drug_name }}">
                                        <input type="hidden" name="ndc" value="{{ $drug->ndc }}">
                                        <button type="submit" style="all: unset; cursor: pointer; color: inherit; text-decoration: underline;">
                                            {{ $drug->drug_name }}
                                        </button>
                                    </form>
                                </td>
                                
                              
                                <td style="white-space: nowrap;">
                                    
                                        @php
                                            // Remove hyphens from the NDC
                                            $ndcWithoutHyphens = str_replace('-', '', $drug->ndc); // e.g., 70156-0111-18 -> 70156011118
                                            $mainNdc = substr($ndcWithoutHyphens, 0, 9); // Extract first 9 digits for the main NDC
                                            $fullNdc = $ndcWithoutHyphens; // Use the full NDC for the package
                                        @endphp
                                        <a 
                                        href="https://ndclist.com/ndc/{{ $fullNdc }}"
                                        target="_blank">
                                            {{ $fullNdc }}
                                        </a>
                                    
                                    
                                    
                                </td>
                                <td>{{ $drug->form }}</td>
                                <td>{{ $drug->strength }}</td>
                                <td>{{ $drug->awp }}</td>
                                <td>{{ $drug->mfg }}</td>
                                <td>{{ $drug->rxCUI }}</td>
                                <td>{{ $drug->acq }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>