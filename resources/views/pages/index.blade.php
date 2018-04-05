@extends('layout')

@section('content')

<!-- ЛЕНТА ПОСТОВ - ГЛАВНАЯ БЛОГ -->

<div class="col-9">
    <div class="cont-left-in">
        <!-- <h1>Блог</h1> -->
        
        @foreach($posts as $post)
        <div class="blog-item">
                <h2><a href="{{ route('post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a></h2>

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

            <a href="{{ route('post.show', $post->slug) }}" title="{{ $post->title }}">    
                <img class="img-left" src="{{ $post->getImage() }}" width="360" height="253" alt="{{ $post->title }}" title="{{ $post->title }}">
            </a>
            
           
            <p>{!!$post->description!!}</p>
            <div class="clear"></div>
        </div>
        @endforeach

        {{ $posts->links() }}
        <!-- <ul class="pagination">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
        </ul> -->

    </div>
</div>

@include('pages._sidebar')

@endsection