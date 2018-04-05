@extends('layout')

@section('content')

<!-- LOGIN -->

<div class="col-9">
    <div class="cont-left-in">
        
        <!-- ФЛЕШ СООБЩЕНИЕ О НЕПР-НОМ ВВОДЕ ЛОГИНА ИЛИ ПАРОЛЯ -->
        @if(session('status')) 
            <div class="alert alert-danger">
            {{ session('status') }}
            </div>
        @endif
        
        @include('admin.errors')

        <h1>Войдите под свои логином (email):</h1>
         <hr>
        <br>

        

        <form role="form" method="post" action="/login">
           {{ csrf_field() }}
            <fieldset class="fieldset-contact">
                
                <input type="text" class="form-control" id="email" name="email"
                           placeholder="Email" value="{{ old('email') }}"> <br><br>
                
        
                <input type="password" class="form-control" id="password" name="password"
                           placeholder="password"><br><br>
               
                
                
                <input class="btn" type="submit" name="" value="Войти">
                
            </fieldset>
        </form> 



        


    </div>
</div>
@include('pages._sidebar')
@endsection