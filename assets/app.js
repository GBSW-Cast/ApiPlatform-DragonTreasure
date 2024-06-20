import { registerVueControllerComponents } from '@symfony/ux-vue';
// assets/app.js
import { registerReactControllerComponents } from '@symfony/ux-react';

import './styles/app.css';

import './bootstrap.js';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));