<template>
<div>

    <div>
        <div>
            <label>Midi File</label>
            <input type="file" name="" accept="audio/midi" v-on:change="input($event)">
        </div>
        <div>
            <div>
                <input type="color" v-for="color in colors" :key="color.value" v-model="color.value">

            </div>
            <div>
                <button type="button" v-on:click="add">+</button>
                <button type="button" :disabled="canSub" v-on:click="sub">-</button>
            </div>
        </div>
        <button type="button" v-on:click="submit">Submit</button>
    </div>
    <div v-html="svg">
</div>
    </div>
</template>

<script>
    import "axios"
    import Axios from 'axios';
    export default {
        props: {
            endpoint: {
                type: String,
                required: true
            }
        },
        data: function () {
            return {
                midi : "",
                colors: [{"value": "#fff000"}, {"value": "#2b2b2b"}],
                svg: ""
            }
        },
        computed: {
            canSub: function () {
                return this.colors.length <= 2
            }
        },
        methods: {
            input: function (event) {
                this.midi = event.target.files[0];
                console.log(event.target.files[0])
                // this.$emit('input', event.target.value)
            },
            submit: function () {
                var bodyFormData = new FormData();
                bodyFormData.append('midi', this.midi),
                bodyFormData.append('colors', this.colors.map(x => x.value)),
                console.log(bodyFormData)
                Axios.post(this.$props.endpoint,
                        bodyFormData,
                        {
                            'Content-Type': 'multipart/form-data'
                        })
                    .then((response) => {
                        //handle success
                        console.log(response);
                        this.svg = response.data
                    })
                    .catch(function (response) {
                        //handle error
                        console.error(response);
                    });

            },
            add: function(){
                this.colors.push({"value": `#${Math.floor(Math.random()*16777215).toString(16)}`})
            },
            sub: function(){
                this.colors.pop()
            },
        }
    }

</script>
