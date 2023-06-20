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
                                        <th>名前</th>
                                        <th>Eメール</th>
                                        <th>ログインID</th>
                                        <th>ユーザーpt</th>
                                        <th>役割</th>
                                        <th>削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="tr-shadow">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->login_id }}</td>
                                            <td>{{ $user->user_pt }}</td>
                                            <td>
                                                @php
                                                    if ($user->role == 1) {
                                                        echo 'マネージャー';
                                                    } else {
                                                        echo 'ユーザー';
                                                    }
                                                @endphp</td>

                                            <td>
                                                <div class="table-data-feature" style="justify-content:left" data-toggle="modal"
                                                data-target="#staticModal" onclick="setId({{$user->id}})">
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
                        <h3 class="text-center title-2">Pay Invoice</h3>
                    </div>
                    <hr>
                    <form action="" method="post" novalidate="novalidate">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                            <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                        </div>
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">Name on card</label>
                            <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Card number</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true"
                                data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                    <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration"
                                        data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY"
                                        autocomplete="cc-exp">
                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="x_card_code" class="control-label mb-1">Security code</label>
                                <div class="input-group">
                                    <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                        data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Pay $100.00</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm</button>
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
    window.location.href = "/delete_user/" + id + "?_method=delete&_token={{ csrf_token() }}";
}
</script>
@endsection
