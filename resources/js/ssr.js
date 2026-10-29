import { createInertiaApp } from '@inertiajs/svelte'
import createServer from '@inertiajs/svelte/server'
import { render } from 'svelte/server'
import Layout from './Layout.svelte'

createServer(
    (page) =>
        createInertiaApp({
            page,
            layout: () => Layout,
            resolve: (name) => {
                const pages = import.meta.glob('./Pages/**/*.svelte')

                return pages[`./Pages/${name}.svelte`]()
            },
            setup({ App, props }) {
                return render(App, { props })
            },
        }),
    { host: '127.0.0.1' },
)
