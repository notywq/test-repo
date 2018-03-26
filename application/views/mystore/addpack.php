<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Please fill up the information below.</p>
        
        <div class="container">
            <?= form_open('mystore/addpack', 'class="form-horizontal"') ?>
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
                if (!empty($addpack_error)) {
                    form_pieces::create_alert([
                        'context'=>'warning',
                        'label'=>'Could not save your changes.',
                        'text'=> $addpack_error
                    ]);
                    unset($addpack_error);
                }
                ?>

                <?php
                form_pieces::create_label([
                    'label'=>'Package',
                ]);
                $types_holder = $this->package->get_packTypes(false);
                $types = [];
                foreach ($types_holder as $types_item) {
                    $types[$types_item['pk_type']] = $types_item['pk_type'];
                }
                unset($types_holder);
                form_pieces::create_selectfield([
                    'required'=>true,
                    'variable'=>'type',
                    'variable_label'=>'Package type',
                    'placeholder'=>'Select a package type...',
                    'values'=>$types,
                    'selection'=>set_value('type'),
                ]);
                $materials_holder = $this->package->get_packMaterials(false);
                $materials = [];
                foreach ($materials_holder as $materials_item) {
                    $materials[$materials_item['pk_material']] = $materials_item['pk_material'];
                }
                unset($materials_holder);
                form_pieces::create_selectfield([
                    'required'=>true,
                    'variable'=>'material',
                    'variable_label'=>'Material',
                    'placeholder'=>'Select a material...',
                    'values'=>$materials,
                    'selection'=>set_value('material'),
                ]);
                form_pieces::create_textappendfield([
                    'required'=>true,
                    'variable' => 'capacity',
                    'variable_label' => 'Capacity',
                    'value' => set_value('capacity'),
                    'append_text' => 'g',
                ]);
                form_pieces::create_textfield([
                    'required'=>true,
                    'variable' => 'color',
                    'variable_label' => 'Color',
                    'value' => set_value('color'),
                ]);
                $show_detail = true;
                form_pieces::createspec_packoptions([
                    'pack_options'=>$this->package->get_packOptions($show_detail),
                    'detail'=>$show_detail,
                    'selection'=>set_value('pack_option'),
                    'packopt_prices'=>set_value('packopt_price[]'),
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
                    'variable_label'=>'Delivery address to use',
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
                    'variable_label_prov'=>'Other address',
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
                    'variable_label'=>'Set price',
                    'help_text'=>'Only two decimal places allowed. If using a whole number, add .00 at the end.',
                    'value'=>set_value('unitprice'),
                    'append_text'=>'PHP / kg',
                ]);
                form_pieces::create_numberappendfield([
                    'required'=>true,
                    'variable'=>'qtyperunit',
                    'variable_label'=>'Quantity per set',
                    'placeholder'=>'',
                    'value'=>set_value('qtyperunit'),
                    'append_text'=>'pcs',
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
                form_pieces::create_numberappendfield([
                    'variable_label' => 'Minimum order quantity',
                    'variable' => 'minqty',
                    'value' => set_value('minqty'),
                    'append_text' => 'sets',
                ]);
                ?><hr /><?php
                form_pieces::create_submitbutton([
                    'label' => 'Finished?',
                    'button_name' => 'addpack',
                    'button_text' => 'Add packaging',
                ]);
                ?>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>
