<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4"></h2>

    <form action="{{route('search')}}" method="POST">
        @csrf
        <input type="hidden" name="drug_name" value="{{$normalizedDrugName}}">
        <input type="hidden" name="ndc" value="{{$normalizedNDC}}">
        <input type="hidden" name="insurance" value="{{$normalizedInsurance}}">
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
                    <td>{{ $script->NDC }}</td>
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
                    <td>{{ $script->ndc }}</td>
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
    
   
    <p> {{ $scriptData->count()==1 ? 'No alternatives found for the provided inputs.' :'' }}
        </p>


