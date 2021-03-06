@extends('base.basetemplate')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Informasi RT
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Kependudukan</a></li>
        <li><a href="#">Wilayah</a></li>
        <li><a href="#">RT</a></li>
        <li class="active">Ubah</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah RT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="/wilayah/rt/edit/{{ $rt->id }}">
              {{ method_field('PUT')}}
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Dusun</label>
                  <select class="form-control select2" name="rt_dusun_id" style="width: 100%;">
                    @foreach($dusuns as $dusun)
                      <option {{ $rt->rt_dusun_id == $dusun->id ? "selected=''" : "" }} value="{{ $dusun->id }}">{{ $dusun->dusun_nama }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama RW</label>
                  <select class="form-control select2" name="rt_rw_id" style="width: 100%;">
                    @foreach($rws as $rw)
                      <option {{ $rt->rt_rw_id == $rw->id ? "selected=''" : "" }} value="{{ $rw->id }}">{{ $rw->rw_nama }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama RT</label>
                  <input type="text" class="form-control" name="rt_nama" id="exampleInputEmail1" value="{{ $rt->rt_nama }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama Ketua RT</label>
                  <input type="text" class="form-control" name="rt_ketua_nama" id="search_text" value="{{ $rt->ketua_rt. ' - ' .$rt->rt_nik }}">
                  <input type="hidden" name="rt_ketua_id" id="q" value="{{ $rt->rt_ketua_id }}">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <input type="hidden" name="id" value="{{ $rt->id }}">
                <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
              </div>
            </form>
          </div>
        </section>
  <!-- /.content -->
</div>
@endsection

@section('private-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/plugins/select2/select2.min.css">
@endsection

@section('content-js')
<!-- Select2 -->
<script src="/assets/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });

  src = "{{ route('searchdusun') }}";
   $("#search_text").autocomplete({
      source: function(request, response) {
          $.ajax({
              url: src,
              dataType: "json",
              data: {
                  term : request.term
              },
              success: function(data) {
                  response(data);
              }
          });
      },
      min_length: 3,
      select: function(event, ui) {
        //alert(ui.item.id);
        $('#q').val(ui.item.id);
      }
  });
</script>
@endsection

@section('content-css')
<!-- Daterange picker -->
<link rel="stylesheet" href="/assets/dist/css/jquery.ui.autocomplete.css">
@endsection
