<!-- SIDEBAR -->

<div class="col-3">
    <div class="cont-right-in">

        <!-- МЕНЮ: СПИСОК КАТЕГОРИЙ -->
        <aside>
            <h2>Разделы:</h2>
            <hr>
            <ul class="menu2">
                <!-- <li><a href="#">Правильное и здоровое питание</a></li>
                <li><a href="#">Лечебное питание</a></li>
                <li><a href="#">Питание для похудения</a></li>
                <li><a href="#">Полезные рецепты</a></li>
                <li><a href="#">Витамины, микроэлементы, биодобавки</a></li>
                <li><a href="#">Энциклопедия полезных продуктов</a></li> -->
                 
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->title }}</a>
                    <span class="post-count pull-right"> ({{ $category->posts()->count() }})</span>
                </li>
                @endforeach          
            </ul>
         </aside>
         <br>
        <!-- МЕНЮ: СПИСОК КАТЕГОРИЙ // END -->

        <!-- МЕНЮ: ТЕГИ -->
        <aside>
            <h2>Теги:</h2>
            <hr>
                @foreach($tags as $tag)
                
                    <a href="{{ route('tag.show', $tag->slug) }}" title="{{ $tag->title }}">
                        {{ $tag->title }}</a>&nbsp;  
                    <!-- <span class="post-count pull-right">  {{-- $tag->posts()->count() --}}</span> -->
                
                @endforeach          
            
         </aside>
         <br><br>
        <!-- МЕНЮ: ТЕГИ // END -->

        

        <!-- ПОПУЛЯРНЫЕ ПОСТЫ -->
        <aside>
            <h2 class="widget-title text-uppercase text-center">Популярные статьи:</h2>
            <hr>
            @foreach($popularPosts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="popular-img" title="{{ $post->title }}">
                    <img height="50" class="img-left" src="{{ $post->getImage() }}" 
                    alt="{{ $post->title }}" >
                </a>

                <p><strong>{{ $post->getDate() }}</strong><br>
                    <a href="{{ route('post.show', $post->slug) }}" class="text-uppercase">{{ $post->title }}</a>
                </p>
            @endforeach
        </aside>
        <br>
        <!-- ПОПУЛЯРНЫЕ ПОСТЫ // END-->

        <!-- РЕКОМЕНДОВАННЫЕ ПОСТЫ -->
        <aside>
            <h2 class="widget-title text-uppercase text-center">Рекомендованные статьи:</h2>
            <hr>
            @foreach($featuredPosts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="popular-img" title="{{ $post->title }}">
                    <img height="50" class="img-left" src="{{ $post->getImage() }}" 
                    alt="{{ $post->title }}" >
                </a>

                <p><strong>{{ $post->getDate() }}</strong><br>
                    <a href="{{ route('post.show', $post->slug) }}" class="text-uppercase">{{ $post->title }}</a>
                </p>
            @endforeach
        </aside>
        <br>
         <!-- РЕКОМЕНДОВАННЫЕ ПОСТЫ // END-->

        <!-- ПОСЛЕДНИЕ ПОСТЫ -->
        <aside>
            <h2 class="widget-title text-uppercase text-center">Свежие статьи:</h2>
            <hr>
            @foreach($recentPosts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="popular-img" title="{{ $post->title }}">
                    <img height="50" class="img-left" src="{{ $post->getImage() }}" 
                    alt="{{ $post->title }}" >
                </a>

                <p><strong>{{ $post->getDate() }}</strong><br>
                    <a href="{{ route('post.show', $post->slug) }}" class="text-uppercase">{{ $post->title }}</a>
                </p>
            @endforeach
        </aside>
        <br>
         <!-- ПОСЛЕДНИЕ ПОСТЫ // END-->

         <!-- ФОРМА ПОДПИСКИ -->
        <aside>
            <h2>Подписаться:</h2>  
            <hr> 
            @include('admin.errors')
            <form action="/subscribe" method="post">
            {{ csrf_field() }}    
                <input type="text" placeholder="Введите свой email" name="email"><br><br>
                <input type="submit" value="Отправить"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>
        </aside>
        <br>
        <!-- ФОРМА ПОДПИСКИ // END -->













<!--         <h2>Авторизация:</h2>
        <hr>
        <form action="index.php" method="post">
            <fieldset>
                
                <div>
                    <br>
                    <label for="name">Имя&nbsp;&nbsp;</label>
                    <input type="text" name="username" placeholder="Введите ваше имя" value="" />
                </div>
                <div>
                    <label for="password">Pass</label>
                    <input type="password" name="password" value="" placeholder="Введите ваш пароль" />
                </div>
                <br>
                <input class="btn" type="submit" name="submit" value="Отправить" />
                <fieldset>
        </form>
        <br>
        <br> -->

<!--         <h2>Опрос:</h2>
        <hr>
        <p>Какие новые разделы блога вы хотели бы видеть на нашем сайте?</p>
        <form action="#" method="post">
            <fieldset>
                <div>
                    <label>
                        <input type="checkbox">Спортивное питание</label>
                </div>
                <div>
                    <label>
                        <input type="checkbox">Правильное питание для детей</label>
                </div>
                <div>
                    <label for="poll_mess">Свой вариант</label>
                    <textarea rows="" class="right-textarea" id="textarea-poll"></textarea>
                </div>
                <br>
                <input class="btn" type="submit" name="form-poll" value="Отправить">
            </fieldset>
        </form> -->

<!--         
        <h2>Каталог товаров:</h2>
        <hr>
        <ul class="menu2">
            <li><a href="#">Витамины</a></li>
            <li><a href="#">Здоровье и долголетие</a></li>
            <li><a href="#">Аминокислоты</a></li>
            <li><a href="#">Спортивное питание</a></li>
        </ul> -->
    </div>
</div>