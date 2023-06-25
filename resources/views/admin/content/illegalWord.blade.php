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
                                        <th>登録名</th>
                                        <th>分類</th>
                                        <th>その他</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($illegal_words as $data)
                                        <tr class="tr-shadow">
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->type }}</td>
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

    {{-- add modal  --}}
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">新規追加</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">登録</h3>
                    </div>
                    <hr>
                    <form action="<?= route('illeword_save') ?>" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">登録名</label>
                            <input id="cc-name" name="word_name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">分類</label>
                            <select name="word_type" class="form-control">
                                <option value="horse">選択してください。</option>
                                <option value="horse">horse</option>
                                <option value="pasture">pasture</option>
                            </select>
                        </div>
                        
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">登録</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
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
    window.location.href = "/delete_illegal_word/" + id + "?_method=delete&_token={{ csrf_token() }}";
}
</script>
@endsection
