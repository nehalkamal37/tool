@extends('dashboard.app')

@section('title', 'All Users')
@section('head', 'All Users')

@section('content')


    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Users table</h6>
                <button class="btn btn-primary" style="margin-left: 20px;"><a href="{{route('dashboard.users.create')}}" class="text-white">Add User</a></button>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>

                      <th class="text-secondary opacity-7">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->email}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $user->role}}</h6>
                        </div>
                      </div>
                    </td>
                     
                
                      <td class="align-middle">
                        <a href="{{route('dashboard.users.edit',$user->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <p style="color: blue"> Edit</p>
                          
                        </a>
                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this drug?');">
                          @csrf
                          @method('DELETE') <!-- Spoof DELETE method -->
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      

@endsection