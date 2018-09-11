@if((Auth::user()->userHasAnyRole(array('admin','librarian'))))
@include('includes\header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Library</a>
        </div>
        <ul class="nav navbar-nav">
            <ul class="nav navbar-nav">
                @if(Auth::user()->hasRole('admin'))
                    <li><a href="{{URL('/books')}}">Books</a></li>
                @else
                    <li><a href="{{URL('/availablebooks')}}">Books</a></li>
                @endif
                <li><a href="{{URL('/orders')}}">Orders</a></li>
                <li><a href="{{URL('/booked')}}">Booked Books</a></li>
                <li><a href="{{URL('/addstudent')}}">Add Student</a></li>
                <li><a href="{{URL('/addbook')}}">Add Book</a></li>

                        <li class="active"><a href="{{URL('/addimage')}}">Add Image For Book</a></li>

            </ul>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <span class="glyphicon glyphicon-log-in"></span><a href="{{ URL::to('logout') }}"> Logout</a>
        </ul>
    </div>
</nav>

<div class="container">

    <h3>Add Image For the Book:</h3>
    @if(isset($errorMessage))
        <div class="text-danger">{{$errorMessage}}</div>
    @endif
    @if(isset($successMessage))
        <div class="text-success">User with username {{$successMessage}} was added successfully</div>
    @endif
    <form action="/addimage" method="post" enctype="multipart/form-data" class="form-check">
        <label>Select image to upload:</label>
        <select  class="form-control m-bot15" name="book_name">
            @if($books->count() > 0)
                @foreach($books as $book)
                    <option value="{{$book->book_id}}">{{$book->name}}</option>
                @endForeach
            @else
                No Record Found
            @endif
        </select>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="btn btn-primary" type="submit" value="Upload Image" name="submit">
        {{ csrf_field() }}
    </form>


</div>


@include('includes\footer')

@else
    @include('includes\error')
@endif