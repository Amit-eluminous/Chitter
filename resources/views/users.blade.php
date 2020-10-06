@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if (session('success'))
                  <div class="alert alert-success" role="alert">
                      {{ session('success') }}
                  </div>
              @endif
                <div class="card-header">Follow Users</div>

                <div class="card-body">

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($other_users) && count($other_users)>0)
                          @foreach($other_users as $user)
                              <tr>
                                <td>{{ $user->name ?? '' }}</td>
                                @if(in_array($user->id,$followed_ids))
                                <td><a class="btn btn-success" href="{{ url('/follow-users/'.$user->id) }}">UnFollow</a></td>
                                @else
                                  <td><a class="btn btn-info" href="{{ url('/follow-users/'.$user->id) }}">Follow</a></td>
                                @endif
                              </tr>
                          @endforeach
                      @else
                        <tr>
                          <td colspan="2">No Record Found</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
