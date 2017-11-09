export default {
    computed: {
        /**
         * user role
         * @return {*}
         */
        currentUserRole() {
            return USER_ROLE;
        },

        /**
         * can write
         * @return {boolean}
         */
        canWrite() {
            if (USER_ROLE.indexOf(2) == -1) {
                return false;
            }
            return true
        },

        /**
         * can read
         * @return {boolean}
         */
        canRead() {
            if (USER_ROLE.indexOf(1) == -1) {
                return false;
            }
            return true
        }
    },
};