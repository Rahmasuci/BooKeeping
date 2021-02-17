require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'
import { InertiaProgress } from '@inertiajs/progress'

import titleMixin from './titleMixin'

import 'bootstrap/js/dist/modal'

import 'admin-lte/plugins/datatables/jquery.dataTables.min.js'
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'
import 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js'
import 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'

Vue.prototype.$route = route

Vue.mixin(titleMixin)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(plugin)

const el = document.getElementById('app')

if (el){
    new Vue({
        render: h => h(App, {
            props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
            },
        }),
    }).$mount(el)
}

InertiaProgress.init()

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
})