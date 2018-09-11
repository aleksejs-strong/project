@if((Auth::user()->userHasAnyRole(array('student'))))

@include('includes\header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Library</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Order Books</a></li>
            <li><a href="{{URL('/myorders')}}">My Orders</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <span class="glyphicon glyphicon-log-in"></span><a href="{{ URL::to('logout') }}"> Logout</a>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Welcome {{$user}}</h2>
    <h3>You can find in our Library following books:</h3>

    @if(isset($added))

        @if($added)
            <div class="text-success">
                Order was added successfully. It will be processed in a close time.
            </div>
        @elseif(!$added)
            <div  class="text-danger">
                Order wasn't added. The book currently is unavailable.
            </div>
        @endif
    @endif

    @if(isset($errorMessage))
        <div class="alert alert-danger">
            {{$errorMessage}}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
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
                <td>
                    <form method="post" action="/makeorder" name="orderBook">

                        <input name="order_user" value = "{{$user}}" type="hidden">
                        <input name="order_book_id" value = "{{$book->book_id}}" type="hidden">
                        <button class="btn btn-primary" type="submit">Order</button>

                        {{ csrf_field() }}
                    </form>
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