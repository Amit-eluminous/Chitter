@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post your Chit</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($errors))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                 <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="post"></label>
                    <textarea class="form-control" id="post" name="post" rows="3" maxlength="150"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
