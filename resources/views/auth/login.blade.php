@extends('layouts.app')

@section('title') Login @endsection

@section('content')
    <div id="login-form">
        <h2>Login</h2>
        <div class="content-block">
            <login-form inline-template>
                <form id="login-form-from" class="col-12" action="{{route('login')}}" method="post" @submit="submit">
                    <div class="form-group" :class="{'text-success':helpers.email.check, 'text-danger': helpers.email.error}">
                        <label>Email</label>
                        <input type="email" required v-on:keyup="checkEmail" v-model="form.email" required class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.email.show,'visible':helpers.email.show}">@{{ helpers.email.text }}</small>
                    </div>
                    <div class="form-group" :class="{'text-success':helpers.password.check, 'text-danger': helpers.password.error}">
                        <label>Password</label>
                        <input type="password" required v-model="form.password" class="form-control" placeholder="Password">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.password.show,'visible':helpers.password.show}">@{{ helpers.password.text }}</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </login-form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/login.js')}}"></script>
@endsection
