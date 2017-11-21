'use strict';
/**
 * class query for api
 */
export default class Query {

    constructor() {

        this.v1 = '/api/v1';

    }

    /**
     * get raw query
     * @param point
     * @param url
     * @param params
     * @return {*|AxiosPromise}
     */
    getRaw(point, url, params) {
        return axios.post(this[point] + url, params)
    }
}