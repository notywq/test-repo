<?php

class form_pieces {
    // TODO Use these to allow saving of form information
    private static $label_size = "col-md-4 col-sm-3";
    private static $input_size = "col-md-4 col-sm-6";
    
    public static function create_textfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="text" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                           value="<?= $data['value'] ?>"
                           >
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_textappendfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['append_text'])) {
            $data['append_text'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <div class="input-group">
                        <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="text" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                               value="<?= $data['value'] ?>"
                               >
                        <span class="input-group-addon"><?= $data['append_text'] ?></span>
                    </div>
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_textareafield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['rows'])) {
            $data['rows'] = "3";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <textarea id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>"
                              placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                              rows="<?= $data['rows'] ?>"
                              ><?= $data['value'] ?></textarea>
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_numberfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="number" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                           value="<?= $data['value'] ?>"
                           >
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_numberappendfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['append_text'])) {
            $data['append_text'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <div class="input-group">
                        <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="number" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                               value="<?= $data['value'] ?>"
                               >
                        <span class="input-group-addon"><?= $data['append_text'] ?></span>
                    </div>
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_datefield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <!-- Text input-->
        <div class="form-group">
            <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>
            <div class="<?= $input_size ?>">
                <div class="input-group date form-date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="text" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                           value="<?= $data['value'] ?>">
                    <span class="input-group-addon"><span class="fas fa-calendar"></span></span>
                </div>
                <span class="help-block"><?= $data['help_text'] ?></span>
            </div>
        </div>
        <?php
    }
    public static function create_selectfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['values']) || !is_array($data['values'])) {
            $data['values'] = array();
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        if (empty($data['selection'])) {
            $data['selection'] = '';
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>
            <div class="<?= $input_size ?>">
                <select id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" class="form-control">
                    <option value=""><?= $data['placeholder'] ?></option>
                    <?php
                    foreach ($data['values'] as $value => $value_label) {
                        ?>
                    <option
                        <?php
                        if ($data['selection'] == $value) {
                            echo 'selected';
                        }
                        ?>
                        value="<?= $value ?>"><?= $value_label ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="help-block"><?= $data['help_text'] ?></span>
            </div>
        </div>
        <?php
    }
    public static function create_passfield($data = []) {
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['variable'])) {
            $data['variable'] = "";
        }
        if (empty($data['placeholder'])) {
            $data['placeholder'] = "";
        }
        if (empty($data['value'])) {
            $data['value'] = "";
        }
        if (empty($data['help_text'])) {
            $data['help_text'] = "";
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['variable'] ?>"><?= $data['variable_label'] ?></label>  
                <div class="<?= $input_size ?>">
                    <input id="<?= $data['variable'] ?>" name="<?= $data['variable'] ?>" type="password" placeholder="<?= $data['placeholder'] ?>" class="form-control input-md"
                           value="<?= $data['value'] ?>"
                           >
                    <span class="help-block"><?= $data['help_text'] ?></span>
                </div>
            </div>
        <?php
    }
    public static function create_boxesfield($data = []) {
        if (!isset($data['variable'])) {
            $data['variable'] = "";
        }
        if (!isset($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (!isset($data['variable_column'])) {
            $data['variable_column'] = "";
        }
        if (!isset($data['variable_column_detail'])) {
            $data['variable_column_detail'] = "";
        }
        if (!isset($data['list'])) {
            $data['list'] = array ();
        }
        $variable = $data['variable'];
        $variable_label = $data['variable_label'];
        $variable_column = $data['variable_column'];
        $variable_column_text = $data['variable_column_text'];
        $variable_column_detail = $data['variable_column_detail'];
        $list = $data['list'];
        
        $selection = array();
        if (!empty($data['selection']) && is_array($data['selection'])) {
            $selection = $data['selection'];
        }
        $max_listheight = "20em";
        if (!empty($data['max_listheight'])) {
            $max_listheight = $data['max_listheight'];
        }
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <style>
                div.longlist {
                    overflow-y: auto;
                    max-height: <?= $max_listheight ?>;
                    border: 1px solid #cccccc;
                    border-radius: 0.5em;
                }
            </style>
            <label class="<?= $label_size ?> control-label" for="<?= $variable ?>"><?= $variable_label ?></label>
            <div class="<?= $input_size ?> longlist">
                <?php
                $i = 0;
                foreach($list as $list_item) {
                ?>
                <div class="checkbox
                     <?php
                     if (empty($variable_column_detail)) {
                         echo "col-xs-6";
                     }
                     ?>">
                    <label for="<?= $variable ?>-<?= $i ?>">
                        <input
                            <?php
                            if (in_array($list_item[$variable_column], $selection)) {
                                echo 'checked';
                            }
                            ?>
                            type="checkbox" name="<?= $variable ?>[]" id="<?= $variable ?>-<?= $i ?>" value="<?= $list_item[$variable_column] ?>">
                        <span>
                            <strong><?= $list_item[$variable_column_text] ?></strong>
                            <?php
                            if (!empty($variable_column_detail)) {
                            ?>
                            <br />
                            <?= $list_item[$variable_column_detail] ?>
                            <?php
                            }
                            ?>
                        </span>
                    </label>
                </div>
                <?php
                    $i++;
                }
                unset($i);
                ?>
            </div>
        </div>
        <?php
    }
    public static function create_radiosfield($data = []) {
        if (!isset($data['variable'])) {
            $data['variable'] = "";
        }
        if (!isset($data['variable_label'])) {
            $data['variable_label'] = "";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (!isset($data['variable_column'])) {
            $data['variable_column'] = "";
        }
        if (!isset($data['variable_column_detail'])) {
            $data['variable_column_detail'] = "";
        }
        if (!isset($data['list'])) {
            $data['list'] = array ();
        }
        $variable = $data['variable'];
        $variable_label = $data['variable_label'];
        $variable_column = $data['variable_column'];
        $variable_column_text = $data['variable_column_text'];
        $variable_column_detail = $data['variable_column_detail'];
        $list = $data['list'];
        
        $selection = array();
        if (isset($data['selection']) && !is_array($data['selection'])) {
            $selection = $data['selection'];
        }
        $max_listheight = "20em";
        if (!empty($data['max_listheight'])) {
            $max_listheight = $data['max_listheight'];
        }
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <style>
                div.longlist {
                    overflow-y: auto;
                    max-height: <?= $max_listheight ?>;
                    border: 1px solid #cccccc;
                    border-radius: 0.5em;
                }
            </style>
            <label class="<?= $label_size ?> control-label" for="<?= $variable ?>"><?= $variable_label ?></label>
            <div class="<?= $input_size ?> longlist">
                <?php
                $i = 0;
                foreach($list as $list_item) {
                ?>
                <div class="radio <?php
                     if (empty($variable_column_detail)) {
                         echo "col-xs-6";
                     }
                     ?>">
                    <label for="<?= $variable ?>-<?= $i ?>">
                        <input
                            <?php
                            if ($list_item[$variable_column] == $selection) {
                                echo 'checked';
                            }
                            ?>
                            type="radio" name="<?= $variable ?>" id="<?= $variable ?>-<?= $i ?>" value="<?= $list_item[$variable_column] ?>">
                        <span>
                            <strong><?= $list_item[$variable_column_text] ?></strong>
                            <?php
                            if (!empty($variable_column_detail)) {
                            ?>
                            <br />
                            <?= $list_item[$variable_column_detail] ?>
                            <?php
                            }
                            ?>
                        </span>
                    </label>
                </div>
                <?php
                    $i++;
                }
                unset($i);
                ?>
            </div>
        </div>
        <?php
    }
    
    public static function createspec_addressselect($data = array()) {
        $province_label = "Province";
        if (isset($data['variable_label_prov'])) {
            $province_label = $data['variable_label_prov'];
        }
        $city_label = "City";
        if (isset($data['variable_label_city'])) {
            $city_label = $data['variable_label_city'];
        }
        $address_label = "Specific address";
        if (isset($data['variable_label_addr'])) {
            $address_label = $data['variable_label_addr'];
        }
        if (isset($data['required']) && $data['required'] == true) {
            $province_label .= "*";
            if (!empty($city_label)) {
                $city_label .= "*";
            }
            if (!empty($address_label)) {
                $address_label .= "*";
            }
        }
        
        $provinces = array();
        if (!empty($data['provinces'])) {
            $provinces = $data['provinces'];
        }
        $cities = array();
        if (!empty($data['cities'])) {
            $cities = $data['cities'];
        }
        $supposed_prov = '';
        if (isset($data['given_prov'])) {
            $supposed_prov = $data['given_prov'];
        }
        $supposed_city = '';
        if (isset($data['given_city'])) {
            $supposed_city = $data['given_city'];
        }
        $supposed_address = set_value('address');
        if (isset($data['given_addr'])) {
            $supposed_address = $data['given_addr'];
        }
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <label class="<?= $label_size ?> control-label" for="province"><?= $province_label ?></label>
            <div class="<?= $input_size ?>">
                <select id="province" name="province" class="form-control">
                    <option value="">Select a province...</option>
                    <?php foreach ($provinces as $prov) { ?>
                        <option
                            <?php
                            if (!empty($supposed_prov) && $prov['a_province'] == $supposed_prov) {
                                echo 'selected';
                            }
                            ?>
                            value="<?= $prov['a_province'] ?>"><?= $prov['a_province'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="<?= $label_size ?> control-label" for="city"><?= $city_label ?></label>
            <div class="<?= $input_size ?>">
                <select id="city" name="city" class="form-control" size="5">
                    <option value="">Select a city...</option>
                    <?php
                    if (!empty($supposed_city)) {
                        foreach ($cities as $city) {
                            ?>
                    <option 
                        <?php
                        if ($city['ac_id'] == $supposed_city) {
                            echo 'selected';
                        }
                        ?>
                        value="<?= $city['ac_id'] ?>"><?= $city['a_city'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        form_pieces::create_textfield([
            'label_size'=>$label_size,
            'input_size'=>$input_size,
            'variable'=>'address',
            'variable_label'=>$address_label,
            'placeholder'=>'Unit number, street address, barangay, etc.',
            'value'=>$supposed_address,
        ]);
    }
    public static function createspec_packoptions($data) {
        if (empty($data['pack_options']) || !is_array($data['pack_options'])) {
            return;
        }
        if (empty($data['variable_label'])) {
            $data['variable_label'] = "Packaging options";
        }
        if (isset($data['required']) && $data['required'] == true) {
            $data['variable_label'] .= "*";
        }
        if (empty($data['detail'])) {
            $data['detail'] = false;
        }
        $selection = array();
        if (!empty($data['selection']) && is_array($data['selection'])) {
            $selection = $data['selection'];
        }
        $pack_options = $data['pack_options'];
        $packopt_price_values = $data['packopt_prices'];
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <label class="<?= $label_size ?> control-label" for="pack_option"><?= $data['variable_label'] ?></label>  
            <div class="<?= $input_size ?>">
                <?php
                $i = 0;
                foreach($pack_options as $options) {
                    ?>
                <div class="row js-checkbox-and-co">
                    <div class="checkbox <?php
                        if (in_array($options['pk_option'], $selection)) {
                            echo 'col-sm-6';
                        }
                        else {
                            echo 'col-sm-12';
                        }
                        ?>">
                        <label>
                            <input type="checkbox" name="pack_option[]" value="<?= $options['pk_option'] ?>"<?php
                                    if (in_array($options['pk_option'], $selection)) {
                                        echo 'checked';
                                    }
                                    ?> />
                            <span><strong><?= $options['pk_option'] ?></strong></span>
                        </label>
                    </div>
                    <div class="js-checkbox-partner col-sm-6 <?php
                            if (!in_array($options['pk_option'], $selection)) {
                                echo 'hidden';
                            }
                            ?>">
                        <div class="input-group">
                            <input <?php
                                if (!in_array($options['pk_option'], $selection)) {
                                    echo 'disabled';
                                }
                                ?> class="form-control input-md" type="text"
                                   name="packopt_price[]"
                                   value="<?php
                                       if (!empty($packopt_price_values[$i])) {
                                           echo $packopt_price_values[$i];
                                       }
                                       ?>" placeholder="Price" />
                            <span class="input-group-addon">PHP</span>
                        </div>
                    </div>
                    <?php
                    if ($data['detail']) {
                    ?>
                    <div class="col-xs-11 col-xs-offset-1">
                        <div class="form-control-static"><?= $options['pkopt_desc'] ?></div class="form-control-static">
                    </div>
                    <?php
                    }
                    ?>
                </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        </div>
        <?php
    }
    
    public static function create_submitbutton($data = []) {
        if (empty($data['context'])) {
            $data['context'] = 'primary';
        }
        if (empty($data['label'])) {
            $data['label'] = "";
        }
        if (empty($data['button_name'])) {
            $data['button_name'] = "submit";
        }
        if (empty($data['button_text'])) {
            $data['button_text'] = "Submit";
        }
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="form-group">
                <label class="<?= $label_size ?> control-label" for="<?= $data['button_name'] ?>"><?= $data['label'] ?></label>
                <div class="<?= $input_size ?>">
                    <button id="<?= $data['button_name'] ?>" name="<?= $data['button_name'] ?>" class="btn btn-<?= $data['context'] ?>"><?= $data['button_text'] ?></button>
                </div>
            </div>
        <?php
    }
    public static function create_alert($data = []) {
        if (empty($data['context'])) {
            $data['context'] = 'info';
        }
        if (empty($data['label'])) {
            $data['label'] = '';
        }
        if (empty($data['text'])) {
            $data['text'] = '';
        }
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
            <div class="alert alert-dismissible alert-<?= $data['context'] ?>">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-group">
                    <label class="<?= $label_size ?> control-label"><?= $data['label'] ?></label>
                    <div class="<?= $input_size ?>">
                        <div class='form-control-static'><?= $data['text'] ?></div>
                    </div>
                </div>
            </div>
        <?php
    }
    public static function create_label($data = []) {
        if (empty($data['label'])) {
            $data['label'] = '';
        }
        if (empty($data['text'])) {
            $data['text'] = '';
        }
        
        $label_size = form_pieces::$label_size;
        $input_size = form_pieces::$input_size;
        if (isset($data['label_size'])) {
            $label_size = $data['label_size'];
        }
        if (isset($data['input_size'])) {
            $input_size = $data['input_size'];
        }
        ?>
        <div class="form-group">
            <label class="<?= $label_size ?> control-label h4 text-uppercase">
                <?= $data['label'] ?>
            </label>
            <?php
            if (!empty($data['text'])) {
                ?>
            <div class="<?= $input_size ?>">
                <div class='form-control-static'><?= $data['text'] ?></div>
            </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}
