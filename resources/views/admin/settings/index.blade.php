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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
