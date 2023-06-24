@extends('admin.layout.admin')
@section('main-content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" style="margin-bottom: 20px" data-toggle="modal" data-target="#mediumModal">
                                <i class="zmdi zmdi-plus"></i>新規追加</button>
                            </button>
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>牧場名</th>
                                        <th>レベル</th>
                                        <th>価格</th>
                                        <th>ユーザーID</th>
                                        <th>その他</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ranchs as $data)
                                        <tr class="tr-shadow">
                                            <td>{{ $data->pasture_name }}</td>
                                            <td>{{ $data->level }}</td>
                                            <td>{{ $data->price }}</td>
                                            <td>{{ $data->user_id }}</td>
                                            <td>{{ $data->etc }}</td>
                                            <td>
                                                <div class="table-data-feature" style="justify-content:left" data-toggle="modal"
                                                data-target="#staticModal" onclick="setId({{$data->id}})">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="削除"><i class="zmdi zmdi-delete"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="setid" value="ddd">
    </div>
    {{-- delete modal  --}}
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">削除</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        削除しますか？
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                    <button type="button" class="btn btn-primary" onclick="Delete()">はい</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function setId(id){
        document.getElementById('setid').value = id;
    }
    function Delete() {
    let id = document.getElementById('setid').value;
    //window.location.href = "/delete_user/" + id + "?_method=delete&_token={{ csrf_token() }}";
}
</script>
@endsection
