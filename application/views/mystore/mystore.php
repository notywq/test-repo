<style>
    .head-and-actions {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }
</style>
<div id="content">
    <div class="container-fluid">
        <h1><?= $page_title ?></h1>
        <p>Manage your store here.</p>
        <div class="container">
            <div class="row">
                <span class="h2"><?= $s_name ?></span>
                <span class="pull-right">
                    <a class="btn btn-default">
                        <span class="fas fa-wrench"></span><br />
                        &nbsp;Manage <span class="hidden-xs">store</span></a>
                </span>
                <br />
                <span class="h2"><small><?= $s_open ?></small></span>
            </div>
            <hr />
            <div class="row">
                <span class="h3">Products</span>
                <!-- Beans -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 head-and-actions">
                            <p class="h4">
                                <span><?= count($beans_list) ?> beans</span>
                            </p>
                        </div><!-- Needed to
                        prevent line breaks --><div class="col-xs-6 head-and-actions">
                            <p class="h3 text-right">
                                <span>
                                    <a class="btn text-primary btn-sm" href="mystore/addbeans">
                                        <span class="fas fa-plus-circle"></span>
                                        &nbsp;Add <span class="hidden-xs">beans</span></a>
                                    <a class="btn text-primary btn-sm">
                                        <span class="fas fa-pencil-alt"></span>
                                        &nbsp;Manage <span class="hidden-xs">beans</span></a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($beans_list) && is_array($beans_list)) {
                ?>
                <br />
                <div class="container">
                    <div class="row">
                        <div id="beans-table">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Bean batch</th>
                                        <th class="hidden-xs">Other ingredients</th>
                                        <th class="hidden-xs">Origin</th>
                                        <th class="text-right">Roast date</th>
                                        <th class="text-right">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                        foreach ($beans_list as $beans) {
                            $beans['b_species'] = $this->beans->get_thatSpeciesString([
                               'b_id' => $beans['b_id']
                            ]);
                            $beans['b_additions'] = $this->beans->get_thoseAdditionsString([
                               'b_id' => $beans['b_id']
                            ]);
                            ?>  
                                    <tr>
                                        <td>
                                            <span class="h4">
                                                <strong><?= $beans['b_species'] ?></strong><br />
                                                <small><?= $beans['b_roast'] ?> roast</small>
                                            </span>
                                        </td>
                                        <td class="hidden-xs">
                                            <span><?= $beans['b_additions'] ?></span>
                                        </td>
                                        <td class="hidden-xs">
                                            <span><?= $beans['b_origin'] ?></span>
                                        </td>
                                        <td class="text-right">
                                            <span><?= $beans['b_roastdate'] ?></span>
                                        </td>
                                        <td class="text-right">
                                            <span><?= $beans['b_unitprice'] ?> PHP</span>
                                        </td>
                                    </tr>
                            <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <!-- Packaging -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 head-and-actions">
                            <p class="h4">
                                <span><?= count($pack_list) ?> packages</span>
                            </p>
                        </div><!-- Needed to
                        prevent line breaks --><div class="col-xs-6 head-and-actions">
                            <p class="h3 text-right">
                                <span>
                                    <a class="btn text-primary btn-sm" href="mystore/addpack">
                                        <span class="fas fa-plus-circle"></span>
                                        &nbsp;Add <span class="hidden-xs">packages</span></a>
                                    <a class="btn text-primary btn-sm">
                                        <span class="fas fa-pencil-alt"></span>
                                        &nbsp;Manage <span class="hidden-xs">packages</span></a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($pack_list) && is_array($pack_list)) {
                ?>
                <br />
                <div class="container">
                    <div class="row">
                        <div id="pack-table">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Package</th>
                                        <th class="hidden-xs">Description</th>
                                        <th class="hidden-xs">Options</th>
                                        <th class="text-right">Quantity per set</th>
                                        <th class="text-right">Set price</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                        foreach ($pack_list as $pack) {
                            $whole_capacity = round($pack['pk_capacity']);
                            $my_options = $this->package->get_myOptions([
                                'pk_id'=>$pack['pk_id'],
                            ]);
                            ?>  
                                    <tr>
                                        <td>
                                            <span class="h4">
                                                <strong>
                                                    <?= $whole_capacity ?>g
                                                    <?= $pack['pk_type'] ?>,
                                                    <?= $pack['pk_color'] ?>
                                                </strong><br />
                                                <small><?= $pack['pk_material'] ?></small>
                                            </span>
                                        </td>
                                        <td class="hidden-xs">
                                            <span><?= $pack['pk_desc'] ?></span>
                                        </td>
                                        <td class="hidden-xs">
                                            <?php
                                            foreach($my_options as $my_option) {
                                            ?>
                                            <span><?= $my_option['pk_option'] ?></span> -
                                            <span><?= $my_option['pkopt_price'] ?></span> PHP
                                            <?php
                                                if (next($my_options) !== false) {
                                                    echo "<br />";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <span><?= $pack['pk_qtyperunit'] ?> pcs</span>
                                        </td>
                                        <td class="text-right">
                                            <span><?= $pack['pk_unitprice'] ?> PHP</span>
                                        </td>
                                    </tr>
                            <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <br />
            <div class="row">
                <span class="h3">Services</span>
                <!-- Roasts -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 head-and-actions">
                            <p class="h4">
                                <span><?= count($roast_list) ?> roasters</span>
                            </p>
                        </div><!-- Needed to
                        prevent line breaks --><div class="col-xs-6 head-and-actions">
                            <p class="h3 text-right">
                                <span>
                                    <a class="btn text-primary btn-sm" href="mystore/addroast">
                                        <span class="fas fa-plus-circle"></span>
                                        &nbsp;Add <span class="hidden-xs">roasts</span></a>
                                    <a class="btn text-primary btn-sm">
                                        <span class="fas fa-pencil-alt"></span>
                                        &nbsp;Manage <span class="hidden-xs">roasts</span></a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($roast_list) && is_array($roast_list)) {
                ?>
                <br />
                <div class="container">
                    <div class="row">
                        <div id="roasts-table">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Roast support</th>
                                        <th>Address</th>
                                        <th class="hidden-xs">Description</th>
                                        <th class="text-right hidden-xs">Price per unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                        foreach ($roast_list as $roast) {
                            $roast_support = $this->roast->get_roastSupportString([
                                'ro_id'=>$roast['ro_id']
                            ]);
                            $roast_address = $this->address->get_string(['a_id'=>$roast['ro_address']]);
                            ?>  
                                    <tr>
                                        <td>
                                            <span class="h4">
                                                <strong><?= $roast_support ?></strong><br />
                                                <small>roasts</small>
                                            </span>
                                        </td>
                                        <td>
                                            <span><?= $roast_address ?></span>
                                        </td>
                                        <td class="hidden-xs">
                                            <span><?= $roast['ro_desc'] ?></span>
                                        </td>
                                        <td class="text-right hidden-xs">
                                            <span><?= $roast['ro_unitprice'] ?> PHP</span>
                                        </td>
                                    </tr>
                            <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <!-- Processing -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 head-and-actions">
                            <p class="h4">
                                <span><?= count($proc_list) ?> processors</span>
                            </p>
                        </div><!-- Needed to
                        prevent line breaks --><div class="col-xs-6 head-and-actions">
                            <p class="h3 text-right">
                                <span>
                                    <a class="btn text-primary btn-sm" href="mystore/addproc">
                                        <span class="fas fa-plus-circle"></span>
                                        &nbsp;Add <span class="hidden-xs">processors</span></a>
                                    <a class="btn text-primary btn-sm">
                                        <span class="fas fa-pencil-alt"></span>
                                        &nbsp;Manage <span class="hidden-xs">processors</span></a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($proc_list) && is_array($proc_list)) {
                ?>
                <br />
                <div class="container">
                    <div class="row">
                        <div id="processing-table">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Processing activity</th>
                                        <th>Address</th>
                                        <th class="hidden-xs">Description</th>
                                        <th class="text-right hidden-xs">Price per unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                        foreach ($proc_list as $proc) {
                            $processor_address = $this->address->get_string(['a_id'=>$proc['proc_address']]);
                            ?>  
                                    <tr>
                                        <td>
                                            <span class="h4">
                                                <strong><?= $proc['proc_activity'] ?></strong><br />
                                                <small>process</small>
                                            </span>
                                        </td>
                                        <td>
                                            <span><?= $processor_address ?></span>
                                        </td>
                                        <td class="hidden-xs">
                                            <span><?= $proc['proc_desc'] ?></span>
                                        </td>
                                        <td class="text-right hidden-xs">
                                            <span><?= $proc['proc_unitprice'] ?> PHP</span>
                                        </td>
                                    </tr>
                            <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
