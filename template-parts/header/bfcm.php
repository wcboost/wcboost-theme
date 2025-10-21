<section id="bfcm-2025" class="bfcm-section" style="display: none;">
	<style>
		.bfcm-section {
			background-image: linear-gradient(135deg, #2e1853 0%, #2b1245 25%, #4c2a8c 50%, #663399 75%, #7b40b4 100%);
			background-size: 200% 100%;
			color: #fff;
			padding: 16px 20px;
			position: relative;
			overflow: hidden;
		}

		.bfcm-section__overlay {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.1) 1px, transparent 0);
			background-size: 20px 20px;
			pointer-events: none;
		}

		.bfcm-section__content {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 24px;
			max-width: 1200px;
			margin: 0 auto;
		}

		.gift-icon {
			font-size: 20px;
		}

		.bfcm-section__text {
			font-size: 18px;
			font-weight: 600;
			color: white;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.discount-highlight {
			color: #FFD700;
			font-weight: 800;
		}

		.code-pill {
			background: rgba(0, 0, 0, 0.15);
			padding: 8px;
			margin: 0 8px;
			border-radius: 6px;
			font-family: monospace;
			font-size: 16px;
			font-weight: bold;
			letter-spacing: 1px;
			border: 1px solid rgba(255, 255, 255, 0.15);
		}

		.learn-more {
			text-decoration: underline;
			color: #FFD700;
			font-weight: bold;
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
		}

		.countdown-label {
			font-size: 12px;
			opacity: 0.9;
		}

		@media (max-width: 767px) {
			.banner-content {
				flex-direction: column;
				gap: 12px;
				text-align: center;
			}

			.top-banner__text {
				flex-direction: column;
			}

			.countdown-wrapper {
				margin-top: 8px;
			}
		}
	</style>
	<div class="container">
		<div class="bfcm-section__overlay"></div>
		<div class="bfcm-section__content">
			<div class="bfcm-section__text">
				<span class="save-text">
					<span class="gift-icon">🎁</span>
					SAVE <span class="discount-highlight">50% OFF</span> Everything!
				</span>
				<span class="use-code">
					Use code: <span class="code-pill">BFCM2025</span>
				</span>
			</div>
			<div class="countdown-wrapper">
				<div class="countdown-item">
					<span class="countdown-number" data-days>01</span>
					<span class="countdown-label">days</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-hours>10</span>
					<span class="countdown-label">hr</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-minutes>22</span>
					<span class="countdown-label">min</span>
				</div>
				<div class="countdown-item">
					<span class="countdown-number" data-seconds>07</span>
					<span class="countdown-label">sec</span>
				</div>
			</div>
		</div>
	</div>

	<script>
		(function() {
			const bfcmSection = document.querySelector('#bfcm-2025');

			function updateCountdown() {
				const now = new Date();
				const endDate = new Date('2025-12-03T23:59:59'); // Adjust this date as needed
				const diff = endDate - now;

				if (diff <= 0) {
					return;
				}

				const days = Math.floor(diff / (1000 * 60 * 60 * 24));
				const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				const seconds = Math.floor((diff % (1000 * 60)) / 1000);

				bfcmSection.querySelector('[data-days]').textContent = days.toString().padStart(2, '0');
				bfcmSection.querySelector('[data-hours]').textContent = hours.toString().padStart(2, '0');
				bfcmSection.querySelector('[data-minutes]').textContent = minutes.toString().padStart(2, '0');
				bfcmSection.querySelector('[data-seconds]').textContent = seconds.toString().padStart(2, '0');

				bfcmSection.style.display = 'block';
			}

			setInterval(updateCountdown, 1000);
		});
	</script>
</section>
