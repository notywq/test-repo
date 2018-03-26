<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Please fill up the information below.</p>
        
        <div class="container">
            <?= form_open('mystore/addbeans', 'class="form-horizontal"') ?>
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
                if (!empty($addbeans_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Could not save your changes.',
                        'text'=> $addbeans_error
                    ]);
                    unset($addbeans_error);
                }
                
                form_pieces::create_label([
                    'label'=>'Beans',
                ]);
                $species_list = $this->beans->get_allSpecies(true);
                form_pieces::create_boxesfield([
                    'required'=>true,
                    'variable'=>'species',
                    'variable_label'=>'Species (choose any number)',
                    'variable_column'=>'b_species',
                    'variable_column_text'=>'b_species',
                    'variable_column_detail'=>'bs_desc',
                    'list'=>$species_list,
                    'selection'=> set_value('species'),
                ]);
                $roast_list = $this->beans->get_allRoasts(true);
                form_pieces::create_radiosfield([
                    'required'=>true,
                    'variable'=>'roast',
                    'variable_label'=>'Roast type',
                    'variable_column'=>'b_roast',
                    'variable_column_text'=>'b_roast',
                    'variable_column_detail'=>'br_desc',
                    'list'=>$roast_list,
                    'selection'=> set_value('roast'),
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable'=>'origin',
                    'variable_label'=>'Origin',
                    'value'=>set_value('origin'),
                ]);
                form_pieces::create_datefield([
                    'required'=>true,
                    'variable'=>'roastdate',
                    'variable_label'=>'Roast date',
                    'placeholder'=>'YYYY-MM-DD',
                    'value'=>set_value('roastdate'),
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
                    'label'=>'Offer',
                ]);
                form_pieces::create_textareafield([
                    'variable'=>'desc',
                    'variable_label'=>'Description',
                    'value'=>set_value('desc'),
                ]);
                form_pieces::create_textareafield([
                    'variable'=>'additions',
                    'variable_label'=>'Additional ingredients',
                    'placeholder'=>'Ingredients 1, 2, 3, 4, etc.',
                    'rows'=>'3',
                    'value'=>set_value('additions'),
                    'help_text'=>'Separate each ingredient with a comma ( , ).',
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
                form_pieces::create_label([
                    'label'=>'',
                    'text'=>'<strong class="text-danger">Fields with * are required.</strong>'
                ]);
                form_pieces::create_submitbutton([
                    'label' => 'Finished?',
                    'button_name' => 'addbeans',
                    'button_text' => 'Add batch of beans',
                ]);
                ?>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>
