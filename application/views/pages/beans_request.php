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
                         src="<?= base_url('public/beans.png') ?>" >
                </div>
            </div>
            <div class="col-md-10 col-sm-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            $batch_id = $request['b_id'];
                            $bean_details = $this->beans->identify([
                                'b_id'=>$batch_id
                            ]);
                            $bean_species = $this->beans->get_thatSpeciesString([
                                'b_id'=>$batch_id
                            ]);
                            $bean_additions = $this->beans->get_thoseAdditions([
                                'b_id'=>$batch_id
                            ]);
                            ?>
                            <h3>
                                <?= $bean_species ?>
                                <br />
                                <small><?= $bean_details['b_roast'] ?> roast</small>
                            </h3>
                            <?php
                            $that_member = $this->member->identify([
                                'm_id' => $request['m_id']
                            ]);
                            $member_fmlName = $that_member['m_fname'].' '.
                                $that_member['m_mname'].' '.
                                $that_member['m_lname'];
                            ?>
                            <p>
                                ordered by
                                <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                'm_id' => $that_member['m_id']
                                    ])) ?>">
                                <?= $member_fmlName ?>
                                </a>
                            </p>            
                        </div>
                        <div class="col-xs-6 text-right">
                            <h3>
                                <?= $request['rb_quantity'] ?>
                                <small>kg</small><br />
                                <small>ordered</small>
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
                    if (!empty($offer_error)) {
                        form_pieces::create_alert([
                            'context'=>'warning',
                            'label'=>'Could not buy beans.',
                            'text'=>$offer_error,
                        ]);
                    }
                    ?>
                    <?php
                    if (!empty(validation_errors())) {
                        form_pieces::create_alert([
                            'label'=>'Could not buy beans.',
                            'text'=> validation_errors(),
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $is_seller = $request['m_id'] != $m_id;
            ?>
            <div class="col-sm-6">
            <?=
            form_open('orders/beans/'.$request_string, 'class="form-horizontal"');
            ?>
                <div class="container-fluid">
                <?php
                switch ($request['rb_status']) {
                    case 0:
                    case 1: {
                ?>
                <div class="h4 lil-header">Evaluation</div>
                <?php
                if (in_array($request['rb_status'],
                            $this->request_beans->get_progressStatuses([
                                'is_seller'=>$is_seller
                            ])
                    )) {
                ?>
                <div class="h5 text-uppercase">Finalize</div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="btn-group btn-group-lg">
                            <button type="submit" id="offerbeans" name="offerbeans" value="yes" class="btn btn-success">
                                <span class="fas fa-check-circle"></span>
                                <br />
                                <small>Accept</small>
                            </button>
                            <button type="submit" id="offerbeans" name="offerbeans" value="no" class="btn btn-danger">
                                <span class="fas fa-times-circle"></span>
                                <br />
                                <small>Reject</small>
                            </button>
                        </div>
                    </div>
                </div>
                <br />
                <?php
                }
                ?>
                <div class="h5 text-uppercase">Negotiate</div>
                <fieldset>
                    <?php
                    $label_size = 'col-md-3';
                    $input_size = 'col-md-6';
                    $supposed_quantity = $request['rb_quantity'];
                    if (set_value('quantity') !== '') {
                        $supposed_quantity = set_value('quantity');
                    }
                    form_pieces::create_textappendfield([
                        'required'=>true,
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'variable'=>'quantity',
                        'variable_label'=>'Quantity needed',
                        'value'=>$supposed_quantity,
                        'append_text'=>'kg',
                    ]);
                    $supposed_duedate = $request['rb_duedate'];
                    if (set_value('duedate') !== '') {
                        $supposed_quantity = set_value('duedate');
                    }
                    form_pieces::create_datefield([
                        'required'=>true,
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'variable'=>'duedate',
                        'variable_label'=>'Date needed',
                        'value'=>$supposed_duedate,
                    ]);
                    ?><hr /><?php
                    $my_address_list = [];
                    $my_address = $this->address->get_myOffice(['m_id'=>$m_id]);
                    $my_address_string = $this->address->get_string([
                        'a_id'=>$my_address['a_id'],
                    ]);
                    $supposed_memberuse = $request['rb_deliverto'];
                    if (set_value('use_member') !== '') {
                        $supposed_memberuse = set_value('use_member');
                    }
                    $supposed_memberuse_string = $this->address->get_string(['a_id'=>$request['rb_deliverto']]);
                    if ($supposed_memberuse !== $my_address['a_id']) {
                        array_push($my_address_list,
                            ['a_id'=>$supposed_memberuse,'address'=>'The current address','space'=>$supposed_memberuse_string]
                        );
                    }
                    if (!$is_seller || $bean_details['b_deliverfrom'] !== $my_address['a_id']) {
                        array_push($my_address_list,
                            ['a_id'=>$my_address['a_id'],'address'=>'Your office address','space'=>$my_address_string]
                        );
                    }
                    array_push($my_address_list,
                        ['a_id'=>'0','address'=>'A new address','space'=>'This will use the new address you specify below.']
                    );
                    form_pieces::create_radiosfield([
                        'required'=>true,
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'variable'=>'use_member',
                        'variable_label'=>'Address to use',
                        'variable_column'=>'a_id',
                        'variable_column_text'=>'address',
                        'variable_column_detail'=>'space',
                        'list'=>$my_address_list,
                        'selection'=> $supposed_memberuse,
                    ]);
                    form_pieces::createspec_addressselect([
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'variable_label_prov'=>'Delivery address',
                        'variable_label_city'=>'',
                        'variable_label_addr'=>'',
                        'provinces'=>$this->address->get_province(),
                        'cities'=>$this->address->get_city(),
                    ]);
                    $supposed_delivernotes = $request['rb_delivernotes'];
                    if (set_value('notes') !== '') {
                        $supposed_delivernotes = set_value('notes');
                    }
                    form_pieces::create_textareafield([
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'variable'=>'notes',
                        'variable_label'=>'Delivery notes',
                        'value'=> $supposed_delivernotes,
                    ]);
                    ?><hr /><?php
                    form_pieces::create_submitbutton([
                        'label_size' => $label_size,
                        'input_size' => $input_size,
                        'label'=>'Finished?',
                        'button_name'=>'negbeans',
                        'button_text'=>'Negotiate these beans',
                    ]);
                    ?>
                </fieldset>
                <?php
                        break;
                    }
                    case 2: {
                        ?>
                        <div class="h4 lil-header">Preparation</div>
                        <?php
                        if (in_array($request['rb_status'],
                                    $this->request_beans->get_progressStatuses([
                                        'is_seller'=>$is_seller
                                    ])
                            )) {
                        ?>
                        <div class="h5 text-uppercase">Send</div>
                        <fieldset>
                            <!-- TODO Use special JavaScript to enable/diasble textbox (cosmetic) -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="courier">Courier name</label>  
                                <div class="col-md-6">
                                    <input id="courier" name="courier" type="text" class="form-control input-md"
                                           value="<?= set_value('courier') ?>">
                                    <span class="help-block">If you use your own
                                        transport service, leave this box empty.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="trackno">Tracking number</label>  
                                <div class="col-md-6">
                                    <div class='input-group'>
                                        <label class='input-group-addon'>
                                            <input class='checkbox-inline' type="checkbox" name="track" value="1" checked>
                                        </label>
                                        <input id="trackno" name="trackno" type="text" class="form-control input-md"
                                               value="<?= set_value('trackno') ?>">
                                    </div>
                                    <span class="help-block">This is necessary to
                                        locate the order handled by a courier.
                                        Uncheck if there isn't one.</span>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="sendbeans">Finished?</label>
                                <div class="col-md-6">
                                    <button id="sendbeans" name="sendbeans" class="btn btn-primary" type="submit">
                                        Send order
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <br />
                        <?php
                        }
                        ?>
                        <?php
                        // Impose the editdays rule here:
                        $that_store_orderdays = $this->request_history->get_entry([
                            'request_id' => $request['rb_id'],
                            'type' => 'beans',
                            'inquiry' => 's_editdays',
                        ]);
                        $timestamp = date('Y-m-d H:i:s');
                        $datetime1 = new DateTime($request['rb_created']);
                        $datetime2 = new DateTime($timestamp);
                        $interval = $datetime1->diff($datetime2);
                        $datediffdays = $interval->format('%R%d');
                        // echo $request['rb_created']." vs. ".$timestamp;
                        // echo "<br />Truth: ".$datediffdays." vs. ".$that_bean_orderdays;
                        if ($datediffdays <= $that_store_orderdays || $that_store_orderdays == 0) {
                        ?>
                        <div class="h5 text-uppercase">Negotiate</div>
                        <fieldset>
                            <?php
                            $label_size = 'col-md-3';
                            $input_size = 'col-md-6';
                            $supposed_quantity = $request['rb_quantity'];
                            if (set_value('quantity') !== '') {
                                $supposed_quantity = set_value('quantity');
                            }
                            form_pieces::create_textappendfield([
                                'required'=>true,
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'quantity',
                                'variable_label'=>'Quantity needed',
                                'value'=>$supposed_quantity,
                                'append_text'=>'kg',
                            ]);
                            $supposed_duedate = $request['rb_duedate'];
                            if (set_value('duedate') !== '') {
                                $supposed_quantity = set_value('duedate');
                            }
                            form_pieces::create_datefield([
                                'required'=>true,
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'duedate',
                                'variable_label'=>'Date needed',
                                'value'=>$supposed_duedate,
                            ]);
                            ?><hr /><?php
                            $my_address_list = [];
                            $my_address = $this->address->get_myOffice(['m_id'=>$m_id]);
                            $my_address_string = $this->address->get_string([
                                'a_id'=>$my_address['a_id'],
                            ]);
                            $supposed_memberuse = $request['rb_deliverto'];
                            if (set_value('use_member') !== '') {
                                $supposed_memberuse = set_value('use_member');
                            }
                            $supposed_memberuse_string = $this->address->get_string(['a_id'=>$request['rb_deliverto']]);
                            if ($supposed_memberuse !== $my_address['a_id']) {
                                array_push($my_address_list,
                                    ['a_id'=>$supposed_memberuse,'address'=>'The current address','space'=>$supposed_memberuse_string]
                                );
                            }
                            if (!$is_seller || $bean_details['b_deliverfrom'] !== $my_address['a_id']) {
                                array_push($my_address_list,
                                    ['a_id'=>$my_address['a_id'],'address'=>'Your office address','space'=>$my_address_string]
                                );
                            }
                            array_push($my_address_list,
                                ['a_id'=>'0','address'=>'A new address','space'=>'This will use the new address you specify below.']
                            );
                            form_pieces::create_radiosfield([
                                'required'=>true,
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'use_member',
                                'variable_label'=>'Address to use',
                                'variable_column'=>'a_id',
                                'variable_column_text'=>'address',
                                'variable_column_detail'=>'space',
                                'list'=>$my_address_list,
                                'selection'=> $supposed_memberuse,
                            ]);
                            form_pieces::createspec_addressselect([
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable_label_prov'=>'Delivery address',
                                'variable_label_city'=>'',
                                'variable_label_addr'=>'',
                                'provinces'=>$this->address->get_province(),
                                'cities'=>$this->address->get_city(),
                            ]);
                            $supposed_delivernotes = $request['rb_delivernotes'];
                            if (set_value('notes') !== '') {
                                $supposed_delivernotes = set_value('notes');
                            }
                            form_pieces::create_textareafield([
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'variable'=>'notes',
                                'variable_label'=>'Delivery notes',
                                'value'=> $supposed_delivernotes,
                            ]);
                            ?><hr /><?php
                            form_pieces::create_submitbutton([
                                'label_size' => $label_size,
                                'input_size' => $input_size,
                                'label'=>'Finished?',
                                'button_name'=>'negbeans',
                                'button_text'=>'Negotiate these beans',
                            ]);
                            ?>
                        </fieldset>
                        <?php
                        }
                                break;
                            }
                    case 3: {
                        ?>
                        <div class="h4 lil-header">Retrieval</div>
                        <fieldset>
                        <?php
                        if (in_array($request['rb_status'],
                                    $this->request_beans->get_progressStatuses([
                                        'is_seller'=>$is_seller
                                    ])
                            )) {
                        ?>
                            <!--
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">Not received yet?</label>
                                <div class="col-md-6">
                                    <button id="" name="" value="" class="btn btn-primary" type="submit">
                                        Follow-up
                                    </button>
                                </div>
                            </div>
                            -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="receivebeans">Received in good condition?</label>
                                <div class="col-md-6">
                                    <button id="receivebeans" name="receivebeans" value="1" class="btn btn-success" type="submit">
                                        Confirm received order
                                    </button>
                                    <span class="help-block">This does
                                        <strong>NOT</strong> mean you have paid for
                                        this order yet.</span>
                                </div>
                            </div>
                            <!--
                            <hr />
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">Received in bad condition?</label>
                                <div class="col-md-6">
                                    <button id="" name="" value="" class="btn btn-danger" type="submit">
                                        Claim as damaged order
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">Other item/s received?</label>
                                <div class="col-md-6">
                                    <button id="" name="" value="" class="btn btn-danger" type="submit">
                                        Claim as wrong order
                                    </button>
                                </div>
                            </div>
                            -->
                            <hr />
                        <?php
                        }
                        ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Want to talk?</label>
                                <div class="col-md-6">
                                    <a class="btn btn-default" href="#contact_seller">
                                        Contact <?php
                                        if ($is_seller){
                                            echo "buyer";
                                        }
                                        else {
                                            echo "seller";
                                        }
                                    ?></a>
                                </div>
                            </div>
                        </fieldset>
                            <?php
                                break;
                            }
                    case 4:{
                    ?>
                    <div class="h4 lil-header">Payment</div>
                    <fieldset>
                        <?php
                        if (in_array($request['rb_status'],
                                    $this->request_beans->get_progressStatuses([
                                        'is_seller'=>$is_seller
                                    ])
                            )) {
                        ?>
                        <!--
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Not received yet?</label>
                            <div class="col-md-6">
                                <button id="" name="" value="" class="btn btn-primary" type="submit">
                                    Follow-up
                                </button>
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="paybeans">Paid in full?</label>
                            <div class="col-md-6">
                                <button id="paybeans" name="paybeans" value="1" class="btn btn-success" type="submit">
                                    Confirm received payment
                                </button>
                            </div>
                        </div>
                        <!--
                        <hr />
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Abandoned payment?</label>
                            <div class="col-md-6">
                                <button id="" name="" value="" class="btn btn-danger" type="submit">
                                    Claim as ignored payment
                                </button>
                            </div>
                        </div>
                        -->
                        <hr />
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Want to talk?</label>
                            <div class="col-md-6">
                                <a class="btn btn-default" href="#contact_seller">
                                    Contact <?php
                                    if ($is_seller){
                                        echo "buyer";
                                    }
                                    else {
                                        echo "seller";
                                    }
                                ?></a>
                            </div>
                        </div>
                    </fieldset>
                    <?php
                        }
                }
                ?>
                </div>
            <?= 
            form_close();
            ?>
            </div>
            <div class="col-sm-6">
                <div class="container-fluid">
                    <div class="h4 lil-header">Details</div>
                    <!--ORDER-->
                    <div class="h5 text-uppercase">Order</div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Status
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                <?=
                                $this->request_beans->get_thatStatus([
                                    'is_seller' => $is_seller,
                                    'rb_status' => $request['rb_status'],
                                ]);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Due date
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                <?= $request['rb_duedate'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Deliver to
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                <?php
                                $target_address = $this->address->get_string([
                                    'a_id' => $request['rb_deliverto']
                                ]);
                                echo $target_address;
                                ?>
                            </span>
                        </div>
                    </div>
                    <?php
                    if (!empty($request['rb_delivernotes'])) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <label class="control-label">
                                Delivery notes
                            </label>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <?= $request['rb_delivernotes'] ?>
                            </div>
                        </div>
                        <div class="col-xs-12"><br /></div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    $request_ship = $this->request_beans->get_thatShip([
                        'rb_id'=>$request_id
                    ]);
                    if (!empty($request_ship)) {
                    ?>
                    <br />
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Courier used
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                <?= $request_ship['rbsh_courier'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Tracking number
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                <?php
                                if (!empty($request_ship['rbsh_trackno'])) {
                                    echo $request_ship['rbsh_trackno'];
                                }
                                else {
                                    echo "None";
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <?php
                    }
                    unset ($request_ship);
                    ?>
                    <br />
                    <!--BEANS-->
                    <div class="h5 text-uppercase">Beans</div>
                    <?php
                    if (!empty($bean_details['b_desc'])) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <label class="control-label">
                                Description
                            </label>
                        </div>
                        <div class="col-xs-12 text-left">
                            <p>
                                <?= $bean_details['b_desc'] ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($bean_additions)) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <label class="control-label">
                                Additional ingredients
                            </label>
                        </div>
                        <div class="col-xs-12">
                        <?php
                        foreach($bean_additions as $bean_added) {
                        ?>
                            <div class="col-md-4 col-xs-6">
                                - <?= $bean_added ?>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                    }
                    if (!empty($bean_details['b_desc']) || !empty($bean_additions)) {
                        echo "<br />";
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Roast date
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $bean_details['b_roastdate'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Origin
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $bean_details['b_origin'] ?>
                            </p>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Unit price
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $bean_details['b_unitprice'] ?> PHP per kg
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Deliver from
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?php
                                echo $this->address->get_string([
                                    'a_id' => $bean_details['b_deliverfrom']
                                ]);
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php if ($bean_details['b_minqty'] > 0) { ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Minimum order quantity
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $bean_details['b_minqty'] ?> kg
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($bean_details['b_orderdays'] > 0) { ?>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <label class="control-label">
                                Order this
                            </label>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p>
                                <?= $bean_details['b_orderdays'] ?> days in advance
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
                                    's_id' => $bean_details['s_id']
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
            <?php
            if (!in_array($request['rb_status'],
                        $this->request_beans->get_eventStatuses([
                        ])
                    )) {
                if (!empty($m_id)) {
                    $the_buyer = $this->member->identify([
                        'm_id'=>$request['m_id']
                    ]);
                    $the_seller = $this->member->find_owner([
                        's_id'=>$request['s_id']
                    ]);
                    $given_subject = "Request inquiry for "
                            .$request['rb_quantity']."-kg "
                            .$bean_details['b_roast']." ".$bean_species;
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
                    form_open('orders/beans/'.$request_string, 'class="form-horizontal"');
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
                                'button_name'=>'heybeans',
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
            }
            ?>
        </div>
    </div>
</div>
