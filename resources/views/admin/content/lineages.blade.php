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
                                        <th>冠名</th>
                                        <th>価格pt</th>
                                        <th>牧場形態</th>
                                        <th>ユーザーID</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- foreach part is in here  --}}
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

@endsection
