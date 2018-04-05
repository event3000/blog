@extends('layout')

@section('content')

<!-- REGISTR -->

<div class="col-9">
    <div class="cont-left-in">

        @include('admin.errors')

        <h1>Регистрация:</h1><hr><br>
        
        

        <form role="form" method="post" action="/register">
           {{ csrf_field() }} <!-- скрытое поле с токеном для безопасности-->
            <fieldset class="fieldset-contact">

                <input type="text" class="form-control" id="name" name="name"
                           placeholder="Name" value="{{ old('name') }}"><br><br>
                
            
                <input type="text" class="form-control" id="email" name="email"
                           placeholder="Email" value="{{ old('email') }}"><br><br>
                
            
                <input type="password" class="form-control" id="password" name="password"
                           placeholder="password"><br><br>
            

             <input class="btn" type="submit" name="" value="Зарегистрироваться">
                
            </fieldset>
        </form> 

        
    </div>
</div>

@include('pages._sidebar')
@endsection