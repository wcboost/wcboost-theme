<section id="black-friday-banner" class="black-friday-section" style="display: none;">
	<style>
		.black-friday-section {
			background-image: linear-gradient(135deg, #000000 0%, #1a0000 25%, #2d0000 50%, #000000 75%, #1a0000 100%);
			background-size: 200% 100%;
			color: #fff;
			padding: 16px 20px;
			position: relative;
			overflow: hidden;
		}

		.black-friday-section__overlay {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.1) 1px, transparent 0);
			background-size: 20px 20px;
			pointer-events: none;
		}

		.black-friday-section__content {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 24px;
			max-width: 1200px;
			margin: 0 auto;
		}

		.fire-icon {
			font-size: 20px;
		}

		.black-friday-section__text {
			font-size: 18px;
			font-weight: 600;
			color: white;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.deal-highlight {
			color: #FFD700;
			font-weight: 800;
		}

		.countdown-wrapper {
			display: flex;
			gap: 12px;
			align-items: center;
		}

		.countdown-item {
			display: flex;
			flex-direction: column;
			align-items: center;
			min-width: 45px;
		}

		.countdown-number {
			font-size: 20px;
			font-weight: bold;
			line-height: 1;
			color: #FFD700;
		}

		.countdown-label {
			font-size: 12px;
			opacity: 0.9;
		}

		@media (max-width: 767px) {
			.black-friday-section__content {
				flex-direction: column;
				gap: 12px;
				text-align: center;
			}

			.black-friday-section__text {
				flex-direction: column;
			}

			.countdown-wrapper {
				margin-top: 8px;
			}
		}
	</style>
	<div class="container">
		<div class="black-friday-section__overlay"></div>
		<div class="black-friday-section__content">
			<div class="black-friday-section__text">
				<span class="launch-text">
					<span class="fire-icon">🔥</span>
					Black Friday Deal <span class="deal-highlight">Launching Soon!</span>
				</span>
			</div>
			<div class="countdown-wrapper">
				<div class="countdown-item">
					<span class="countdown-number" data-days>00</span>
					<span class="countdown-label">days</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-hours>00</span>
					<span class="countdown-label">hr</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-minutes>00</span>
					<span class="countdown-label">min</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-seconds>00</span>
					<span class="countdown-label">sec</span>
				</div>
			</div>
		</div>
	</div>

	<script>
		(function() {
			const blackFridaySection = document.querySelector('#black-friday-banner');

			function updateCountdown() {
				const now = new Date();
				// Black Friday 2025 launch day: November 17, 2025
				const launchDate = new Date('2025-11-17T00:00:00');
				const diff = launchDate - now;

				if (diff <= 0) {
					blackFridaySection.style.display = 'none';
					return;
				}

				const days = Math.floor(diff / (1000 * 60 * 60 * 24));
				const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				const seconds = Math.floor((diff % (1000 * 60)) / 1000);

				blackFridaySection.querySelector('[data-days]').textContent = days.toString().padStart(2, '0');
				blackFridaySection.querySelector('[data-hours]').textContent = hours.toString().padStart(2, '0');
				blackFridaySection.querySelector('[data-minutes]').textContent = minutes.toString().padStart(2, '0');
				blackFridaySection.querySelector('[data-seconds]').textContent = seconds.toString().padStart(2, '0');

				blackFridaySection.style.display = 'block';
			}

			updateCountdown();
			setInterval(updateCountdown, 1000);
		})();
	</script>
</section>
