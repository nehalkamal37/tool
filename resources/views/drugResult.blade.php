<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2, h3, h5 {
            color: #343a40;
        }
        table th, table td {
            vertical-align: middle;
        }
        .btn-back {
            margin-bottom: 20px;
        }
        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Search Results</h2>
    @if($data->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            No insurance data available for <strong>{{ $request->drug_name }}</strong> with NDC <strong>{{ $request->ndc }}</strong>.
        </div>
    @endif
    <a href="{{ route('searchPage') }}" class="btn btn-secondary btn-back">Go Back</a>
    
    <!-- Table for Main Search Results -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
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
        
                            <td>{{ $request->drug_name }}</td>
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


    
        
    <!-- Alternatives Section -->
   

    @if(isset($script) && $script->isNotEmpty())
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

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
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
                                <td>{{ $i->Drug_Name }}</td>
                                <td style="white-space: nowrap;">
                                 

                                    <a href="https://ndclist.com/ndc/{{ $i->NDC }}" target="_blank">
                                        {{ $i->NDC }}
                                    </a>
                                </td>
                                
                                <td>{{ $i->Ins }}</td>
                                <td>{{ $i->Script }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $i->Date)->format('m/d/Y') }}</td>
                                <td>{{ $i->RxCui }}</td>
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
        <h3 class="mt-5">Alternative Drugs (Without Insurance)</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
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
                                <td>{{ $drug->drug_class }}</td>
                                <td>{{ $drug->drug_name }}</td>
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
</body>
</html>



