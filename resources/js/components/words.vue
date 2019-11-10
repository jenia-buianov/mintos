<template>
    <div>
        Here
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: "words",
        data() {
            return {
                words: [],
                loaded: false
            }
        },
        props:{
            check_url: String
        },
        created() {
            this.getWords();
        },
        methods: {
            getWords(){
                let self = this;
                axios.get(this.check_url).then(response => {
                    if (typeof response.data.words !== 'undefined'){
                        self.words = response.data.words;
                    }
                    this.loaded = true;
                })
            }
        }
    }
</script>
<style>
</style>
