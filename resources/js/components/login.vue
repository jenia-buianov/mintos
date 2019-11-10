<template>
    <div>
        Here
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: "login-form",
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                helpers:{
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
                axios.post($('#login-form-from').attr('action'), this.form).then(response => {
                    if (response.data.logged){
                        window.location.replace(response.data.redirect);
                    }else{
                        for(let key in response.data.errors){
                            this.helpers[key].error = true;
                            this.helpers[key].check = false;
                            this.helpers[key].show = true;
                            this.helpers[key].text = response.data.errors[key][0];
                        }
                    }
                })
            },
            checkEmail: function(event){
                let rule = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (this.form.email.length>0 && rule.test(this.form.email)){
                    this.helpers.email.check = true;
                    this.helpers.email.show = false;
                    this.helpers.email.error = false;
                }else {
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
