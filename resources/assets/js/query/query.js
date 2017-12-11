'use strict';
/**
 * class query for api
 */
export default class Query {

    constructor() {

        this.v1 = '/v1';

    }

    /**
     * get post query
     * @param point
     * @param url
     * @param params
     * @return {*|AxiosPromise}
     */
    post(point, action, params) {
        return axios.post(this[point] + '/' + action, params)
    };

    /**
     * get raw post
     * @param point
     * @param params
     * @returns {*|void}
     */
    postRaw(point, params) {
        return axios.post(point, params);
    }

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