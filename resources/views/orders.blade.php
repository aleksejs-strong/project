@if((Auth::user()->userHasAnyRole(array('student'))))

@include('includes\header')





<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Library</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/booklist">Order Books</a></li>
            <li class="active"><a href="{{URL('/myorders')}}">My Orders</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <span class="glyphicon glyphicon-log-in"></span><a href="{{ URL::to('logout') }}"> Logout</a>
        </ul>
    </div>
</nav>

<div class="container">
    <h3>Your Orders:</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Order id</th>
            <th>Book's name</th>
            <th>Book's author</th>
            <th>Publishing Year</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)

            <tr>
                <td>{{ $order->order_id}}</td>
                <td>{{ $order-> name}}</td>
                <td>{{ $order->author }}</td>
                <td>{{ $order-> publishing_year}}</td>
                <td><button type="button" class="btn btn-warning  btn-xs">In process</button></td>

            </tr>

        @endforeach
        @foreach ($booked as $booking)

            <tr>
                <td>{{ $booking->booking_id}}</td>
                <td>{{ $booking-> name}}</td>
                <td>{{ $booking->author }}</td>
                <td>{{ $booking-> publishing_year}}</td>
                <td><button type="button" class="btn btn-success  btn-xs">Reading</button></td>

            </tr>

        @endforeach

        </tbody>
    </table>
</div>

@include('includes\footer')

@else
    @include('includes\error')
@endif