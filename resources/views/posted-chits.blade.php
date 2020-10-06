@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Previous Posted Chits</div>

                <div class="card-body">

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">User</th>
                        <th scope="col">Chit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($posts) && count($posts)>0)
                          @foreach($posts as $post)
                              <tr>
                                <td>{{ $post->assignedUser->name ?? '' }}</td>
                                <td>{{ $post->post }}</td>
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
