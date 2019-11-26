@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-4 col-lg-offset-3">
         <div class="card text-center">
            <div class="card-header">
               User List
            </div>
            <div class="card-body">
               <ul class="list-group list-group-flush">
                  @forelse ($users as $user)
                     <li class="list-group-item">{{$user['username']}} <a class="float-right" href="/{{$current_user_id['id']}}/follow/{{$user['id']}}">follow</a></li>
                  @empty
                  Nothing User
                  @endforelse
               </ul>
            </div>
            <div class="card-footer text-muted">
               signed in as {{$current_user_id['username']}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection