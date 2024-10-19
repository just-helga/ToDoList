@extends('layout.app')
@section('title')
    Регистрация
@endsection
@section('content')
    <div class="container" id="Registration">
        <div class="row  mt-5  col-12  text-center"><h2>Регистрация</h2></div>
        <div class="row  mt-5  justify-content-center">
            <div class="col-6">
                <form id="formRegistration" @submit.prevent="Registration">
                    <div class="mb-3">
                        <label for="fname" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="fname" name="fname" :class="errors.fname ? 'is-invalid' : ''" title="Это поле обязательное,&#013;может содержать только кириллицу, пробел и тире">
                        <div :class="errors.fname ? 'invalid-feedback' : ''" v-for="error in errors.fname">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="lname" name="lname" :class="errors.lname ? 'is-invalid' : ''" title="Это поле обязательное,&#013;может содержать только кириллицу, пробел и тире">
                        <div :class="errors.lname ? 'invalid-feedback' : ''" v-for="error in errors.lname">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" :class="errors.email ? 'is-invalid' : ''" title="Это поле обязательное,&#013;может содержать только адрес электронной почты">
                        <div :class="errors.email ? 'invalid-feedback' : ''" v-for="error in errors.email">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" :class="errors.password ? 'is-invalid' : ''" title="Это поле обязательное,&#013;минимальная длина пароля - 6 символов">
                        <div :class="errors.password ? 'invalid-feedback' : ''" v-for="error in errors.password">
                            <template  v-if="error !== 'Пароли не совпадают'">
                                @{{ error }}
                            </template>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" :class="errors.password ? 'is-invalid' : ''">
                        <div :class="errors.password ? 'invalid-feedback' : ''" v-for="error in errors.password">
                            <template  v-if="error == 'Пароли не совпадают'">
                                @{{ error }}
                            </template>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input  form-che" id="rules" name="rules" :class="errors.rules ? 'is-invalid' : ''">
                        <label class="form-check-label" for="rules">Согласие на обработку персональных данных</label>
                        <div :class="errors.rules ? 'invalid-feedback' : ''" v-for="error in errors.rules">
                            @{{ error }}
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-primary  col-12">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const Registration = {
            data() {
                return {
                    errors: [],
                }
            },
            methods:{
                async Registration() {
                    //получение формы и ее данных
                    const form = document.querySelector('#formRegistration');
                    const formData = new FormData(form);
                    //запрос
                    const response = await fetch('{{route('Registration')}}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN' : '{{csrf_token()}}',
                        },
                        body: formData
                    });
                    if(response.status === 400) {
                        this.errors = await response.json();
                    }
                    if (response.status === 200) {
                        window.location = response.url;
                    }
                }
            }
        }
        Vue.createApp(Registration).mount('#Registration')
    </script>
@endsection
