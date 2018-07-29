<?php

header('Content-Type: text/html; charset=utf-8');

function sendform() 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $responseArray = ['message' => "",
            'status' => 'invalid'];
        if (isset($_POST['field']) && isset($_POST['name']) 
                && isset($_POST['surname']) && isset($_POST['email']) 
                && isset($_POST['message'])) {
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);
            //regular expression rules for form fields
            $nameReg = "/^[a-zA-ZżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/";
            $surnameReg = "/^[a-zA-ZżźćńółęąśŻŹĆĄŚĘŁÓŃ -]+$/";
            //  xxxx@yyyy.zzz
            $emailReg = "/^.+\@.+\..+$/";
            $messageReg = "/^.{10,}$/";
            //form validaton
            if ($_POST['field'] != null) {
                $responseArray = ['message' => "Spam bots!",
                    'status' => 'invalid'];
            } else if (!$email || !$message) {
                $responseArray = ['message' => "Pola: email i wiadomość są wymagane.",
                    'status' => 'invalid'];
            } else if ($name && !preg_match($nameReg, $name)) {
                $responseArray = ['message' => "Niepoprawny format pola Imię.",
                    'status' => 'invalid'];
            } else if ($surname && !preg_match($surnameReg, $surname)) {
                $responseArray = ['message' => "Niepoprawny format pola Nazwisko.",
                    'status' => 'invalid'];
            } else if (!preg_match($emailReg, $email)) {
                $responseArray = ['message' => "Niepoprawny format pola E-mail.",
                    'status' => 'invalid'];
            } else if (!preg_match($emailReg, $email)) {
                $responseArray = ['message' => "Niepoprawny format pola Wiadomość. "
                    . "Wiadomosć musi zawierać rzynajmniej 10 znaków.",
                    'status' => 'invalid'];
            } else {
                $name ?: "Nie podano";
                $surname ?: "Nie podano";
                $headers[] = 'Content-type: text/html; charset=utf-8';
                $headers[] = 'From: <' . get_option('admin_email') . '>' . "\r\n";
                $subject = 'Wiadomość z portalu ' . get_bloginfo('name');
                $mailMessage = "Imię:$name<br>Nazwisko:$surname<br>Wiadomość:<br>$message<br>";
                //email send
                if (wp_mail($email, $subject, $mailMessage, $headers, [])) {
                    $responseArray = ['message' => "Wiadomość wysłana.",
                        'status' => 'valid'];
                } else {
                    $responseArray = ['message' => "Wiadomość nie mogła zostać wysłana.",
                        'status' => 'invalid'];
                }
            }
        } else {
            $responseArray = ['message' => "Niepoprawny formularz.",
                'status' => 'invalid'];
        }

        //html safety
        function filter(&$value) {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        array_walk_recursive($responseArray, "filter");
        echo json_encode($responseArray);
        die();
    }
}

add_action('wp_ajax_nopriv_contact', 'sendform');
add_action('wp_ajax_contact', 'sendform');