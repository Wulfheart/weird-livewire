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
                    <button type="button" v-on:click="randomGradient">Random Gradient</button>
                </div>
                <div>
                    <label>Fill Opacity</label>
                    <input type="range" v-model="fillOpacity" min="10" max="100" step="5"> {{ fillOpacity / 100 }}
                </div>
            </div>
            <button type="button" v-on:click="submit">Submit</button>
        </div>
        <div v-html="svg">
        </div>
    </div>
</template>

<script>
    import gradients from './gradients/gradients.json'
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
                midi: "",
                colors: [],
                fillOpacity: 50,
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
                        bodyFormData, {
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
            randomGradient: function () {
               console.log("grad")
                this.colors = gradients[Math.floor(Math.random() * gradients.length)].colors.map(x => ({
                    value: x
                }))
            },
            add: function () {
                this.colors.push({
                    "value": `#${Math.floor(Math.random()*16777215).toString(16)}`
                })
            },
            sub: function () {
                this.colors.pop()
            },
        },
        mounted: function () {
            
            // `this` points to the vm instance
            this.randomGradient()
        }
    }

</script>
