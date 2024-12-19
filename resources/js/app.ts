// import './bootstrap';
// import '../css/app.css';

// import { createApp, h, DefineComponent } from 'vue';
// import { createInertiaApp } from '@inertiajs/vue3';
// import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
// import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// import PrimeVue from 'primevue/config';
// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
//     setup({ el, App, props, plugin }) {
//         createApp({ render: () => h(App, props) })
//             .use(plugin)
//             .use(ZiggyVue)
//             .mount(el);
//     },
//     progress: {
//         color: '#4B5563',
//     },
// });

import "./bootstrap";
import "../css/app.css";

import { createApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import Button from "primevue/button"; // Import the Button component
import "primeicons/primeicons.css";
import Avatar from "primevue/avatar";
import InputText from "primevue/inputtext";
import InputMask from "primevue/inputmask";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import Card from "primevue/card";
import Dialog from 'primevue/dialog';
import Message from "primevue/message";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { Form } from '@primevue/forms';
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(PrimeVue, { theme: { preset: Aura } })
            .use(ZiggyVue);

        // Register the Button component globally
        app.component("Button", Button);
        app.component("Avatar", Avatar);
        app.component("InputText", InputText);
        app.component("InputMask", InputMask);
        app.component("Calendar", Calendar);
        app.component("Dropdown", Dropdown);
        app.component('Dialog', Dialog);
        app.component("Card", Card);
        app.component("Message", Message);
        app.component("DataTable", DataTable);
        app.component("Column", Column);
        app.component("Form", Form);
        app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
