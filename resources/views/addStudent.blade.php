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
                <li class="active"><a href="{{URL('/addstudent')}}">Add Student</a></li>
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

    <h3>Add Student:</h3>
    @if(isset($errorMessage))
        <div class="text-danger">{{$errorMessage}}</div>
    @endif
    @if(isset($successMessage))
        <div class="text-success">User with username {{$successMessage}} was added successfully</div>
    @endif
    <form method="post" action="/addstudent" name="addstudent" class="form-check">

        <label for="firstname">First Name</label>
        <input type="text" name="firstname" class = 'form-control'>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" class = 'form-control'>
        @if(Auth::user()->hasRole('admin'))
            <label for="role">User Role:</label>
            <input type="text" name="role" class = 'form-control'>
        @endif
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" class = 'form-control'>
        <label for="password">Password</label>
        <input type="password" name="password" class = 'form-control'>

        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
    </form>


</div>


@include('includes\footer')

@else
    @include('includes\error')
@endif