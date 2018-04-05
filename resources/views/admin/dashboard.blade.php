@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добро пожаловать, в АДМИН ПАНЕЛЬ!
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><--- Выберите нужный  пункт админ-панели слева</h3>
          <h3 class="box-title"></h3>
        </div>
         <div class="box-body">
          Перейти на <a href="/">сайт</a>
        </div> 
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          и здесь есть место для какого-нибудь текста
        </div> -->
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
@endsection