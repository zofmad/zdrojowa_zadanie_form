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
działania assetów(są poza częścią nadpisywaną przez wordpress, dlatego wysyłam .htaccess na gita)

U mnie mail sie wysyla (odkomentowane extension=php_openssl.dll w php.ini)

Walidacja w js i php ta sama, nie wiem czy o to chodzilo, 
ale zrobilam na wyrazeniach reguralnych bo uważam, 
ze do tego przypadku to najlepsza/najprostsza walidacja formularza wysylanego mailem.
Gdyby chodzilo o baze danych to oczywiscie sprawdzalabym typy zmiennych 
i zrobilabym zabezpieczenie (przed mysql injection np.)
