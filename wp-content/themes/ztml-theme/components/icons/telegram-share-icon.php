<?php

function render_telegram_share_icon()
{
	ob_start();
	$html = ob_start();
?>
	<svg width="30" height="33" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect width="30" height="30" fill="#F2F2F2" />
		<g filter="drop-shadow(rgba(0, 0, 0, 0.4) 1px 4px 2px)">
			<path d="M23.65 5.1315L5.93388 13.2774C4.72482 13.8564 4.73182 14.6606 5.71205 15.0192L10.2605 16.7111L20.7843 8.79398C21.2819 8.43298 21.7365 8.62718 21.3628 9.02274L12.8365 18.198H12.8345L12.8365 18.1992L12.5227 23.7894C12.9824 23.7894 13.1852 23.538 13.443 23.2414L15.6523 20.6798L20.2477 24.7271C21.095 25.2835 21.7036 24.9975 21.9144 23.7918L24.931 6.84003C25.2398 5.36384 24.4584 4.69544 23.65 5.1315Z" fill="#27A3E2" />
		</g>
	</svg>
<?php
	$html = ob_get_clean();
	ob_end_flush();

	return $html;
}
