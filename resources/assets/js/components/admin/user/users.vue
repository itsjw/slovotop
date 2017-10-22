<template>
    <div>
        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon ui-color col-green hover"
                       @click="getUsers()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="10%" class="left">{{ trans('data.userName') }}</th>
                <th width="15%" class="left">{{ trans('data.userSurname') }}</th>
                <th width="15%" class="left">{{ trans('data.userEmail') }}</th>
                <th width="10%">{{ trans('data.userConfirm') }}</th>
                <th width="20%">{{ trans('data.userRole') }}</th>
                <th width="10%">{{ trans('data.userCreated_at') }}</th>
                <th width="10%">{{ trans('data.userUpdated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="ui-bg bg-greyBlueLL hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in users"
                @click="selectUsers(val.id)">
                <td>
                    <input type="checkbox" :id="key" :value="val.id" v-model="selectUser"/>
                    <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td class="left">{{ val.surname }}</td>
                <td class="left">{{ val.email }}</td>
                <td>{{ val.confirm == 1 ? trans('data.yes') : trans('data.no') }}</td>
                <td>
                    <span v-for="(item,k) in val.roles">
                        {{ item.role[0].name }}
                    </span>
                </td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.getUsers();
        },
        props: [],
        data() {
            return {
                users: {},
                selectUser: []
            }
        },
        methods: {
            /**
             * get all users
             */
            getUsers() {
                this.selectUser = [];
                gql.getItem('v1', 'UserQuery', false, 'user')
                    .then(response => {
                        this.users = response.data.data.UserQuery;
                    })
            },

            /**
             * select users
             * @param id
             */
            selectUsers(id) {
                if (this.selectUser.indexOf(id) == -1) {
                    this.selectUser.push(id);
                } else {
                    this.selectUser.splice(this.selectUser.indexOf(id), 1);
                }
            },
        }
    }
</script>