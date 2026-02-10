/**
 * Bootstrap JavaScript utilities for the app.
 *
 * Responsibilities:
 * - Provide a shared `axios` instance for AJAX requests.
 * - Configure common headers such as `X-Requested-With` and (optionally)
 *   the CSRF token for secure POST requests.
 */
import axios from 'axios';
window.axios = axios;

// Identify requests as AJAX for server-side handling
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// If a CSRF token meta tag exists in the page, automatically attach it
// to axios so Laravel's CSRF protections receive the header on POST/PUT/DELETE.
const tokenMeta = document.head.querySelector('meta[name="csrf-token"]');
if (tokenMeta) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = tokenMeta.content;
}
