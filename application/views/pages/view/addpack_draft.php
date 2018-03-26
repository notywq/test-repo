<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Please fill up the information below.</p>
        
        <?= form_open('testview/addpack_draft', 'class="form-horizontal"') ?>
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
            $types_holder = $this->package->get_packTypes(false);
            $types = [];
            foreach ($types_holder as $types_item) {
                $types[$types_item['pk_type']] = $types_item['pk_type'];
            }
            unset($types_holder);
            form_pieces::create_selectfield([
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
                'variable'=>'material',
                'variable_label'=>'Material',
                'placeholder'=>'Select a material...',
                'values'=>$materials,
                'selection'=>set_value('material'),
            ]);
            form_pieces::create_textappendfield([
                'variable' => 'capacity',
                'variable_label' => 'Capacity',
                'value' => set_value('capacity'),
                'append_text' => 'g',
            ]);
            form_pieces::create_textfield([
                'variable' => 'color',
                'variable_label' => 'Color',
                'value' => set_value('color'),
            ]);
            $show_detail = true;
            form_pieces::createspec_packoptions([
                'pack_options'=>$this->package->get_packOptions($show_detail),
                'detail'=>$show_detail,
            ]);
            ?><hr /><?php
            form_pieces::create_textareafield([
                'variable_label' => 'Description',
                'variable' => 'desc',
                'value' => set_value('desc'),
            ]);
            form_pieces::createspec_addressselect([
                'cities'=>$this->address->get_city(),
                'given_city'=>set_value('city'),
                'brgys'=>$this->address->getspec_brgy(set_value('city')),
                'given_aID'=>set_value('a_id'),
                'variable_label_city'=>'Packager address',
                'variable_label_brgy'=>'',
            ]);
            form_pieces::create_textappendfield([
                'variable'=>'unitprice',
                'variable_label'=>'Unit price',
                'help_text'=>'Only two decimal places allowed. If using a whole number, add .00 at the end.',
                'value'=>set_value('unitprice'),
                'append_text'=>'PHP / kg',
            ]);
            form_pieces::create_numberappendfield([
                'variable'=>'qtyperunit',
                'variable_label'=>'Quantity per unit',
                'placeholder'=>'',
                'value'=>set_value('qtyperunit'),
                'append_text'=>'pcs.',
            ]);
            ?><hr /><?php
            form_pieces::create_numberappendfield([
                'variable_label'=>'Minimum order days',
                'variable'=>'orderdays',
                'placeholder'=>'',
                'value'=>set_value('orderdays'),
                'append_text'=>'days',
            ]);
            form_pieces::create_numberappendfield([
                'variable_label' => 'Minimum order quantity',
                'variable' => 'minqty',
                'value' => set_value('minqty'),
                'append_text' => 'kg',
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
