<div id="content">
    <div class="container-fluid">        
        <h1>Sign up</h1>
        <p>It's FREE; this will just take a minute!</p>
        
        <div class="container">
            <?= form_open('signup', 'class="form-horizontal"') ?>
            <fieldset>

                <?php
                if (!empty(validation_errors())) {
                    $errors=validation_errors();
                    form_pieces::create_alert([
                        'context'=>'info',
                        'label'=>'Cannot create account.',
                        'text'=> $errors
                    ]);
                    unset($errors);
                }
                if (!empty($signup_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Cannot create account.',
                        'text'=> $signup_error
                    ]);
                    unset($signup_error);
                }
                ?>
                
                <?php
                form_pieces::create_label([
                    'label'=>'Basic information'
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'First name',
                    'variable'=>'fname',
                    'placeholder'=>'First name',
                    'value'=> set_value('fname'),
                    'help_text'=>''
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'Middle name',
                    'variable'=>'mname',
                    'placeholder'=>'Middle name',
                    'value'=>set_value('mname'),
                    'help_text'=>'',
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'Last name',
                    'variable'=>'lname',
                    'placeholder'=>'Last name',
                    'value'=>set_value('lname'),
                    'help_text'=>'',
                ]);
                
                form_pieces::create_label([
                    'label'=>'Contact information'
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'Mobile number',
                    'variable'=>'cellno',
                    'placeholder'=>'09XX-XXX-XXXX',
                    'value'=>set_value('cellno'),
                    'help_text'=>'<strong>No symbols; 11 digits please.</strong> We will use this to verify actions on your account.',
                ]);
                form_pieces::createspec_addressselect([
                    'required'=>true,
                    'provinces'=>$this->address->get_province(),
                    'cities'=>$this->address->get_city(),
                    'given_prov'=>set_value('province'),
                    'given_city'=>set_value('city'),
                    'given_addr'=>set_value('address'),
                ]);
                
                form_pieces::create_label([
                    'label'=>'User information'
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'User name',
                    'variable'=>'username',
                    'placeholder'=>'',
                    'value'=>set_value('username'),
                    'help_text'=>'This is what you use to log in with.',
                ]);
                form_pieces::create_passfield([
                    'required'=>true,
                    'variable_label'=>'Password',
                    'variable'=>'password',
                    'placeholder'=>'',
                    'value'=>set_value('password'),
                    'help_text'=>'This must be <strong>at least 8 characters</strong> long, and with no spaces.',
                ]);
                form_pieces::create_passfield([
                    'required'=>true,
                    'variable_label'=>'Confirm password',
                    'variable'=>'passpass',
                    'placeholder'=>'',
                    'value'=>'',
                    'help_text'=>'',
                ]);
                ?><hr /><?php
                form_pieces::create_label([
                    'label'=>'',
                    'text'=>'<strong class="text-danger">'
                            .'Fields with * are required.'
                            .'</strong>'
                ]);
                form_pieces::create_submitbutton([
                    'label'=>'Finished?',
                    'button_name'=>'signup',
                    'button_text'=>"Let's start!",
                ]);
                ?>

            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>
