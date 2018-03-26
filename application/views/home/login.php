<div id="content">
    <div class="container-fluid">
        <h1>Log in</h1>
        <p>
            Enter your username and password below.
            <a href="<?= site_url('signup') ?>">Don't have one? We can help!</a>
        </p>
        
        <div class="container">
        <?= form_open('login', 'class=form-horizontal') ?>
            <fieldset>

                <?php
                if (!empty(validation_errors())) {
                    $errors=validation_errors();
                    form_pieces::create_alert([
                        'context'=>'info',
                        'label'=>'Could not log in.',
                        'text'=> $errors
                    ]);
                    unset($errors);
                }
                if (!empty($login_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Could not log in.',
                        'text'=> $login_error
                    ]);
                    unset($login_error);
                }
                ?>

                <?php
                form_pieces::create_textfield([
                    'variable_label'=>'User name',
                    'variable'=>'username',
                    'placeholder'=>'',
                    'value'=>set_value('username'),
                    'help_text'=>'',
                ]);
                form_pieces::create_passfield([
                    'variable_label'=>'Password',
                    'variable'=>'password',
                    'placeholder'=>'',
                    'value'=>'',
                    'help_text'=>'',
                ]);
                form_pieces::create_submitbutton([
                    'label'=>'Finished?',
                    'button_name'=>'login',
                    'button_text'=>"Login",
                ]);
                ?>

            </fieldset>
        <?= form_close() ?>
        </div>
    </div>
</div>
