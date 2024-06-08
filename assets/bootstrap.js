// Import Stimulus library
import { Application } from '@hotwired/stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';

// Import all controllers from the 'controllers' directory
const context = require.context('./controllers', true, /\.js$/);
const application = Application.start();
application.load(definitionsFromContext(context));

console.log('boostrap.js loaded!');