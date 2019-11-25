@extends('app')

@section('body')
<div class="container">
   <div class="row d-flex justify-content-center mt-4">
      <div class="col-lg-6 col-lg-offset-3">
         <div class="card">
            <h5 class="card-header">Add Article</h5>
            <div class="card-body">
               {{-- title, author name, tagging, text --}}
               <form method="POST" action="{{route('admin.addArticle')}}">
                  @csrf
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" class="form-control" id="title" placeholder="How to create a post">
                  </div>
                  <div class="form-group">
                     <label for="author">Author Name</label>
                     <input type="text" name="author" class="form-control" id="author" placeholder="Jimmy Neutron">
                  </div>
                  <div class="form-group">
                     <label for="tags">Tagging</label>
                     <input type="text" name="tags" class="form-control" id="tags" placeholder="Laravel, Redis, Tagging">
                     <small id="tagsHelp" class="form-text text-muted">sparate by comma(,).</small>
                  </div>
                  <div class="form-group">
                     <label for="content">Content</label>
                     <textarea class="form-control" name="content" id="text" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Add</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection