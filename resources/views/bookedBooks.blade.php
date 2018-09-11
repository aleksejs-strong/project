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
                <li class="active"><a href="{{URL('/booked')}}">Booked Books</a></li>
                <li><a href="{{URL('/addstudent')}}">Add Student</a></li>
                <li><a href="{{URL('/addbook')}}">Add Book</a></li>
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

    <h3>Orders to Process:</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Booking id</th>
            <th>Username</th>
            <th>Book id</th>
            <th>Book's name</th>
            <th>Book's author</th>
            <th>Booking date</th>
            <th>Until</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($bookings as $booking)

            <tr>
                <td>{{ $booking->booking_id}}</td>
                <td>{{ $booking->username}}</td>
                <td>{{ $booking->book_id}}</td>
                <td>{{ $booking->name}}</td>
                <td>{{ $booking->author }}</td>
                <td>{{ $booking->booked_at}}</td>
                <td>{{ $booking->until_at}}</td>
                <td>
                    <div style='float:left;margin-right:5px' >
                        <form method="post" action="/extendbooking" name="orderBook" class="float-left">
                            <input name="booking_id" value = "{{$booking->booking_id}}" type="hidden">
                            <button type="submit" class="btn btn-success  btn-xs">Extend</button>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div style='float:left'>
                        <form method="post" action="/closebooking" name="orderBook" class="float-left">
                            <input name="booking_id" value = "{{$booking->booking_id}}" type="hidden">
                            <button type="submit" class="btn btn-danger  btn-xs">Close</button>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </td>


            </tr>

        @endforeach
        </tbody>
    </table>
</div>


@include('includes\footer')

@else
    @include('includes\error')
@endif