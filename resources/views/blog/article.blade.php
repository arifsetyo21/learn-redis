@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-6 col-lg-offset-3">
         <div class="card">
            <h5 class="card-header">{{$article->title}} - (by {{$article->author}})</h5>
            <div class="card-body">
               <p class="card-text">{{$article->content}}</p>
               <p class="card-text">this article has {{$views}} views and the following tags: @foreach ($tags as $tag) {{$tag}}, @endforeach</p>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection