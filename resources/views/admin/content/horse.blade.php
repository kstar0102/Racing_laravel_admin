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
                                <style>
                                    th{
                                        min-width: 120px;
                                    }
                                </style>
                                <thead>
                                    <tr>
                                        <th>馬名</th>
                                        <th>年齢</th>
                                        <th>タイプ</th>
                                        <th>クラス</th>
                                        <th>金額(Pt)</th>
                                        <th>毛色</th>
                                        <th>牡 | 牝</th>
                                        <th>成長</th>
                                        <th>馬場</th>
                                        <th>脚質</th>
                                        <th>基礎 ＳＰ</th>
                                        <th>基礎 ＳＴ</th>
                                        <th>基礎 根性</th>
                                        <th>基礎 瞬発</th>
                                        <th>基礎 気性</th>
                                        <th>基礎 体質</th>
                                        {{-- /// --}}
                                        <th>努力 ＳＰ</th>
                                        <th>努力 ＳＴ</th>
                                        <th>努力 根性</th>
                                        <th>努力 瞬発</th>
                                        <th>努力 気性</th>
                                        <th>努力 体質</th>
                                        <th>状態</th>
                                        <th>距離(下限)</th>
                                        <th>距離(上限)</th>
                                        <th>隠し</th>
                                        <th>三冠</th>


                                        <th>1系統</th>
                                        <th>父</th>
                                        <th>因子</th>
                                        <th>1系統</th>
                                        <th>母</th>
                                        {{-- /////// --}}
                                        <th>2系統</th>
                                        <th>父父</th>
                                        <th>因子</th>
                                        <th>2系統</th>
                                        <th>父母</th>

                                        <th>2系統</th>
                                        <th>母父</th>
                                        <th>因子</th>
                                        <th>2系統</th>
                                        <th>母母</th>

                                        <th>ユーザーid</th>
                                        <th>牧場id</th>
                                        <th>その他</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- foreach part is in here  --}}
                                    @foreach ($horses as $horse)
                                        <tr class="tr-shadow">
                                            <td>{{ $horse->name }}</td>
                                            <td>{{ $horse->age }}</td>
                                            <td>{{ $horse->type }}</td>
                                            <td>{{ $horse->class }}</td>
                                            <td>{{ $horse->price }}</td>
                                            <td>{{ $horse->color }}</td>
                                            <td>{{ $horse->gender }}</td>
                                            <td>{{ $horse->growth }}</td>
                                            <td>{{ $horse->ground }}</td>
                                            <td>{{ $horse->quality_leg }}</td>
                                            <td>{{ $horse->speed_b }}</td>
                                            <td>{{ $horse->strength_b }}</td>
                                            <td>{{ $horse->moment_b }}</td>
                                            <td>{{ $horse->stamina_b }}</td>
                                            <td>{{ $horse->condition_b }}</td>
                                            <td>{{ $horse->health_b }}</td>
                                            <td>{{ $horse->speed_w }}</td>
                                            <td>{{ $horse->strength_w }}</td>
                                            <td>{{ $horse->moment_w }}</td>
                                            <td>{{ $horse->stamina_w }}</td>
                                            <td>{{ $horse->condition_w }}</td>
                                            <td>{{ $horse->health_w }}</td>
                                            <td>{{ $horse->state }}</td>
                                            <td>{{ $horse->distance_max }}</td>
                                            <td>{{ $horse->distance_min }}</td>
                                            <td>{{ $horse->hidden }}</td>
                                            <td>{{ $horse->triple_crown }}</td>
                                            {{-- /// --}}
                                            <td>{{ $horse->f_sys }}</td>
                                            <td>{{ $horse->f_name }}</td>
                                            <td>{{ $horse->f_factor }}</td>
                                            <td>{{ $horse->m_sys }}</td>
                                            <td>{{ $horse->m_name }}</td>

                                            <td>{{ $horse->f_f_sys }}</td>
                                            <td>{{ $horse->f_f_name }}</td>
                                            <td>{{ $horse->f_f_factor }}</td>
                                            <td>{{ $horse->f_m_sys }}</td>
                                            <td>{{ $horse->f_m_name }}</td>

                                            <td>{{ $horse->m_f_sys }}</td>
                                            <td>{{ $horse->m_f_name }}</td>
                                            <td>{{ $horse->m_f_factor }}</td>
                                            <td>{{ $horse->m_m_sys }}</td>
                                            <td>{{ $horse->m_m_name }}</td>
                                            
                                            <td>{{ $horse->user_id }}</td>
                                            <td>{{ $horse->pasture_id }}</td>
                                            <td>{{ $horse->etc }}</td>

                                            <td>
                                                <div class="table-data-feature" style="justify-content:left" data-toggle="modal"
                                                data-target="#staticModal" onclick="setId({{$horse->id}})">
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

@endsection