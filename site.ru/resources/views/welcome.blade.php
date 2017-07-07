@extends('layouts.app')

@section('content')

    <div class="container">

        <div id="test-swipe-1" class="col s12">
            <table class="table-workers centered responsive-table highlight">
                <thead class="table-head">
                    <tr>
                        <th>Фото</th>
                        <th>Имя Фамилия</th>
                        <th>Должность</th>
                        <th class="icon-salary">Премия, <i class="fa fa-rub" aria-hidden="true"></i></th>
                        <th class="icon-salary">Зарплата, <i class="fa fa-rub" aria-hidden="true"></i></th>
                    </tr>
                </thead>

                <tbody>
                @if( count($payment) )
                @foreach( $payment as $pay )
                    <tr>
                        <td class="photo-inner-table">
                            <a href="{{ $pay->worker->photo ? asset('/img/'.json_decode($pay->worker->photo)->medium) : asset('img/user_profile.jpg') }}" 
                            data-lightbox="image-1" data-title="{{ $pay->worker->first_name . " " . $pay->worker->last_name }}">
                                <img class="mini-photo" src="{{ $pay->worker->photo ? asset('/img/'.json_decode($pay->worker->photo)->min) : asset('img/user_profile.jpg') }}">
                            </a>
                        </td>
                        <td>{{ $pay->worker->first_name . " " . $pay->worker->last_name }}</td>
                        <td>{{ $pay->worker->position->name }}</td>
                        <td class="data-premium" data-rub-premium="{{ $pay->premium }}">{{ $pay->premium }}</td>
                        <td class="data-salary" data-rub-salary="{{ $pay->salary }}">{{ $pay->salary }}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            @if( count($payment) )
                @include('includes.pagination', [ 'paginator' => $payment ])
            @endif

        </div>

        <div id="test-swipe-2" class="col s12">
            
            <div class="row">
                <form class="col s6  add-employer">
                    <div class="row">
                        <div class="col s12">
                            <div class="hat">
                                <h3 class="title">Добавить сотрудника</h3>
                                <div class="photo">
                                    <img id="upload-photo" height="150">
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <input id="first_name" type="text" class="validate">
                            <label for="first_name">Имя</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">Фамилия</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="position">
                            <option value="" disabled selected>Укажите должность</option>
                            @foreach($professions as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                            </select>
                            <label>Должность</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="salary" type="number" min="1" step="1" class="validate">
                            <label for="salary">Оклад, <i class="fa fa-rub" aria-hidden="true"></i></label>
                        </div>
                        
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span>Загрузить фото</span>
                                <input type="file" id="upload-input">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload one or more files">
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <a class="waves-effect waves-light btn submit-employer">Создать</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>


    </div>

@endsection
