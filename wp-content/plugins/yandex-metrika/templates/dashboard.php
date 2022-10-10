<div class='wrap'>
	<h2>Популярные статьи Метрика</h2>
	<?php

	$json_data = NULL;

	if (!file_exists(ABSPATH . $fname)) {
		die("Файл ($fname) метрики не найден в папке" . ABSPATH);
	}

	$json = file_get_contents(ABSPATH . $fname);

	if ($json === false) {
		die("Файл ($fname) метрики не найден в папке" . ABSPATH . "не смог быть прочитаным");
	}

	$json_data = json_decode($json, true);


	if (empty($json_data['data'])) {
		die("Файл ($fname) метрики содержит неккоректные данные");
	}

	$i = 0;
	$x = 0;
	?>

	<table class="form-table">
		<tr>
			<td>Самые популярные за предыдущие 7 дней + текущий день. Статистика обновляется в начале каждого часа (9.01,10.01...)</td>
			<br>
			<hr>
		</tr>
		<tr>
			<th>Заголовок статьи</th>
			<th>Просмотры</th>
		</tr>

		<?php foreach ($json_data['data'] as $row) : ?>
			<tr>
				<td><?php echo $x++; ?>.<?php echo $row["dimensions"][0]["name"]; ?></td>
				<th><?php echo $row['metrics'][0]; ?></th>
			</tr>
		<?php endforeach; ?>
	</table>
</div>