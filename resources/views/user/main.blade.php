@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')
@section('title')
    Личный кабинет
@endsection
@section('content')
    <div class="container" id="Tasks">
        <div class="row  mt-5  col-12  text-center"><h2>Добро пожаловать, {{Auth::user()->fname}} {{Auth::user()->lname}}</h2></div>
        <div class="row  mt-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Создать задачу
            </button>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Создание задачи</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" @submit.prevent="CreateTask()" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Заголовок</label>
                                <input type="text" class="form-control" id="title" name="title" :class="errors.title ? 'is-invalid' : ''" title="Это поле обязательное,&#013;может содержать только кириллицу и латиницу">
                                <div :class="errors.title ? 'invalid-feedback' : ''" v-for="error in errors.title">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Категория</label>
                                <select class="form-select" name="category" id="category">
                                    <option value="важно, не срочно">важно, не срочно</option>
                                    <option value="важно, срочно">важно, срочно</option>
                                    <option value="неважно, не срочно">неважно, не срочно</option>
                                    <option value="важно, срочно">важно, срочно</option>
                                </select>
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between; flex-direction: row; width: 100%">
                                <div style="width: 45%">
                                    <label for="date_start" class="form-label">Дата начала</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" :class="errors.date_start ? 'is-invalid' : ''" title="Это поле обязательное" style="width: 100%">
                                    <div :class="errors.date_start ? 'invalid-feedback' : ''" v-for="error in errors.date_start">
                                        @{{ error }}
                                    </div>
                                </div>
                                <div style="width: 45%">
                                    <label for="time_start" class="form-label">Время начала</label>
                                    <input type="time" class="form-control" id="time_start" name="time_start" :class="errors.time_start ? 'is-invalid' : ''" title="Это поле обязательное" style="width: 100%">
                                    <div :class="errors.time_start ? 'invalid-feedback' : ''" v-for="error in errors.time_start">
                                        @{{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between; flex-direction: row; width: 100%">
                                <div style="width: 45%">
                                    <label for="date_end" class="form-label">Дата окончания</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end" :class="errors.date_end ? 'is-invalid' : ''" title="Это поле обязательное" style="width: 100%">
                                    <div :class="errors.date_end ? 'invalid-feedback' : ''" v-for="error in errors.date_end">
                                        @{{ error }}
                                    </div>
                                </div>
                                <div style="width: 45%">
                                    <label for="time_end" class="form-label">Время окончания</label>
                                    <input type="time" class="form-control" id="time_end" name="time_end" :class="errors.time_end ? 'is-invalid' : ''" title="Это поле обязательное" style="width: 100%">
                                    <div :class="errors.time_end ? 'invalid-feedback' : ''" v-for="error in errors.time_end">
                                        @{{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Описание</label>
                                <textarea class="form-control" name="text" id="text" style="max-height: 200px; min-height: 100px" :class="errors.text ? 'is-invalid' : ''" title="Это поле обязательное"></textarea>
                                <div :class="errors.text ? 'invalid-feedback' : ''" v-for="error in errors.text">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Изображение</label>
                                <input type="file" class="form-control" id="img" name="img" :class="errors.img ? 'is-invalid' : ''" title="Это поле обязательное">
                                <div :class="errors.img ? 'invalid-feedback' : ''" v-for="error in errors.img">
                                    @{{ error }}
                                </div>
                            </div>
                            <button type="submit" class="btn  btn-primary  col-12">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row  mt-5">
                <form action="{{route('Filter')}}" method="post" style="padding: 0; display: flex; align-items: center; justify-content: space-between">
                    @csrf
                    @method('post')
                    <button class="btn  btn-secondary" name="filter" value="все" style="width: 33%;">Все</button>
                    <button class="btn  btn-outline-success" name="filter" value="новая" style="width: 33%;">Новые</button>
                    <button class="btn  btn-success" name="filter" value="выполнена" style="width: 33%;">Выполненные</button>
                </form>
        </div>
        <div class="row  mt-5  justify-content-center">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Изображение</th>
                        <th scope="col">Начало</th>
                        <th scope="col">Окончание</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <th scope="row"> {{$task->id}} </th>
                        <td> {{$task->title}} </td>
                        <td> {{$task->category}} </td>
                        <td> {{$task->text}} </td>
                        <td>
                            <div style="height: 50px; width: 80px; overflow: hidden">
                                <img style="width: 100%; height: auto; object-fit: cover" src="{{$task->img}}" alt="{{$task->title}}">
                            </div>
                        </td>
                        <td> {{$task->date_start}} {{$task->time_start}} </td>
                        <td> {{$task->date_end}} {{$task->time_end}} </td>
                        <td>{{$task->status}}</td>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: flex-end; flex-direction: row">
                                <form action="{{route('UpdateTask', ['task'=>$task])}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="btn @if($task->status == 'новая') btn-outline-success @else btn-success @endif" title="Изменить статус задачи" style="width: 40px; height: 40px; border-radius: 20px; margin-right: 10px;">✓</button>
                                </form>
                                <form action="{{route('DeleteTask', ['task'=>$task])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn  btn-danger" title="Удалить задачу" style="width: 40px; height: 40px;">X</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const Tasks = {
            data() {
                return {
                    errors: [],
                    message: '',
                    tasks: []
                }
            },
            methods: {
                async CreateTask() {
                    const formData = new FormData(document.querySelector('#form'));
                    const response = await fetch('{{route('CreateTask')}}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        body: formData
                    });
                    if (response.status === 200) {
                        location.reload();
                    }
                    if (response.status === 400) {
                        this.errors = await response.json();
                    }
                },
                // async DeleteTask() {
                //
                // },
                // async UpdateTask() {
                //
                // }
            }
        }
        Vue.createApp(Tasks).mount('#Tasks');
    </script>
@endsection
