<style>
    .lil-header {
        border-bottom: 1px solid #f0f0f0
    }
</style>
<div id ="content">
    <div class="container-fluid">
        <br />
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="thumbnail">
                    <img class="img-responsive" height="250" width="250"
                         src="<?= base_url('public/proc.png') ?>" >
                </div>
            </div>
            <div class="col-md-10 col-sm-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <h3>
                                <?= $proc_details['proc_activity'] ?>
                                <br />
                                <small>at <?= $this->address->get_string([
                                    'a_id'=>$proc_details['proc_address'],
                                ]) ?></small>
                            </h3>
                            <?php
                            $has_store = $this->store->track([
                                'proc_id' => $proc_id
                            ]);
                            ?>
                            <p>by <a href="#"><?= $has_store['s_name'] ?></a></p>            
                        </div>
                        <div class="col-xs-6 text-right">
                            <h3>
                                <small>PHP</small>
                                <?= $proc_details['proc_unitprice'] ?><br />
                                <small>per kg</small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-horizontal">
                    <?php
                    if (!empty($buy_error)) {
                        form_pieces::create_alert([
                            'context'=>'warning',
                            'label'=>'Could not buy processing service.',
                            'text'=>$buy_error,
                        ]);
                    }
                    ?>
                    <?php
                    if (!empty(validation_errors())) {
                        form_pieces::create_alert([
                            'label'=>'Could not buy processing service.',
                            'text'=> validation_errors(),
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <br class="visible-xs" />
        <div class="row">
            <div class="col-sm-6">
                <div class="container-fluid">
                    <div class="h4 lil-header">Details</div>
                    <?php
                    if (!empty($proc_details['proc_desc'])) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <label class="control-label">
                                Description
                            </label>
                        </div>
                        <div class="col-xs-12 text-left">
                            <p>
                                <?= $proc_details['proc_desc'] ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($proc_details['proc_activity'])) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <label class="control-label">
                                Processing
                            </label>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <?= $proc_details['proc_activity'] ?>
                            </div>
                            <div class="col-xs-12">
                                <small>
                                    <?php
                                    $proc_detail = $this->processing->get_procDetail([
                                        'proc_activity'=>$proc_details['proc_activity']
                                    ]);
                                    echo $proc_detail;
                                    ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    if (!empty($proc_details['proc_desc']) || !empty($proc_details['proc_activity'])) {
                        echo "<br />";
                    }
                    ?>
                    <br />
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Unit price
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $proc_details['proc_unitprice'] ?> PHP per kg
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Location
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?php
                                echo $this->address->get_string([
                                    'a_id' => $proc_details['proc_address']
                                ]);
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php if ($proc_details['proc_minqty'] > 0) { ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Minimum order quantity
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $proc_details['proc_minqty'] ?> kg
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($proc_details['proc_orderdays'] > 0) { ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Order this
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $proc_details['proc_orderdays'] ?> days in advance
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Seller
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?php
                                $that_member = $this->member->find_owner([
                                    's_id' => $proc_details['s_id']
                                ]);
                                $member_fmlName = $this->member->get_name([
                                    'm_id' => $that_member['m_id']
                                ]);
                                ?>
                                <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                    'm_id' => $that_member['m_id']
                                        ])) ?>">
                                    <?= $member_fmlName ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="container-fluid">
                    <div class="h4 lil-header">Request form</div>
                    <?= form_open('browse/proc/'.$proc_string, 'class="form-horizontal"');?>
                    <fieldset>
                        <?php
                        $label_size = 'col-md-3';
                        $input_size = 'col-md-6';
                        form_pieces::create_textareafield([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'proc_notes',
                            'variable_label'=>'Processing notes',
                            'value'=> set_value('proc_notes'),
                        ]);
                        form_pieces::create_textappendfield([
                            'required'=>true,
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'quantity',
                            'variable_label'=>'Quantity needed',
                            'value'=>set_value('quantity'),
                            'append_text'=>'kg',
                        ]);
                        form_pieces::create_datefield([
                            'required'=>true,
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'duedate',
                            'variable_label'=>'Date needed',
                            'value'=>set_value('duedate'),
                        ]);
                        ?><hr /><?php
                        if (!empty($m_id)) {
                            $my_address = $this->address->get_myOffice(['m_id'=>$m_id]);
                            $my_address_string = $this->address->get_string([
                                'a_id'=>$my_address['a_id'],
                            ]);
                            form_pieces::create_radiosfield([
                                'required'=>true,
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'use_member',
                                'variable_label'=>'Address to use',
                                'variable_column'=>'a_id',
                                'variable_column_text'=>'address',
                                'variable_column_detail'=>'space',
                                'list'=>[
                                    ['a_id'=>$my_address['a_id'],'address'=>'Your office address','space'=>$my_address_string],
                                    ['a_id'=>'0','address'=>'A new address','space'=>'This will use the new address you specify below.'],
                                ],
                                'selection'=> set_value('use_member'),
                            ]);
                        }
                        else {
                            form_pieces::create_radiosfield([
                                'required'=>true,
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'use_member',
                                'variable_label'=>'Address to use',
                                'variable_column'=>'a_id',
                                'variable_column_text'=>'address',
                                'variable_column_detail'=>'space',
                                'list'=>[
                                    ['a_id'=>'1','address'=>'Your office address','space'=>'That is, if you log in first!'],
                                    ['a_id'=>'0','address'=>'A new address','space'=>'This will use the new address you specify below.'],
                                ],
                                'selection'=> set_value('use_member'),
                            ]);
                        }
                        form_pieces::createspec_addressselect([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable_label_prov'=>'Delivery address',
                            'variable_label_city'=>'',
                            'variable_label_addr'=>'',
                            'provinces'=>$this->address->get_province(),
                            'cities'=>$this->address->get_city(),
                            'given_prov'=>set_value('province'),
                            'given_city'=>set_value('city'),
                        ]);
                        form_pieces::create_textareafield([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'notes',
                            'variable_label'=>'Delivery notes',
                            'value'=> set_value('notes'),
                        ]);
                        ?><hr /><?php
                        form_pieces::create_submitbutton([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'label'=>'Finished?',
                            'button_name'=>'buyproc',
                            'button_text'=>'Use this processor',
                        ]);
                        ?>
                    </fieldset>
                    <?= form_close() ?>
                </div>
            </div>
            <?php
            if (!empty($m_id)) {
                $the_buyer = $this->member->identify([
                    'm_id'=>$m_id
                ]);
                $the_seller = $this->member->find_owner([
                    's_id'=>$has_store['s_id']
                ]);
                $given_subject = "Inquiry for ".$proc_details['proc_activity']." at ".$this->address->get_string([
                    'a_id'=>$proc_details['proc_address'],
                    'pref'=>'c,p'
                ]);
                if (!empty(set_value('subject'))) {
                    $given_subject = set_value('subject');
                }
                $given_message = set_value('message');
                
                $recipient_text = "This will be sent to ";
                if ($m_id == $the_seller['m_id']) {
                    $recipient_text .= $this->member->get_name([
                        'm_id'=>$the_buyer['m_id'],
                        'pref'=>'fml'
                    ]).".";
                }
                else {
                    $recipient_text .= $this->member->get_name([
                        'm_id'=>$the_seller['m_id'],
                        'pref'=>'fml'
                    ]).".";
                }
                $contact_button_label = "Message ";
                if ($m_id == $the_seller['m_id']) {
                    $contact_button_label .= "buyer";
                }
                else {
                    $contact_button_label .= "seller";
                }
                $label_size = 'col-md-3';
                $input_size = 'col-md-6';
            ?>
            <div class="col-sm-6">
                <?=
                form_open('browse/proc/'.$proc_string, 'class="form-horizontal"');
                ?>
                <div class="container-fluid">
                    <div id="contact_seller" class="h4 lil-header">Contact</div>
                    <fieldset>
                        <?php
                        form_pieces::create_textfield([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'subject',
                            'variable_label'=>'Subject',
                            'placeholder'=>$given_subject,
                            'value'=>$given_subject,
                            'help_text'=>$recipient_text,
                        ]);
                        form_pieces::create_textareafield([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'variable'=>'message',
                            'variable_label'=>'Message',
                            'value'=>set_value('message'),
                        ]);
                        ?><hr /><?php
                        form_pieces::create_submitbutton([
                            'label_size' => $label_size,
                            'input_size' => $input_size,
                            'context' => 'default',
                            'label'=>'Finished?',
                            'button_name'=>'heyproc',
                            'button_text'=>$contact_button_label,
                        ]);
                        ?>
                    </fieldset>
                </div>
                <?=
                form_close();
                ?>
            </div>
            <?php
            unset($the_buyer, $the_seller);
            }
            ?>
        </div>
    </div>
</div>