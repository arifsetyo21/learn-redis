<!doctype html>
<html lang="en">
  <head>
    <title>To Do List App</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JQuery UI -->

    <!-- Material.io -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>
  <body>
     <div class="container">
        <div class="row d-flex justify-content-center mt-4">
           <div class="col-lg-6 col-lg-offset-3">
               <div class="card text-left">
                  <div class="card-header">
                     Todo List App
                     <!-- Button trigger modal -->
                     <a href="#" class="float-right text-dark" id="btnAddItem" data-toggle="modal" data-target="#exampleModal">
                        <i class="material-icons">
                           add_box
                        </i>
                     </a>
                     <div class="ui-widget">
                        {{-- <label for="searchItem">Search Item: </label> --}}
                        <input class="form-control" id="searchItem" name="searchItem" type="text" placeholder="Search Item...">
                     </div>
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
  </body>
</html>