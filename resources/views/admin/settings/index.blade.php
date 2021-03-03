@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        @include('pages.alerts_message')
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{--<a href="create.html" class="btn btn-success">Добавить</a>--}}
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Настройка</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{csrf_field()}}
                        @foreach($settings as $setting)
                        <tr>
                            <td>{{$setting->name}}</td>
                            <td>{{$setting->getStatus()}}</td>
                            <td>
                                @if($setting->status == 1)
                                    <a href="{{route('settings.tumbler', $setting->id)}}" class="fa fa-lock" title="Отключить!"></a>
                                @else
                                    <a href="{{route('settings.tumbler', $setting->id)}}" class="fa fa-thumbs-o-up" title="Включить!"></a>
                                @endif

                            </td>
                        </tr>

                        @endforeach
                        {{--</tfoot>--}}
                    </table>
                </div>


                <div class="box-header">
                    <h3 class="box-title">Кэш</h3>
                </div>

                <div class="box-body">
                    <a href="{{route('flushAllCache')}}" class="btn btn-success">Очистить весь кэш</a>
                    <a href="{{route('flushPostsCache')}}" class="btn btn-success">Очистить кэш постов</a>
                </div>

            {{Form::open(['route'=>['settings.seo'], 'method'=>'post'])}}
<script>

    CKEDITOR.config.templates_replaceContent = false;
</script>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ключевые слова</label><br>
                    <input type="title" class="form-control" id="exampleInputEmail1" placeholder="title" value="" name="title" ><br>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="description"></textarea><br>
                    <textarea name="keywords" id="" cols="30" rows="10" class="form-control" placeholder="keywords"></textarea><br>
                    <div class="box-footer">
                        <button class="btn btn-warning pull-right">Изменить</button>
                    </div>
                </div>
            {{Form::close()}}

                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
