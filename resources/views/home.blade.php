@extends('app')

@section('body')
   <div class="container">
      <div class="row d-flex justify-content-center mt-4">
         <div class="col-lg-8 col-lg-offset-3">
             <div class="card text-left">
                <div class="card-header">
                   Blog
                </div>
                <div class="card-body">
                   {{-- NOTE Letakkan id untuk partial reload pada list agar tidak merubah tampilan --}}
                   <ul id="items" class="list-group">
                      @foreach ($posts as $item)
                      <li class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal" value="oke">
                         <a class="card-link" href="">{{$item->title}}</a><br>
                         {{$item->author}}
                      </li>
                      @endforeach
                   </ul>
                </div>
                <div class="card-footer text-muted">
                </div>
             </div>
         </div>
      </div>
   </div>
   @csrf
 <!-- Modal -->

@endsection