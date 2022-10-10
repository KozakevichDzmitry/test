<?php

function instagram_share_icon()
{
	ob_start();
	$html = ob_start();
?>
	<svg width="30" height="33" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect width="30" height="30" fill="#F2F2F2" />
		<g filter="url(#filter0_d_92_17159)">
			<path d="M14.9973 11.6652C13.1611 11.6652 11.6626 13.1638 11.6626 15C11.6626 16.8362 13.1611 18.3348 14.9973 18.3348C16.8335 18.3348 18.332 16.8362 18.332 15C18.332 13.1638 16.8335 11.6652 14.9973 11.6652ZM24.9989 15C24.9989 13.6191 25.0114 12.2506 24.9338 10.8722C24.8563 9.27113 24.4911 7.85017 23.3203 6.67938C22.147 5.50609 20.7286 5.14334 19.1275 5.06579C17.7466 4.98824 16.3782 5.00074 14.9998 5.00074C13.6189 5.00074 12.2505 4.98824 10.8721 5.06579C9.27105 5.14334 7.85012 5.50859 6.67935 6.67938C5.50608 7.85267 5.14334 9.27113 5.06579 10.8722C4.98824 12.2531 5.00074 13.6216 5.00074 15C5.00074 16.3784 4.98824 17.7494 5.06579 19.1278C5.14334 20.7289 5.50858 22.1498 6.67935 23.3206C7.85262 24.4939 9.27105 24.8567 10.8721 24.9342C12.253 25.0118 13.6214 24.9993 14.9998 24.9993C16.3807 24.9993 17.7491 25.0118 19.1275 24.9342C20.7286 24.8567 22.1495 24.4914 23.3203 23.3206C24.4936 22.1473 24.8563 20.7289 24.9338 19.1278C25.0139 17.7494 24.9989 16.3809 24.9989 15ZM14.9973 20.131C12.1579 20.131 9.86644 17.8394 9.86644 15C9.86644 12.1606 12.1579 9.86903 14.9973 9.86903C17.8367 9.86903 20.1282 12.1606 20.1282 15C20.1282 17.8394 17.8367 20.131 14.9973 20.131ZM20.3383 10.8572C19.6754 10.8572 19.14 10.3218 19.14 9.65889C19.14 8.99594 19.6754 8.46058 20.3383 8.46058C21.0013 8.46058 21.5366 8.99594 21.5366 9.65889C21.5368 9.81631 21.5059 9.97222 21.4458 10.1177C21.3856 10.2632 21.2974 10.3954 21.1861 10.5067C21.0748 10.618 20.9426 10.7062 20.7971 10.7664C20.6516 10.8265 20.4957 10.8574 20.3383 10.8572Z" fill="url(#paint0_linear_92_17159)" />
		</g>
		<defs>
			<filter id="filter0_d_92_17159" x="1" y="5" width="28" height="28" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix" />
				<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
				<feOffset dy="4" />
				<feGaussianBlur stdDeviation="2" />
				<feComposite in2="hardAlpha" operator="out" />
				<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
				<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_92_17159" />
				<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_92_17159" result="shape" />
			</filter>
			<linearGradient id="paint0_linear_92_17159" x1="23" y1="6.33333" x2="6.66667" y2="23.3333" gradientUnits="userSpaceOnUse">
				<stop stop-color="#9938BD" />
				<stop offset="0.357292" stop-color="#CE3187" />
				<stop offset="0.64375" stop-color="#F56D35" />
				<stop offset="1" stop-color="#FDBA57" />
			</linearGradient>
		</defs>
	</svg>
<?php
	$html = ob_get_clean();
	ob_end_flush();

	return $html;
}
