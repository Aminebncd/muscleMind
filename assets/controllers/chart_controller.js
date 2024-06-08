// assets/controllers/chart_controller.js
import { Controller } from '@hotwired/stimulus';
import Chart from '@symfony/ux-chartjs';

export default class extends Controller {
    connect() {
        const data = JSON.parse(this.element.dataset.chartData);
        const options = JSON.parse(this.element.dataset.chartOptions || '{}');
        this.chart = new Chart(this.element, {
            type: this.element.dataset.chartType,
            data: data,
            options: options,
        });
    }
    
}

console.log('chart_controller.js loaded!');
