@extends('layout')

@section('content')

<!-- PROFILE -->

<div class="col-9">
    <div class="cont-left-in">
        
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @include('admin.errors')

        <h1>Ваш профиль:</h1>
         <hr>
        <br>

        <img width="200" src="{{ $user->getImage() }}" alt="" class="profile-image">

        

        <form role="form" method="post" action="/profile" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset class="fieldset-contact">
                
                <input type="text" class="form-control" id="name" name="name"
                           placeholder="Name" value="{{ $user->name }}"> <br><br>
                
        
                <input type="email" class="form-control" id="email" name="email"
                           placeholder="Email" value="{{ $user->email }}"><br><br>
               
                <input type="password" class="form-control" id="password" name="password"
                           placeholder="password"><br><br>
            
                <input type="file" class="form-control" id="image" name="avatar"><br><br>  
                
                <input class="btn" type="submit" name="" value="Обновить">
                
            </fieldset>
        </form> 


        

        <!-- <form action="#" method="post">
            <fieldset class="fieldset-contact">
                <div>
                    <label for="name">Имя&nbsp;&nbsp;</label>
                    <input type="text" name="" id="name-cnt" placeholder="Введите ваше имя" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="" id="email-cnt" placeholder="Введите ваш email" required>
                </div>
                <br>
                <div>
                    <label for="text_area">Ваше сообщение</label>
                    <br>
                    <textarea class="right-textarea" rows="6" id="textarea-cnt"></textarea>
                </div>
                <br>
                <input class="btn" type="submit" name="" value="Отправить">
            </fieldset>
        </form> -->
    </div>
</div>
@include('pages._sidebar')
@endsection