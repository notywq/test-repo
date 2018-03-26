<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Please fill up the information below.</p>
        
        <?= form_open('testview/addroast_draft', 'class="form-horizontal"') ?>
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
            if (!empty($addroast_error)) {
                form_pieces::create_alert([
                    'context'=>'warning',
                    'label'=>'Could not save your changes.',
                    'text'=> $addroast_error
                ]);
                unset($addroast_error);
            }
            ?>
            
            <?php
            form_pieces::create_boxesfield([
                'variable'=>'roast',
                'variable_label'=>'Supported roasts (select any)',
                'list'=>$this->beans->get_allRoasts(true),
                'selection'=>set_value('roast'),
                'variable_column'=>'b_roast',
                'variable_column_detail'=>'br_desc',
                'max_listheight'=>'20em',
            ]);
            ?><hr /><?php
            form_pieces::createspec_addressselect([
                'cities'=>$this->address->get_city(),
                'given_city'=>set_value('city'),
                'brgys'=>$this->address->getspec_brgy(set_value('city')),
                'given_aID'=>set_value('a_id'),
                'variable_label_city'=>'Roastery address',
                'variable_label_brgy'=>'',
            ]);
            ?><hr /><?php
            form_pieces::create_numberappendfield([
                'variable_label'=>'Minimum order days',
                'variable'=>'orderdays',
                'placeholder'=>'',
                'value'=>set_value('orderdays'),
                'append_text'=>'days',
            ]);
            form_pieces::create_textappendfield([
                'variable_label' => 'Minimum order quantity',
                'variable' => 'minqty',
                'value' => set_value('minqty'),
                'append_text' => 'kg',
            ]);
            ?><hr /><?php
            form_pieces::create_submitbutton([
                'label' => 'Finished?',
                'button_name' => 'addroast',
                'button_text' => 'Add roast service',
            ]);
            ?>
        </fieldset>
        <?= form_close() ?>
    </div>
</div>
