# zdrojowa_zadanie_form

PHP Version 7.1.7

$ node --version
v8.9.1
$ npm --v
6.2.0

Aby uruchomić projekt:
1.git clone https://github.com/zofmad/zdrojowa_zadanie_form.git
2.cd wp-content/themes/theme
3.npm install
3.npm run webpack

panel admina
login:admin
hasło:dnjcpQSLdesHp35sb2

W .htaccess są wpisy potrzebne do prawidłowego 
działania assetów(są poza częścią nadpisywaną przez wordpress, 
dlatego wysyłam .htaccess na gita)

U mnie mail się wysyła (odkomentowane extension=php_openssl.dll w php.ini)

Walidacja w js i php ta sama, nie wiem, czy o to chodziło, 
ale zrobiłam na wyrazeniach reguralnych bo uważam, 
że do tego przypadku to najlepsza/najprostsza walidacja formularza wysyłanego mailem.
Gdyby chodziło o bazę danych to oczywiście sprawdzałabym typy zmiennych 
i zrobiłabym zabezpieczenie (przed SQL injection np.)

plik mail.php - kod jest dość krótki, więc już nie dzieliłam na klasę i funkcje, 
jeśli chcesz mogę zrobić drugą wersję pliku, obiektową i dosłać jeszcze dziś.
