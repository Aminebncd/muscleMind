import { Controller } from 'stimulus';
import Chart from 'chart.js/auto';

export default class extends Controller {
  connect() {
    const canvas = this.element.querySelector('canvas');
    const chartData = JSON.parse(this.element.getAttribute('data-chart-data'));
    const chartType = this.element.getAttribute('data-chart-type');

    if (!canvas || !chartData || !chartType) {
      console.error('Missing canvas element, chart data, or chart type');
      return;
    }

    new Chart(canvas, {
      type: chartType,
      data: chartData
    });
  }
}

console.log('hello_controller.js loaded!');
