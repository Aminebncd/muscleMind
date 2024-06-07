console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

import { Application } from 'stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';

// Import all Stimulus controllers from the controllers directory
const context = require.context('./controllers', true, /\.js$/);
const application = Application.start();
application.load(definitionsFromContext(context));

// Import other necessary files
import './bootstrap.js';
import './styles/app.css';


