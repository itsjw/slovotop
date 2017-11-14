export default {
    computed: {
        /**
         * access menu
         * @return {*}
         */
        accessMenu() {
            return ACCESS;
        },
        /**
         * return user roles
         * @return {*}
         */
        userRole() {
            return ROLE;
        },
        /**
         * is admin
         * @return {boolean}
         */
        isAdmin() {
            if (ROLE.indexOf(1) == -1) {
                return false;
            }
            return true;
        }
    },
};