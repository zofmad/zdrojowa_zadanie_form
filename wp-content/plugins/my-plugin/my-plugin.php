<?php
/*
  Plugin Name: My Plugin
 */

function createForm() {
    ?>
    <form class="contact-form" action="" method="post">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-spacer">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">Imię
                    <input type="text" name="name" class="name form-control" placeholder="Imię">
                </div>
                <div class="form-group">Nazwisko
                    <input type="text" name="surname" class="surname form-control" placeholder="Nazwisko">
                </div>
                <div class="form-group">Email*
                    <input type="email" name="email" class="email form-control" placeholder="Email*" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">Treść wiadomości*
                    <textarea name="message" class="message form-control"  placeholder="Treść wiadomości*" required></textarea>
                </div>
            </div>
            <div class="col-xs-12">
                <input type="text" name="field" class="hide">
                <input type="submit" name="send" class="send text-uppercase" value="Wyślij">
            </div>
        </div>
    </form>
    <?php
    return;
}

add_shortcode('formularz_kontaktowy', 'createForm');