@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-8 col-lg-offset-3">
         <div class="card">
            <div class="card-header text-center">
               Feed List
            </div>
            <div class="card-body">
               <ul class="list-group">
                  @forelse ($posts as $post)
                     <li class="list-group-item">
                        {{$post['text']}}<br>
                        <small class="disabled text-muted" aria-disabled="true">
                           Posted on {{gmdate("Y-m-d\TH:i:s\Z", $post['time'])}} by {{$post['username']}}
                        </small>
                     </li>
                  @empty
                     Nothing Posts
                  @endforelse
               </ul>
            </div>
            <div class="card-footer text-muted">
               {{-- signed in as {{$current_user_id['username']}} --}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

