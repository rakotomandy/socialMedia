/**
 * Application entry for client-side JavaScript.
 *
 * Purpose:
 * - Bootstraps third-party libraries and config via `bootstrap.js`.
 * - Import additional modules, event listeners, or UI initialization
 *   code here (WebSocket setup, Alpine/Livewire, event handlers).
 *
 * Usage:
 * - Keep this file small: import features and initialize them here.
 */
import { createInertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';
import { createRoot } from 'react-dom/client';
import './bootstrap';

/**
 * Initialize Inertia + React application.
 *
 * Note: ensure you have installed `@inertiajs/inertia`, `@inertiajs/inertia-react`,
 * and `@inertiajs/progress` via npm and `inertiajs/inertia-laravel` via composer.
 */
createInertiaApp({
	resolve: (name) => import(`./Pages/${name}`),
	setup({ el, App, props }) {
		createRoot(el).render(<App {...props} />);
	},
});

InertiaProgress.init();
