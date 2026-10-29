import { createInertiaApp } from '@inertiajs/svelte'
import { hydrate, mount } from 'svelte'
import Layout from './Layout.svelte'
import '../css/app.css'

const appName = 'Muhammad Rizkiansyah'

createInertiaApp({
    title: (title) => (title ? `${title} — ${appName}` : appName),
    layout: () => Layout,
    progress: {
        color: '#fbbf24',
    },
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.svelte')

        return pages[`./Pages/${name}.svelte`]()
    },
    setup({ el, App, props }) {
        if (el.dataset.serverRendered === 'true') {
            hydrate(App, { target: el, props })
        } else {
            mount(App, { target: el, props })
        }
    },
})
