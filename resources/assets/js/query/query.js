'use strict';
/**
 * class query for api
 */
export default class Query {

    constructor() {

        this.v1 = '/v1';

    }

    /**
     * get raw query
     * @param point
     * @param url
     * @param params
     * @return {*|AxiosPromise}
     */
    post(point, action, params) {
        return axios.post(this[point] + '/' + action, params)
    };

    /**
     * serialize errors
     * @param errors
     * @returns {string}
     */
    errorSerializer(errors) {
        let data = '<ul>';

        for (let i in errors) {
            data += '<li>' + errors[i] + '</li>';
        }

        data += '</ul>';

        return data;
    }
}