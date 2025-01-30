<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"  href="{{ asset('searchBar/css/styleee.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="colorlib.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
        <link href="{{asset('searchPage/css/main.css')}}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">


  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
SIGN IN  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{asset('auth/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0')}}" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('auth/assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
              PHARMACY
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('welcome')}}">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
Home                  </a>

                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{route('about')}}">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    About
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{route('contact')}}">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Contact
                  </a>
                </li>
               
                <li class="nav-item">
                    @auth
                        @if(auth()->user()->role == 'pharmacist')
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <a class="nav-link text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt opacity-6 text-dark me-1"></i> Logout
                                </a>
                            </form>
                        @else
                            <a class="nav-link text-dark" href="{{ route('dash') }}">
                                <i class="fas fa-tachometer-alt opacity-6 text-dark me-1"></i> Dashboard
                            </a>
                        @endif
                    @endauth
                    @guest
                        <a class="nav-link text-dark" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt opacity-6 text-dark me-1"></i> Login
                        </a>
                    @endguest
                </li>
              </ul>
            
             
            </div>
           
           
          </div>

        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100"
    style="background-image: url('{{ asset('searchBar/images/bg1.jpg') }}');" >
      
     <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mx-auto" style="margin-top: 22px">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1" style="margin-top: 111px; height: 77px">
                  <h3 class="text-white font-weight-bolder text-center mt-2 mb-0"> 
                    CDI Medication Guiding Tool 
                  </h3>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>

                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body" style="margin-top: 11px">
                  
      
          
            
            <form id="searchForm"  method="post" action="{{ route('search')}}" class="d-flex flex-column align-items-center">
                @csrf
        
                <div class="mb-3 w-100">
                    <label for="drugName" class="form-label"><h6> Drug Name :</h6></label>
                    <select id="drugName" name="drug_name" class="form-select select2">
                        <option value="">-- Select Drug Name --</option>
                        @foreach($drugNames as $drugName)
                            <option value="{{ $drugName }}">{{ $drugName }}</option>
                        @endforeach
                    </select>
                </div>
                
               
                <div class="mb-3 w-100">
                    <label for="insurance" class="form-label"><h6>Insurance:</h6></label>
                    <select id="insurance" name="insurance" class="form-select">
                        <option value="">-- Select Insurance --</option>
                    </select>
                </div>
            
                <div class="mb-3 w-100">
                    <label for="ndc" class="form-label"><h6>NDC:</h6></label>
                    <select id="ndc" name="ndc" class="form-select">
                        <option value="">-- Select NDC --</option>
                      
                    </select>
                    <a href="#" id="submitNdcLink" class="btn btn-light w-100">related NDCs info</a>
                </div>
        
                <button type="submit" class="btn btn-primary w-100">Search Drug</button>
            
                 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      
        
<!-- to Display NDCs -->
<script>
    $(document).ready(function () {
        $('#submitNdcLink').on('click', function (e) {
            e.preventDefault(); // Prevent default link behavior
    
            const selectedNdc = $('#ndc').val(); // Get the selected NDC value
    
            if (selectedNdc) {
                const url = `/process-ndc?ndc=${encodeURIComponent(selectedNdc)}`; // Construct the GET URL
                console.log('Redirecting to:', url);
    
                // Redirect to the constructed URL
                window.location.href = url;
            } else {
                alert('Please select an NDC before submitting.');
            }
        });
    });
    </script>
    
    
    
    
    <script>
        $(document).ready(function () {
            // Initialize Select2 for drugName
            $('#drugName').select2({
                placeholder: "-- Select Drug Name --",
                allowClear: true
            });
    
            // Mapping for insurance short names to full names
            const insuranceMapping = {
                'AL': 'Aetna (AL)',
                'BW': 'Aetna (BW)',
                'AD': 'Aetna Medicare (AD)',
                'AF': 'Anthem BCBS (AF)',
                'DS': 'Blue Cross Blue Shield (DS)',
                'CA': 'Blue Shield Medicare (CA)',
                'FQ': 'Capital Rx (FQ)',
                'BF': 'Caremark (BF)',
                'ED': 'CatalystRx (ED)',
                'AM': 'Cigna (AM)',
                'BO': 'Default Claim Format (BO)',
                'AP': 'Envision Rx Options (AP)',
                'CG': 'Express Scripts (CG)',
                'BI': 'Horizon (BI)',
                'AJ': 'Humana Medicare (AJ)',
                'BP': 'informedRx (BP)',
                'AO': 'MEDCO HEALTH (AO)',
                'AC': 'MEDCO MEDICARE PART D (AC)',
                'AQ': 'MEDGR (AQ)',
                'CC': 'MY HEALTH LA (CC)',
                'AG': 'Navitus Health Solutions (AG)',
                'AH': 'OptumRx (AH)',
                'AS': 'PACIFICARE LIFE AND H (AS)',
                'FJ': 'Paramount Rx (FJ)',
                'X ': 'PF - DEFAULT (X )',
                'EA': 'Pharmacy Data Management (EA)',
                'DW': 'PHCS (DW)',
                'AX': 'PINNACLE (AX)',
                'BN': 'Prescription Solutions (BN)',
                'AA': 'Tri-Care Express Scripts (AA)',
                'AI': 'United Healthcare (AI)'
            };
    
            // Function to dynamically update dropdown options
            function updateOptions(selector, options, mapping = null) {
                let element = $(selector);
                element.empty();
                element.append('<option value="">-- Select --</option>');
    
                options.forEach(function (option) {
                    // Use mapping if provided
                    let displayText = mapping && mapping[option] ? mapping[option] : option;
                    element.append('<option value="' + option + '">' + displayText + '</option>');
                });
    
                // Reinitialize Select2 if applied
                if (element.hasClass('select2')) {
                    element.trigger('change.select2');
                }
    
                console.log(`Updated ${selector} with options:`, options); // Debug updated options
            }
    
            // Event handler for drug name change
            function handleDrugChange(drugName) {
                console.log('Selected Drug Name:', drugName);
    
                if (drugName) {
                    $.ajax({
                        url: '/filter-data',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            drug_name: drugName,
                        },
                        success: function (response) {
                            console.log('Response:', response);
    
                            if (response.insurances && response.ndcs) {
                                $('#relatedInputs').show();
                            } else {
                                $('#relatedInputs').hide();
                            }
    
                            // Update dropdowns with the fetched data
                            updateOptions('#insurance', response.insurances, insuranceMapping); // Use mapping for insurances
                            updateOptions('#ndc', response.ndcs); // No mapping for NDCs
                        },
                        error: function (error) {
                            console.error('AJAX Error:', error);
                        }
                    });
                } else {
                    $('#relatedInputs').hide();
                }
            }
    
            // Handle change and paste events
            $('#drugName').on('change', function () {
                handleDrugChange($(this).val());
            });
    
            $('#drugName').on('paste', function (e) {
                const inputElement = $(this);
    
                setTimeout(function () {
                    const pastedValue = inputElement.val();
                    handleDrugChange(pastedValue); // Process pasted value after it's in the input
                }, 100); // Small delay to ensure the value is available
            });
        });
    </script>
    
    
    
    <!-- main codeee-->
    
  
    
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
            
            </div>

        
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>