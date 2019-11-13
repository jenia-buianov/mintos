@extends('layouts.app')

@section('title') Register @endsection

@section('content')
    <div id="register-form">
        <h2>Register</h2>
        <div class="content-block">
            <register-form :check_url="{{json_encode(route('check'))}}" inline-template>
                <form id="register-form-from" class="col-12" action="{{route('register')}}" method="post" @submit="submit">
                    <div class="form-group" :class="{'text-success':helpers.name.check, 'text-danger': helpers.name.error}">
                        <label>Name</label>
                        <input type="text" v-model="form.name" name="name" v-on:keyup="checkName"  class="form-control" placeholder="Enter your name">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.name.show,'visible':helpers.name.show}">@{{ helpers.name.text }}</small>
                    </div>
                    <div class="form-group" :class="{'text-success':helpers.email.check, 'text-danger': helpers.email.error}">
                        <label>Email</label>
                        <input type="email" name="email" required v-on:keyup="checkEmail" v-model="form.email" required class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.email.show,'visible':helpers.email.show}">@{{ helpers.email.text }}</small>
                    </div>
                    <div class="form-group" :class="{'text-success':helpers.password.check, 'text-danger': helpers.password.error}">
                        <label>Password</label>
                        <input type="password" name="password" required v-on:keyup="passwordCheck" v-model="form.password" class="form-control" placeholder="Password">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.password.show,'visible':helpers.password.show}">@{{ helpers.password.text }}</small>
                    </div>
                    <div class="form-group" :class="{'text-success':helpers.password_confirmation.check, 'text-danger': helpers.password_confirmation.error}">
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" required v-on:keyup="confirmationCheck" v-model="form.password_confirmation" class="form-control" placeholder="Repeat password">
                        <small class="form-text text-muted" :class="{'hidden':!helpers.password_confirmation.show,'visible':helpers.password_confirmation.show}">@{{ helpers.password_confirmation.text }}</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </form>
            </register-form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/register.js')}}"></script>
@endsection
