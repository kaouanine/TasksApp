import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/main.css'
import 'mdb-vue-ui-kit/css/mdb.min.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import store from './store/store';
import api from './axioss'
/* import 'bootstrap/dist/css/bootstrap.css';
 */import 'bootstrap/dist/js/bootstrap.bundle.min.js';


const authToken = localStorage.getItem('authToken');
if (authToken) {
  store.commit('setAuthToken', authToken);
}
const app = createApp(App)
app.config.globalProperties.http = api

app.use(router)
app.use(VueSweetalert2);
app.use(store)

app.mount('#app')
