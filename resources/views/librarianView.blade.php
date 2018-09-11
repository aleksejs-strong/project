@if((Auth::user()->userHasAnyRole(array('librarian'))))
@include('includes\header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Library</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{URL('/availablebooks')}}">Books</a></li>
            <li><a href="{{URL('/orders')}}">Orders</a></li>
            <li><a href="{{URL('/booked')}}">Booked Books</a></li>
            <li><a href="{{URL('/addstudent')}}">Add Student</a></li>
            <li><a href="{{URL('/addbook')}}">Add Book</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <span class="glyphicon glyphicon-log-in"></span><a href="{{ URL::to('logout') }}"> Logout</a>
        </ul>
    </div>
</nav>

<div class="container">

    <h3>Available books</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Book's Image</th>
            <th>Book name</th>
            <th>Book's author</th>
            <th>Publishing Year</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
@foreach($books as $book)

            <tr>
                <td><img src = "uploads/{{ $book->book_id .".jpg"}}" alt="" border=3 height=100></td>
                <td>{{ $book->name}}</td>
                <td>{{ $book-> author}}</td>
                <td>{{ $book-> publishing_year}}</td>
                <td>{{ $book->quantity }}</td>

            </tr>

@endforeach
        </tbody>
    </table>
</div>


@include('includes\footer')

@else
    @include('includes\error')
@endif