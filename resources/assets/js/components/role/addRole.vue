<template>

    <form @submit.prevent.once="saveRole()">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ trans('data.roleRoles') }}
                </p>
            </header>
            <section class="modal-card-body">
                <b-field :label="trans('data.roleName')">
                    <b-input
                            type="text"
                            v-model="role.name"
                            :placeholder="trans('data.roleName')"
                            required>
                    </b-input>
                </b-field>
            </section>

            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">{{ trans('data.cancel') }}</button>
                <button class="button is-primary" type="submit">{{ trans('data.save') }}</button>
            </footer>
        </div>
    </form>

</template>
<script>
    export default {

        mounted() {
            if (this.roleProp.id > 0) {
                this.role = _.cloneDeep(this.roleProp);
            }
        },

        props: {},

        data() {
            return {
                roleProp: this.$parent.props || 0,
                role: {},
            }
        },

        methods: {

            /**
             * save project
             */
            saveRole() {
                Api.post('v1', 'saveRole', this.getRoleData(this.role))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.$parent.close();
                        this.$root.$emit('getRoles');
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                    });
            },

            /**
             * get role data
             * @param role
             */
            getRoleData(role) {
                return {
                    id: role.id || 0,
                    name: role.name || ''
                };
            }
        }
    }
</script>