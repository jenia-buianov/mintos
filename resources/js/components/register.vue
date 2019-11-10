<template>
    <div>
        Here
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: "register-form",
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    name: ''
                },
                helpers:{
                    name: {
                        text: 'Name must have 3 characters',
                        show: false,
                        check: false,
                        error: false
                    },
                    email:{
                        text: 'Please enter valid email',
                        show: false,
                        check: false,
                        error: false
                    },
                    password:{
                        text: 'Password must have a letter and a number, min length 8 characters',
                        show:false,
                        check: false,
                        error: false
                    },
                    password_confirmation:{
                        text: 'Password is not equal with entered up',
                        show: false,
                        check: false,
                        error: false
                    }
                }
            }
        },
        props:{
            check_url: String
        },
        created() {

        },
        methods: {
            submit(event){
                event.preventDefault();
                axios.post($('#register-form-from').attr('action'), this.form).then(response => {
                    if (typeof response.data.passed){
                        if (response.data.passed){
                            window.location.replace(response.data.redirect);
                        }
                        else{
                            for(let key in response.data.errors){
                                this.helpers[key].error = true;
                                this.helpers[key].check = false;
                                this.helpers[key].show = true;
                                this.helpers[key].text = response.data.errors[key][0];
                            }
                        }
                    }
                })
            },
            checkName: function(event){
                let rule = /^(?=.*[A-z])\w{3,}/;
                this.helpers.email.error = false;
                this.helpers.name.check = rule.test(this.form.name);
                if (this.form.name.length>0 && rule.test(this.form.name)){
                    this.helpers.name.show = false;
                }
                else this.helpers.name.show = true;
            },
            passwordCheck:function (event) {
                let rule = /^(?=.*\d)(?=.*[A-z])\w{8,}/;
                this.helpers.password.check = rule.test(this.form.password);
                this.helpers.email.error = false;
                if (this.form.password.length>0 && rule.test(this.form.password)){
                    this.helpers.password.show = false;
                }
                else this.helpers.password.show = true;
            },
            confirmationCheck: function(event){
                if (this.form.password.length>0 && this.form.password_confirmation.length>0){
                    this.helpers.email.error = false;
                    this.helpers.password_confirmation.check = this.form.password==this.form.password_confirmation;
                    if (this.form.password==this.form.password_confirmation){
                        this.helpers.password_confirmation.show = false;
                    }
                    else this.helpers.password_confirmation.show = true;
                }
            },
            checkEmail: function(event){
                let rule = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (this.form.email.length>0 && rule.test(this.form.email)){
                    axios.post(this.check_url, {
                        email: this.form.email,
                    }).then(response => {
                        if(typeof response.data.checked!=="undefined"){
                            this.helpers.email.show = true;
                            this.helpers.email.text = response.data.message;
                            this.helpers.email.check = response.data.checked;
                            if (response.data.checked==false)
                                this.helpers.email.error = true;
                            else this.helpers.email.error = false;
                        }
                    })
                }else {
                    this.helpers.email.error = false;
                    this.helpers.email.check = false;
                    this.helpers.email.show = true;
                    this.helpers.email.text =  "Please enter valid email";
                }
            }
        }
    }
</script>
<style>
</style>
