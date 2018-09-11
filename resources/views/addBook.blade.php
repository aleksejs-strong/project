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
                <li class="active"><a href="{{URL('/addbook')}}">Add Book</a></li>
                    @if(Auth::user()->hasRole('admin'))
                        <li><a href="{{URL('/addimage')}}">Add Image For Book</a></li>
                    @endif
            </ul>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <span class="glyphicon glyphicon-log-in"></span><a href="{{ URL::to('logout') }}"> Logout</a>
        </ul>
    </div>
</nav>

<div class="container">

    <h3>Add Book:</h3>
    @if(isset($errorMessage))
        <div class="text-danger">{{$errorMessage}}</div>
    @endif
    @if(isset($successMessage))
        <div class="text-success">{{$successMessage}}</div>
    @endif
    <form method="post" action="/addbook" name="addbook" class="form-check">

        <label for="bookname">Book Name</label>
        <input type="text" name="bookname" class = 'form-control'>
        <label for="author">Author</label>
        <input type="text" name="author" class = 'form-control'>
        <label for="publishingyear">Publishing Year</label>
        <input type="text" name="publishingyear" class = 'form-control'>
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" class = 'form-control'>

        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
    </form>


</div>


@include('includes\footer')

@else
    @include('includes\error')
@endif

