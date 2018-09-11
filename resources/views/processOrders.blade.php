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

                <li class="active"><a href="{{URL('/orders')}}">Orders</a></li>
                <li><a href="{{URL('/booked')}}">Booked Books</a></li>
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
            <th>Order id</th>
            <th>Username</th>
            <th>Book's name</th>
            <th>Book's author</th>
            <th>Publishing Year</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)

            <tr>
                <td>{{ $order->order_id}}</td>
                <td>{{ $order->username}}</td>
                <td>{{ $order-> name}}</td>
                <td>{{ $order->author }}</td>
                <td>{{ $order-> publishing_year}}</td>
                <td>
                    <div style='float:left;margin-right:5px' >
                        <form method="post" action="/acceptorder" name="orderBook" class="float-left">
                            <input name="order_id" value = "{{$order->order_id}}" type="hidden">
                            <button type="submit" class="btn btn-success  btn-xs">Accept</button>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div style='float:left'>
                        <form method="post" action="/rejectorder" name="orderBook" class="float-left">
                            <input name="order_id" value = "{{$order->order_id}}" type="hidden">
                            <button type="submit" class="btn btn-danger  btn-xs">Reject</button>
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