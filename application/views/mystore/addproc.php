<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Please fill up the information below.</p>
        
        <div class="container">
            <?= form_open('mystore/addproc', 'class="form-horizontal"') ?>
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
                if (!empty($addproc_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Could not save your changes.',
                        'text'=> $addproc_error
                    ]);
                    unset($addproc_error);
                }
                ?>

                <?php
                form_pieces::create_label([
                    'label'=>'Processing',
                ]);
                form_pieces::create_radiosfield([
                    'required'=>true,
                    'variable'=>'processing',
                    'variable_label'=>'Activity',
                    'list'=>$this->processing->get_procActivities(true),
                    'selection'=>set_value('processing'),
                    'variable_column'=>'proc_activity',
                    'variable_column_text'=>'proc_activity',
                    'variable_column_detail'=>'procact_desc',
                    'max_listheight'=>'20em',
                ]);
                
                form_pieces::create_label([
                    'label'=>'Offer',
                ]);
                form_pieces::create_textareafield([
                    'variable_label' => 'Description',
                    'variable' => 'desc',
                    'value' => set_value('desc'),
                ]);
                $my_address = $this->address->get_myStore(['s_id'=>$s_id]);
                $my_address_string = $this->address->get_string([
                    'a_id'=>$my_address['a_id'],
                ]);
                form_pieces::create_radiosfield([
                    'required'=>true,
                    'variable'=>'use_store',
                    'variable_label'=>'Address to use',
                    'variable_column'=>'a_id',
                    'variable_column_text'=>'address',
                    'variable_column_detail'=>'space',
                    'list'=>[
                        ['a_id'=>$my_address['a_id'],'address'=>'Your store address','space'=>$my_address_string],
                        ['a_id'=>'0','address'=>'Another address','space'=>'This will use the new address you specify below.'],
                    ],
                    'selection'=> set_value('use_store'),
                ]);
                form_pieces::createspec_addressselect([
                    'variable_label_prov'=>'Deliver from',
                    'variable_label_city'=>'',
                    'variable_label_addr'=>'',
                    'provinces'=>$this->address->get_province(),
                    'cities'=>$this->address->get_city(),
                    'given_prov'=>set_value('province'),
                    'given_city'=>set_value('city'),
                    'given_addr'=>set_value('address'),
                ]);
                form_pieces::create_textappendfield([
                    'required'=>true,
                    'variable'=>'unitprice',
                    'variable_label'=>'Unit price',
                    'help_text'=>'Only two decimal places allowed. If using a whole number, add .00 at the end.',
                    'value'=>set_value('unitprice'),
                    'append_text'=>'PHP / kg',
                ]);
                
                form_pieces::create_label([
                    'label'=>'Policies',
                ]);
                $a_store = $this->store->identify(['s_id'=>$s_id]);
                $supposed_orderdays = $a_store['s_orderdays'];
                if (set_value('orderdays') !== '') {
                    $supposed_orderdays = set_value('orderdays');
                }
                form_pieces::create_numberappendfield([
                    'variable_label'=>'Minimum order days',
                    'variable'=>'orderdays',
                    'placeholder'=>$a_store['s_orderdays'],
                    'value'=>$supposed_orderdays,
                    'append_text'=>'days',
                ]);
                unset($a_store,$supposed_orderdays);
                form_pieces::create_textappendfield([
                    'variable_label' => 'Minimum order quantity',
                    'variable' => 'minqty',
                    'value' => set_value('minqty'),
                    'append_text' => 'kg',
                ]);
                ?><hr /><?php
                form_pieces::create_submitbutton([
                    'label' => 'Finished?',
                    'button_name' => 'addproc',
                    'button_text' => 'Add processing service',
                ]);
                ?>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>
