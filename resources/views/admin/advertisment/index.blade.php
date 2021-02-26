@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить статью
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">



            <!-- Default box -->

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем рекламные коды</h3>
                    @include('admin.errors')
                </div>

                @foreach($ads as $ad)
                <div class="box-body">
                {{Form::open(['route'=>['advertisement.edit', $ad->id], 'method' => 'get'])}}

                    <div class="col-md-12">
                        <div class="form-group">
                            <label name="{{$ad->label}}" for="exampleInputEmail1">{{$ad->label}}</label>
                            <textarea name="code" id="" cols="30" rows="10" class="form-control">{!!$ad->code!!}</textarea>
                        </div>
                    </div>


                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                {{Form::close()}}
                @endforeach
                <!-- /.box-footer-->
            </div>

            <!-- /.box -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
