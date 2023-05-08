import { createApp } from 'vue'
import store from './store'
import './index.css'
import App from './App.vue'
import router from "./router";
import currencyEUR from './filters/currency.js'

const app = createApp(App);

app
    .use(store)
    .use(router)
    .mount('#app')
;

app.config.globalProperties.$filters = {
    currencyEUR
}
