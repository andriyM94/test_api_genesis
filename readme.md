## 1. Курс біткоіну (BTC) до гривні (UAH)
   - Ендпоінт /rate дає можливість отримати поточний курс BTC до UAH.
   - При виклику цього ендпоінту, сервіс повинен виконати запит до будь-якого публічного API, що надає актуальний курс BTC до UAH.
   - Сервіс повинен повернути отриманий курс у форматі JSON.
   
## 2. Підписка на отримання інформації про зміну курсу
   - Ендпоінт /subscribe дозволяє користувачам підписуватися на отримання інформації про зміну курсу.
   - Користувачі повинні надати свою електронну адресу в якості параметру запиту.
   - Сервіс повинен перевірити, чи електронна адреса вже існує в базі даних (у файловій системі) і, якщо ні, додати її до бази.
## 3. Відправка електронних листів з актуальним курсом
   - Ендпоінт /sendEmails дозволяє відправити електронний лист з актуальним курсом BTC до всіх підписаних електронних адрес.
   - Сервіс повинен отримати актуальний курс BTC до UAH з публічного API.
   - Для кожної підписаної електронної адреси в базі даних, сервіс повинен відправити електронний лист з актуальним курсом.
## 4. Збереження даних у файловій системі
   - Для збереження даних (наприклад, електронних адрес) сервіс повинен використовувати файлову систему.
## 5. Автентифікація та авторизація
   - Сервіс може вимагати автентифікації користувача для виконання деяких операцій, наприклад, підписки на отримання інформації про зміну курсу або відправки електронних листів.
   - Для цього можна використовувати механізми аутентифікації та авторизації, такі як токени або сеанси.

## 6. Обробка помилок

- Сервіс повинен вміти обробляти помилки, якщо вони виникають під час взаємодії з публічним API, при спробі збереження даних або відправці електронних листів.
- Помилки повинні бути відображені у відповідях API з відповідними кодами стану та повідомленнями про помилку.