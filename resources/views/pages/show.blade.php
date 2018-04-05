@extends('layout')

@section('content')

<!-- ВЫВОД ОТДЕЛЬНОГО ПОСТА-->

<div class="col-9">
    <div class="cont-left-in">
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <h1>{{ $post->title }}</h1>

                  <p><strong>Раздел:</strong> 
                @if($post->hasCategory()) 
                    <a href="{{ route('category.show', $post->category->slug) }}"> {{ $post->getCategoryTitle() }}</a>
                @endif 
                &nbsp;&nbsp;/&nbsp;&nbsp;
                <strong>Тэги:&nbsp;</strong>
                @foreach($post->tags as $tag)   
                    <a href="{{ route('tag.show', $tag->slug) }}" title="{{ $tag->title }}">{{ $tag->title }}</a>&nbsp;&nbsp;
                @endforeach
                &nbsp;&nbsp;/&nbsp;&nbsp;
                <strong>{{-- $post->author->name --}}</strong> {{ $post->getDate() }}
            </p>
        
        

       
        <img class="img-left" src="{{ $post->getImage() }}" alt="{{ $post->getCategoryTitle() }}" title="{{ $post->getCategoryTitle() }}">
        
        {!! $post->content !!}
        
        <div class="row"></div>
        <div class="img-left">
        @if($post->hasPrevious())   
            <a href="{{ route('post.show', $post->getPrevious()->slug) }}" title="{{ $post->getPrevious()->title }}">
                <h5><<&nbsp;&nbsp;предыдущая статья</h5>  
            </a>
        @endif    
        </div>
        
        <!-- ПРЕД - СЛЕД ПОСТ -->
        <div class="img-right">
        @if($post->hasNext())   
            <a href="{{ route('post.show', $post->getNext()->slug) }}" title="{{ $post->getNext()->title }}">
                <h5>cледующая статья&nbsp;&nbsp;>></h5> 
            </a>
        @endif
        </div>

        <!-- ДРУГИЕ ПОСТЫ ПО ТЕМЕ -->
        <div class="row"></div>
        <hr>
        <h2>Другие материалы по теме:</h2>
        @foreach( $post->related() as $item )
        <div class="row">            
            <a  href="{{ route('post.show', $item->slug) }}">
                <p>{{ $item->title }}</p>
            </a>
        </div>
        @endforeach

        
        @if(!$post->comments->isEmpty())
        <!-- ВЫВОД ГОТОВЫХ КОММЕНТАРИЕВ К ПОСТУ -->
        <div class="row"></div>
        <hr>
        <h2>Комментарии:</h2>
        @foreach($post->getComments() as $comment)

        <div class="row" >
            <img class="img-left" src="{{ $comment->author->getImage() }}" alt="" width="75" height="75">
            
                <p><strong>{{ $comment->author->name }}</strong> {{ $comment->created_at->diffForHumans() }}</p>

                <p >{{ $comment->text }}</p>

        </div>
        @endforeach
        @endif


        @if(Auth::check())
        <!-- ВЫВОД ГОТОВЫХ КОММЕНТАРИЕВ К ПОСТУ (ТОЛЬКО ЗАРЕГИСТРИРОВАННЫМ ПОЛЬЗОВАТЕЛЯМ) -->
        <div class="row"></div>
        <hr>
        <h2>Оставить комментарий:</h2>

       
           

            <form role="form" method="post" action="/comment">
            {{ csrf_field() }}

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <fieldset class="fieldset-contact">
                
                     <!-- <label for="text_area">Ваше сообщение</label><br> -->
                     <textarea name="message" class="right-textarea" rows="6" id="textarea-cnt" placeholder="Напишите здесь что нибудь..."></textarea>
                    <br>


                <br>
                <input class="btn" type="submit" name="" value="Отправить">
                <!-- <button class="btn">Отправить</button> -->
            </fieldset>
        </form> 
        @endif
        
        

 
    </div>
</div>
@include('pages._sidebar')
@endsection