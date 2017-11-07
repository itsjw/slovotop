'use strict';
export default class Notify {

    constructor() {
        this.base = 'ui-notify success animated fadeInDown';
        this.alert = 'ui-notify alert animated fadeInDown';
        this.success = 'ui-notify success animated fadeInDown';
        this.check = '<div class="ui-grid-1"><i class="ui-icon ui-pr-2">check</i></div>';
        this.data = '';
        this.time = 5;
    }

    /**
     * make notify
     * @param event
     * @param data
     * @param time
     */
    make(event = 'base', data, time = this.time) {
        this.data = this.makeData(data);
        let block = this.showBlock(this[event]);

        let self = this;
        setTimeout(function () {
            self.removeBlock(block)
        }, (time * 1000));
    }

    /**
     * prepare data
     * @param data
     * @return {string}
     */
    makeData(data) {
        let type = typeof data,
            html = '';

        switch (type) {
            case 'string':
                html = '<div class="ui-grid-block top ui-mt-1">' + this.check;
                html += '<div class="ui-grid-11">' + data + '</div>';
                html += '</div>';
                break;
            case 'object':
                for (let val in data) {
                    html += '<div class="ui-grid-block top ui-mt-1">' + this.check;
                    html += '<div class="ui-grid-11">' + data[val][0] + '</div>';
                    html += '</div>';
                }
                break;
        }

        return html;
    }

    /**
     * show block
     * @param event
     * @return {Element}
     */
    showBlock(event) {
        let div = document.createElement('div');
        div.className = event;
        div.innerHTML = this.data;
        document.body.insertBefore(div, document.body.firstChild);

        return div;
    }

    /**
     * remove block
     * @param block
     */
    removeBlock(block) {
        document.body.removeChild(block);
    }
}