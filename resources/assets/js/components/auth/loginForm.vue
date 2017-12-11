<template>
    <section class="container">
        <div class="column is-4 is-offset-4">

            <b-field :label="trans('data.userEmail')">
                <b-input type="email" icon="email"
                         v-model="email"
                         :placeholder="trans('data.userEmail')">
                </b-input>
            </b-field>


            <b-field :label="trans('data.userPassword')">
                <b-input type="password" icon="key"
                         v-model="password"
                         :placeholder="trans('data.userPassword')"
                         password-reveal>
                </b-input>
            </b-field>

            <div class="field">
                <b-checkbox v-model="remember">
                    {{ trans('data.userRemember') }}
                </b-checkbox>
            </div>

            <button type="button" class="button is-primary" @click="login()">
                {{ trans('data.login') }}
            </button>

        </div>
    </section>
</template>

<style scoped>

</style>

<script>
    export default {

        name: "login-form",

        mounted() {
        },

        props: {},

        data() {
            return {
                email: '',
                password: '',
                remember: false,
            }
        },

        methods: {

            login() {
                Api.postRaw('auth', {email: this.email, password: this.password, remember: this.remember})
                    .then(response => {
                        window.location = response.data;
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data),
                            type: 'is-danger'
                        });
                    });
            }

        }
    }
</script>