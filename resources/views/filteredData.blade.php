<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
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
<body>
<div class="container mt-5">
    <h2 class="mb-4"></h2>

    <form action="{{route('search')}}" method="POST">
        @csrf
        <input type="hidden" name="drug_name" value="{{$drugname}}">
        <input type="hidden" name="ndc" value="{{$ndc}}">
        <input type="hidden" name="insurance" value="{{$ins}}">
    <button type="submit"> Go Back</button>

    </form>
    
    <h3>Alternative Drugs due to {{ $sortBy }}    </h3>
    <p>Found {{ $scriptData->count() }} .</p>

    <table class="table table-striped">
        <thead>
            @if($sortBy === 'net_profit_desc')
            <tr>
                <th>Class Name</th>
                <th>Drug Name</th>
                <th>Drug NDC</th>
                <th>Insurance</th>
                <th>Script</th>
                <th>Date</th>
                <th>RxCui</th>
                <th>Net Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scriptData as $script)
                <tr>
                    <td>{{ $script->Class }}</td>
                    <td>{{ $script->Drug_Name }}</td>
                    <td>
                        <a href="https://ndclist.com/ndc/{{ $script->NDC }}" 
                           target="_blank" 
                           class="ndc-link" 
                           data-ndc="{{ $script->NDC }}">
                            {{ $script->NDC }}
                        </a>
                    </td>
                    <td>{{ $script->Ins }}</td>
                    <td>{{ $script->Script }}</td>
                    <td>
                        {{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $script->Date)->format('m/d/Y')}}                    </td>
                    <td>{{ $script->RxCui }}</td>
                    <td>{{ $script->Net_profit }}</td>
                </tr>

                
            @endforeach
            @endif
        </tbody>
    </table>
    
    <table class="table table-striped">
        <thead>
            @if($sortBy == 'awp_asc')
            <tr>
                <th>Class Name</th>
                <th>Drug Name</th>
                <th>Drug NDC</th>
                <th>form</th>
                <th>awp</th>
                <th>strength</th>
                <th>RxCui</th>
                <th>acq</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($scriptData as $script)
                <tr>
                    <td>{{ $script->drug_class }}</td>
                    <td>{{ $script->drug_name }}</td>
                    <td style="white-space: nowrap;">
                                    
                        @php
                            // Remove hyphens from the NDC
                            $ndcWithoutHyphens = str_replace('-', '', $script->ndc); // e.g., 70156-0111-18 -> 70156011118
                            $mainNdc = substr($ndcWithoutHyphens, 0, 9); // Extract first 9 digits for the main NDC
                            $fullNdc = $ndcWithoutHyphens; // Use the full NDC for the package
                        @endphp
                        <a 
                        href="https://ndclist.com/ndc/{{ $fullNdc }}"
                        target="_blank">
                            {{ $fullNdc }}
                        </a>
                    
                </td>
                    <td>{{ $script->form }}</td>
                    <td>{{ $script->awp }}</td>
                    <td>{{ $script->strength }}</td>
                    <td>{{ $script->rxCUI }}</td>
                    <td>{{ $script->acq }}</td>

                </tr>

                
            @endforeach
            @endif
        </tbody>
    </table>
    
   
    <p> {{ $scriptData->count()== 0 ? 'No alternatives found for the provided inputs.' :'' }}
        </p>


