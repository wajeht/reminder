import './bootstrap';
import '../css/app.css';
import 'primevue/resources/themes/lara-light-green/theme.css';

import { autoAnimatePlugin } from '@formkit/auto-animate/vue';
import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ToastService from 'primevue/toastservice';
import PrimeVue from 'primevue/config';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        // eslint-disable-next-line vue/component-api-style
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(autoAnimatePlugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, { pt: {} })
            .use(ToastService)
            .mount(el);
    },
    progress: {
        color: '#4e46dc',
    },
});
