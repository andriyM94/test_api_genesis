<?php

include_once 'functions.php';

// Обробка запитів

// Отримати поточний курс BTC до UAH
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/rate') {
	$rate = getCurrentExchangeRate();
	header('Content-Type: application/json');
	echo json_encode($rate);
}

// Підписати email на отримання поточного курсу
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/subscribe') {
	// Перевірка наявності необхідних параметрів у запиті
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		$result = subscribeEmail($email);

		header('Content-Type: application/json');
		if ($result) {
			http_response_code(200);
			echo json_encode(['message' => 'E-mail додано']);
		} else {
			http_response_code(409);
			echo json_encode(['message' => 'E-mail вже є в базі даних']);
		}
	} else {
		http_response_code(400);
		echo json_encode(['message' => 'Необхідно вказати електронну адресу']);
	}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/sendEmails') {
	sendEmails();
	header('Content-Type: application/json');
	http_response_code(200);
	echo json_encode(['message' => 'E-mail-и відправлено']);
}