<template>
    <div>
        <div>
            <label>Midi File</label>
            <input type="file" name="" accept="audio/midi" v-on:input="input" :value="midi.value">
        </div>
        <div>
            <input type="color" name="" id="">
        </div>
        <button type="button" v-on:click="submit">Submit</button>
    </div>
</template>

<script>
    import "axios"
    import Axios from 'axios';
    export default {
        data: function () {
            return {
                midi: {
                    value: ""
                },

            }
        },
        methods: {
            input: function (event) {
                this.midi.value = event.target.value;
                console.log(event.target.value)
                this.$emit('input', event.target.value)
            },
            submit: function () {
                bodyFormData = new FormData();
                bodyFormData.append('midi', midi.value)
                Axios.post('./visualize',
                        bodyFormData,
                        {
                            'Content-Type': 'multipart/form-data'
                        })
                    .then(function (response) {
                        //handle success
                        console.log(response);
                    })
                    .catch(function (response) {
                        //handle error
                        console.log(response);
                    });

            }
        }
    }

</script>
