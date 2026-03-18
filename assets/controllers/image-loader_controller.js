import { Controller } from '@hotwired/stimulus';

/*
 * image-loader controller
 * Usage:
 * <div data-controller="image-loader" class="relative">
 *    <div data-image-loader-target="skeleton" class="animate-pulse bg-muted absolute inset-0 w-full h-full rounded-md"></div>
 *    <img src="..." data-image-loader-target="image" data-action="load->image-loader#onLoad" class="opacity-0 transition-opacity duration-300 w-full h-full object-cover rounded-md" />
 * </div>
 */
export default class extends Controller {
    static targets = ['skeleton', 'image'];

    connect() {
        // If the image is already complete (cached), trigger load manually
        if (this.hasImageTarget && this.imageTarget.complete) {
            this.onLoad();
        }
    }

    onLoad() {
        if (this.hasSkeletonTarget) {
            this.skeletonTarget.classList.add('hidden');
        }
        if (this.hasImageTarget) {
            this.imageTarget.classList.remove('opacity-0');
            this.imageTarget.classList.add('opacity-100');
        }
    }
}
