<?php

// Функція для отримання поточного курсу біткоїна (BTC) у гривні (UAH)
function getBitcoinRate() {
	// Встановлення HTTP-запиту до публічного криптовалютного API (CoinGecko, приклад)
	$url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=UAH";

	// Виконання запиту
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	// Розпарсування отриманих даних
	$data = json_decode($response, true);

	// Перевірка наявності курсу біткоїна
	if (isset($data['bitcoin']['uah'])) {
		return $data['bitcoin']['uah'];
	} else {
		return null;
	}
}

// Функція для збереження підписаних email-адрес в файловій системі
function saveEmail($email)
{
	$emails = getEmails();
	if (in_array($email, $emails)) {
		return false; // Email уже є в базі даних (файлі)
	}
	$emails[] = $email;

	file_put_contents('emails.txt', implode("\n", $emails));
	return true;
}

// Функція для отримання списку підписаних email-адрес з файлової системи
function getEmails()
{
	$file = 'emails.txt';
	$emails = [];
	// Перевірка і зміна прав доступу до файлу
	if (file_exists($file)) {
		// Перевірка, чи файл доступний для запису
		if (!is_writable($file)) {
			// Зміна прав доступу до файлу
			chmod($file, 0777);
		}

		$emails = file('emails.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	} else {
		// Створення нового файлу з правами доступу 0777
		file_put_contents($file, '', LOCK_EX);
		chmod($file, 0777);
	}

	return $emails;
}

// Функція для відправки електронних листів з поточним курсом на всі підписані email-адреси
function sendEmails()
{
	$emails = getEmails();
	$exchangeRate = getBitcoinRate();
	$subject = 'Поточний курс BTC до UAH';
	$message = "Поточний курс BTC до UAH: $exchangeRate";
	foreach ($emails as $email) {
		mail($email, $subject, $message);
	}
}

// Отримання поточного курсу BTC до UAH
function getCurrentExchangeRate()
{
	return getBitcoinRate();
}

// Підписати email на отримання поточного курсу
function subscribeEmail($email)
{
	if (saveEmail($email)) {
		return true; // Email успішно додано
	} else {
		return false; // Email уже є в базі даних (файлі)
	}
}
