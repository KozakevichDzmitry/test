<?php

function render_facebook_share_icon()
{
	ob_start();
	$html = ob_start();
?>
	<svg width="30" height="33" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect width="30" height="30" fill="#F2F2F2" />
		<g filter="drop-shadow(rgba(0, 0, 0, 0.4) 1px 4px 2px)">
			<path d="M20.2137 16.2494L20.8362 12.63H16.9452V10.2812C16.9452 9.29125 17.4885 8.32562 19.2313 8.32562H21V5.24438C21 5.24438 19.3951 5 17.8603 5C14.6562 5 12.5619 6.73375 12.5619 9.87187V12.6306H9V16.25H12.5619V25H16.9452V16.25L20.2137 16.2494Z" fill="#4064AC" />
		</g>
	</svg>
<?php
	$html = ob_get_clean();
	ob_end_flush();

	return $html;
}
