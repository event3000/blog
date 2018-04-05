@extends('layout')

@section('content')

<!-- ABOUT -->

<div class="col-9">
    <div class="cont-left-in">
        <h1>О нас</h1>

        <img class="img-left" src="img/pic01.jpg" alt="">
        <p>Мы рады Вас приветствовать на сайте <strong>Health and Eating!</strong></p>
        <p>Цель нашего проекта – помочь Вам разобраться в правильном и здоровом питании. На сайте Вы также сможете найти статьи и материалы</a> которые посвященны диетам, полезным рецептам, лечебному питанию, характеристикам и совместимости пищевых продуктов, информацию по витаминам, минералам, биодобавкам.</p>
        <p>Вы также можете посетить наш <a href="/shop">онлайн интернет магазин</a> - где вы сможете приобрести витамины, биодобавки и другие сопутствующие товары!</p>
        <div class="row"></div>
        <h2>Зачем это нужно мне?</h2>
        <img class="img-right" src="img/pic02.jpg" alt="">
        <p>Все знают, что к составлению ежедневного рациона питания нужно подходить ответственно. Те продукты, которые мы употребляем, влияют на наше самочувствие, состояние здоровья и настроение.Здоровый образ жизни за последние годы приобрел множество поклонников. Мы стали больше заботиться о себе - поменяли свои жизненные привычки, в том числе и в питании.</p>
        <p>Если Вы еще не решились на подобные шаги, то можете с легкостью это сделать найдя рекомендации на нашем сайте. Здоровье – это наше богатство, предлагаем не откладывать изменения в своей жизни на завтра, а сделать это сегодня!</p>
        <p>Надеемся Вам здесь будет интересно!</p>
        <p><em>С уважением -  Health and Eating</em></p>
       

       <!--  <h2>Контакты</h2> -->

        <p><strong>Если у вас есть какие либо вопросы, Вы всегда сможете с нами связаться: event3000@gmail.com</strong></p> 

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
                     <label for="text_area">Ваше сообщение</label><br>
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