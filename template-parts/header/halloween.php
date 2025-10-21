<section class="halloween-section">
	<style>
		@keyframes ghost-jump {
			0%, 100% {
				transform: translateY(0);
			}
			50% {
				transform: translateY(-10px);
			}
		}

		.halloween-section {
			background: linear-gradient(90deg, #ea580c, #6B21D1, #ea580c);
			background-color: #ea580c;
			background-size: 200% 100%;
			background-position: 0% 50%;
			color: #fff;
			text-align: center;
			padding: 16px 20px;
			position: relative;
			overflow: hidden;
			letter-spacing: 0.05em;
		}

		.halloween-section a {
			color:rgb(243, 144, 90);
			text-decoration: underline;
		}

		.halloween-section .container {
			position: relative;
		}

		@media (min-width: 1024px) {
			.ghost-icon-ani {
				font-size: 24px;
				height: 1em;
				width: 1em;
				margin: 0 40px;
				display: inline-block;
				vertical-align: middle;
				animation: ghost-jump 1s infinite;
			}

			.ghost-icon-ani.is-right {
			}
		}
	</style>
	<div class="container">
		<span class="ghost-icon-ani" aria-hidden="true">👻</span>
		&nbsp;<strong>Halloween Sale! <a href="https://wcboost.com/plugin/woocommerce-variation-swatches/">Get 30% OFF</a> on All Plugins</strong>&nbsp;
		<span class="ghost-icon-ani is-right" aria-hidden="true">👻</span>
	</div>
</section>
