<div id='content'>
    <div class='container-fluid'>
        <h1><?= $page_title ?></h1>
        <p>Almost there! Take the time to write your desired policies below.</p>
        <div class="container">
            <?= form_open('mystore/setup', 'class="form-horizontal"') ?>
            <fieldset>
                <?php
                if (!empty(validation_errors())) {
                    $errors=validation_errors();
                    form_pieces::create_alert([
                        'context'=>'info',
                        'label'=>'Could not save your changes.',
                        'text'=> $errors
                    ]);
                    unset($errors);
                }
                if (!empty($setup_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Could not save your changes.',
                        'text'=> $setup_error
                    ]);
                    unset($setup_error);
                }
                
                form_pieces::create_label([
                    'label'=>'Identity',
                ]);
                $store_name = set_value('sname');
                if (!empty($s_name)) {
                    $store_name = $s_name;
                }
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable_label'=>'Store name',
                    'variable'=>'sname',
                    'placeholder'=>'',
                    'value'=>$store_name,
                    'help_text'=>'',
                ]);
                $my_address = $this->address->get_myOffice(['m_id'=>$m_id]);
                $my_address_string = $this->address->get_string([
                    'a_id'=>$my_address['a_id'],
                ]);
                form_pieces::create_radiosfield([
                    'required'=>true,
                    'variable'=>'use_member',
                    'variable_label'=>'Address to use',
                    'variable_column'=>'a_id',
                    'variable_column_text'=>'address',
                    'variable_column_detail'=>'space',
                    'list'=>[
                        ['a_id'=>$my_address['a_id'],'address'=>'Your office address','space'=>$my_address_string],
                        ['a_id'=>'0','address'=>'Another address','space'=>'This will use the new address you specify below.'],
                    ],
                    'selection'=> set_value('use_member'),
                ]);
                form_pieces::createspec_addressselect([
                    'variable_label_prov'=>'Store address',
                    'variable_label_city'=>'',
                    'variable_label_addr'=>'',
                    'provinces'=>$this->address->get_province(),
                    'cities'=>$this->address->get_city(),
                    'given_prov'=>set_value('province'),
                    'given_city'=>set_value('city'),
                ]);
                form_pieces::create_textareafield([
                    'required'=>false,
                    'variable_label'=>'Store description',
                    'variable'=>'desc',
                    'value'=>set_value('desc'),
                    'help_text' => 'Help your customers get to know you better '
                    . 'here, such as leaving a link to your websites.'
                ]);
                
                form_pieces::create_label([
                    'label'=>'Policies'
                ]);
                form_pieces::create_numberappendfield([
                    'variable_label'=>'Minimum order days',
                    'variable'=>'orderdays',
                    'placeholder'=>'',
                    'value'=>set_value('orderdays'),
                    'append_text'=>'days',
                    'help_text'=>'This <i>default</i> value is changeable for '
                    . 'every product you create.',
                ]);
                form_pieces::create_numberappendfield([
                    'variable_label'=>'Edit before',
                    'variable'=>'editdays',
                    'placeholder'=>'Leave empty to reject',
                    'value'=>set_value('editdays'),
                    'append_text'=>'days',
                    'help_text'=>'When the order has been accepted, your '
                    . 'client may have this number of days to <b>change or '
                    . 'cancel</b> their order.',
                ]);
                form_pieces::create_numberappendfield([
                    'variable_label'=>'Return before',
                    'variable'=>'returndays',
                    'placeholder'=>'Leave empty to reject',
                    'value'=>set_value('returndays'),
                    'append_text'=>'days',
                    'help_text'=>'After the transaction is complete, your '
                    . 'client may <b>return or replace</b> their order within '
                    . 'this number of days.',
                ]);
                form_pieces::create_textareafield([
                    'variable_label'=>'Other policies',
                    'variable'=>'rules',
                    'value'=>set_value('rules'),
                    'help_text' => 'The system can only note of so many rules. '
                    . 'Inform your customers of your other policies here.'
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
                    'button_name'=>'setup',
                    'button_text'=>"Save changes",
                ]);
                ?>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>
