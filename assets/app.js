// assets/app.js
import { registerReactControllerComponents } from '@symfony/ux-react';

import './styles/app.css';

import './bootstrap.js';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));
