// assets/app.js 
import { Application } from '@hotwired/stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';
import '@symfony/ux-chartjs';



// Import all Stimulus controllers from the controllers directory
const context = require.context('./controllers', true, /\.js$/);
const application = Application.start();
application.load(definitionsFromContext(context));

// Import other necessary files
import './bootstrap.js';
import './styles/app.css';



console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');