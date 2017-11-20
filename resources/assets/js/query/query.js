'use strict';
/**
 * class query for graphQL
 */
export default class Query {

    constructor() {

        this.v1 = '/apps/v1';
        this.v2 = '/apps/v2';
        this.id = `id,notify`;
        this.menu = `id,name,slug,refer,roles{access}`;
        this.role = `id,name,created_at,updated_at,count`;
        this.user = `id,name,email,roles{id,role{${this.role}}},confirm,created_at,tasksCount,up_price,note,
                        lastLogin{updated_at}`;
        this.project = `id,name,site,user{${this.user}},created_at,updated_at`;
        this.doc = `id,name,body,created_at,updated_at,roles{id,name,access,role_id},user{id,name}`;
        this.subject = `id,name,price,created_at,updated_at`;
        this.stage = `id,name,priority,price,created_at,updated_at,roles{access}`;
    }

    /**
     * get items
     * @param url
     * @param item
     * @param select
     * @param params
     * @return {*|AxiosPromise}
     */
    getItem(url, item, select, params) {

        let querytoapi;

        if (select) {
            querytoapi = this.clearQuery(`{ ${item} ( ${select} ) { ${this[params]} } }`);
        } else {
            querytoapi = this.clearQuery(`{ ${item} { ${this[params]} } }`);
        }

        return axios.post(this[url], ({query: querytoapi}));
    }

    /**
     * set items
     * @param url
     * @param item
     * @param select
     * @param params
     * @return {*|AxiosPromise}
     */
    setItem(url, item, select, params = 'id') {

        let querytoapi = this.clearQuery(`mutation { ${item} ( ${select} ) { ${this[params]} } }`);

        return axios.post(this[url], ({query: querytoapi}));
    }

    /**
     * clear query
     * @param strings
     */
    clearQuery(strings) {
        return strings.replace(/\t*\n*\s{2,}/gi, '');
    }

    /**
     * get raw query
     * @param url
     * @param params
     * @return {*|AxiosPromise}
     */
    getRaw(url, params) {
        return axios.post('/api/' + url, params)
    }
}