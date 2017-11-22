'use strict';
/**
 * class query for api
 */
export default class Query {

    constructor() {

        this.v1 = 'v1/';

    }

    /**
     * get raw query
     * @param point
     * @param url
     * @param params
     * @return {*|AxiosPromise}
     */
    getPost(point, section, action, params) {
        return axios.post(this[point] + section + '/' + action, params)
    }
}