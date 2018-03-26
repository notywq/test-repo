<div id='content'>
    <div class='container-fluid'>
        <h1><?= $page_title ?></h1>
        <p>Hello <?= $m_fname ?>, and welcome to WebKape!</p>
        <div class="container">
            <div class="row">
                <span class="h2">Your orders</span>
                <div class="container">
                    <p class="h4">
                        <?= count($request_beans) ?> bean requests
                    </p>
                </div>
                <?php
                if (!empty($request_beans)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($request_beans as $request) {
                            $subject_bean_id = $request['b_id'];
                            $subject_bean = $this->beans->identify([
                                'b_id' => $subject_bean_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="your-rb-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="your-rb-checkboxes[]" id="your-rb-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['b_id'=>$request['b_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rb_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/beans/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rb_quantity'] ?> kg
                                        <br />
                                        <strong><strong><?= $this->beans->get_thatSpeciesString(['b_id'=>$subject_bean_id]); ?></strong></strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small><?= $subject_bean['b_roast'] ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_beans->get_thatStatus([
                                            'rb_status' => $request['rb_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rb_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Sold by
                                        <a href="#">
                                            <?php
                                            $other_store = $this->store->track(['b_id'=>$request['b_id']]);
                                            echo $other_store['s_name'];
                                            ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($request_beans))) { ?><hr /><?php }
                            $i++;
                            ?>    
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($request_pack) ?> packaging requests
                    </p>
                </div>
                <?php
                if (!empty($request_pack)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($request_pack as $request) {
                            $subject_pack_id = $request['pk_id'];
                            $subject_pack = $this->package->identify([
                                'pk_id' => $subject_pack_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="your-rpack-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="your-rpack-checkboxes[]" id="your-rpack-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['pk_id'=>$request['pk_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rpk_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/pack/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rpk_quantity'] ?> sets
                                        <br />
                                        <strong>
                                            <?= round($subject_pack['pk_capacity']) ?>g
                                            <?= $subject_pack['pk_color'] ?>
                                            <?= $subject_pack['pk_type'] ?>
                                        </strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small><?= $subject_pack['pk_material'] ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_packaging->get_thatStatus([
                                            'rpk_status' => $request['rpk_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rpk_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Sold by
                                        <a href="#">
                                            <?php
                                            echo $other_store['s_name'];
                                            ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_roast))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($request_roast) ?> roast requests
                    </p>
                </div>
                <?php
                if (!empty($request_roast)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($request_roast as $request) {
                            $subject_roast_id = $request['ro_id'];
                            $subject_roast = $this->roast->identify([
                                'ro_id' => $subject_roast_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="your-rro-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="your-rro-checkboxes[]" id="your-rro-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['ro_id'=>$request['ro_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rro_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/roast/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rro_quantity'] ?> kg
                                        <br />
                                        <strong><?= $request['rro_roast'] ?> roast</strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small>at <?= $this->address->get_string([
                                            'a_id'=>$subject_roast['ro_address'],
                                            'pref'=>'c,p',
                                        ]) ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_roast->get_thatStatus([
                                            'rro_status' => $request['rro_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rro_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Sold by
                                        <a href="#">
                                            <?php
                                            echo $other_store['s_name'];
                                            ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($request_roast))) { ?><hr /><?php }
                            $i++;
                            ?>    
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($request_proc) ?> processing requests
                    </p>
                </div>
                <?php
                if (!empty($request_proc)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($request_proc as $request) {
                            $subject_proc_id = $request['proc_id'];
                            $subject_proc = $this->processing->identify([
                                'proc_id' => $subject_proc_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="your-rproc-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="your-rproc-checkboxes[]" id="your-rproc-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['proc_id'=>$request['proc_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rproc_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/proc/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rproc_quantity'] ?> kg
                                        <br />
                                        <strong><?= $subject_proc['proc_activity'] ?></strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small>at <?= $this->address->get_string([
                                            'a_id'=>$subject_proc['proc_address'],
                                            'pref'=>'c,p',
                                        ]) ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_processing->get_thatStatus([
                                            'rproc_status' => $request['rproc_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rproc_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Sold by
                                        <a href="#">
                                            <?php
                                            echo $other_store['s_name'];
                                            ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_roast))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <br />
            <div class="row">
                <span class="h2">Received orders</span>
                <div class="container">
                    <p class="h4">
                        <?= count($requesting_beans) ?> bean requests
                    </p>
                </div>
                <?php
                if (!empty($requesting_beans)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($requesting_beans as $request) {
                            $subject_bean_id = $request['b_id'];
                            $subject_bean = $this->beans->identify([
                                'b_id' => $subject_bean_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="their-rb-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="their-rb-checkboxes[]" id="their-rb-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['b_id'=>$request['b_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rb_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/beans/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rb_quantity'] ?> kg
                                        <br />
                                        <strong><strong><?= $this->beans->get_thatSpeciesString(['b_id'=>$subject_bean_id]); ?></strong></strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small><?= $subject_bean['b_roast'] ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_beans->get_thatStatus([
                                            'rb_status' => $request['rb_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rb_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Ordered by
                                        <?php
                                        $that_member = $this->member->identify([
                                            'm_id'=>$request['m_id']
                                        ]);
                                        $member_flName = $that_member['m_fname'].' '.
                                                $that_member['m_lname'];
                                        ?>
                                        <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                            'm_id' => $that_member['m_id']
                                                ])) ?>">
                                            <?= $member_flName ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_beans))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($requesting_pack) ?> packaging requests
                    </p>
                </div>
                <?php
                if (!empty($requesting_pack)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($requesting_pack as $request) {
                            $subject_pack_id = $request['pk_id'];
                            $subject_pack = $this->package->identify([
                                'pk_id' => $subject_pack_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="your-rpack-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="your-rpack-checkboxes[]" id="your-rpack-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['pk_id'=>$request['pk_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rpk_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/pack/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rpk_quantity'] ?> sets
                                        <br />
                                        <strong>
                                            <?= round($subject_pack['pk_capacity']) ?>g
                                            <?= $subject_pack['pk_color'] ?>
                                            <?= $subject_pack['pk_type'] ?>
                                        </strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small><?= $subject_pack['pk_material'] ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_packaging->get_thatStatus([
                                            'rpk_status' => $request['rpk_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rpk_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Ordered by
                                        <?php
                                        $that_member = $this->member->identify([
                                            'm_id'=>$request['m_id']
                                        ]);
                                        $member_flName = $that_member['m_fname'].' '.
                                                $that_member['m_lname'];
                                        ?>
                                        <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                            'm_id' => $that_member['m_id']
                                                ])) ?>">
                                            <?= $member_flName ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_roast))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($requesting_roast) ?> roast requests
                    </p>
                </div>
                <?php
                if (!empty($requesting_roast)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($requesting_roast as $request) {
                            $subject_roast_id = $request['ro_id'];
                            $subject_roast = $this->roast->identify([
                                'ro_id' => $subject_roast_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="their-rro-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="their-rro-checkboxes[]" id="their-rro-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['ro_id'=>$request['ro_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rro_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/roast/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rro_quantity'] ?> kg
                                        <br />
                                        <strong><?= $request['rro_roast'] ?> roast</strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small>at <?= $this->address->get_string([
                                            'a_id'=>$subject_roast['ro_address'],
                                            'pref'=>'c,p',
                                        ]) ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_roast->get_thatStatus([
                                            'rro_status' => $request['rro_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rro_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Ordered by
                                        <?php
                                        $that_member = $this->member->identify([
                                            'm_id'=>$request['m_id']
                                        ]);
                                        $member_flName = $that_member['m_fname'].' '.
                                                $that_member['m_lname'];
                                        ?>
                                        <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                            'm_id' => $that_member['m_id']
                                                ])) ?>">
                                            <?= $member_flName ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_roast))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="container">
                    <p class="h4">
                        <?= count($requesting_proc) ?> processing requests
                    </p>
                </div>
                <?php
                if (!empty($requesting_proc)) {
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($requesting_proc as $request) {
                            $subject_proc_id = $request['proc_id'];
                            $subject_proc = $this->processing->identify([
                                'proc_id' => $subject_proc_id
                            ]);
                        ?>
                        <div class="col-sm-6">
                            <div class="col-xs-1 pull-left">
                                <label class="checkbox-inline" for="their-rproc-checkboxes-<?= $i ?>">
                                    <input class="form-control input-sm" type="checkbox" name="their-rproc-checkboxes[]" id="their-rproc-checkboxes-<?= $i ?>" value="<?= $i ?>">
                                </label>
                            </div>
                            <div class="col-sm-pull-1 col-xs-1 col-xs-pull-2 pull-right">
                                <?php
                                $other_store = $this->store->track(['proc_id'=>$request['proc_id']]);
                                $that_member = $this->member->identify([
                                    'm_id'=>$request['m_id']
                                ]);
                                $member_fName = $that_member['m_fname'];
                                $link_fName = preg_replace('/\s+/', '_', $member_fName);
                                $link_sName = preg_replace('/\s+/', '_', $other_store['s_name']);
                                $link_id = preg_replace('/\s+/', '_', $request['rproc_id']);
                                $order_link = html_escape($link_fName.
                                        "+".$link_sName.
                                        "+".$link_id);
                                ?>
                                <a href="<?= site_url('orders/proc/'.$order_link) ?>"
                                    class="btn btn-link">
                                    <span class="fas fa-info-circle"></span>
                                    &nbsp;View</a>
                            </div>
                            <div class="col-sm-4 col-sm-offset-0 col-xs-7 col-xs-offset-1">
                                <span>
                                    <span class="h4">
                                        <?= $request['rproc_quantity'] ?> kg
                                        <br />
                                        <strong><?= $subject_proc['proc_activity'] ?></strong>
                                    </span>
                                    <br />
                                    <span class="h4">
                                        <small>at <?= $this->address->get_string([
                                            'a_id'=>$subject_proc['proc_address'],
                                            'pref'=>'c,p',
                                        ]) ?></small>
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-5 col-sm-offset-0 col-xs-7 col-xs-offset-2">
                                <p>
                                    <span>
                                        <?php
                                        $given_status = $this->request_processing->get_thatStatus([
                                            'rproc_status' => $request['rproc_status'],
                                            'is_seller' => $this->session->m_id !== $request['m_id'],
                                        ]);
                                        echo $given_status;
                                        ?>
                                    </span>
                                    <br />
                                    <span>
                                        due <?= $request['rproc_duedate'] ?>
                                    </span>
                                </p>
                                <p>
                                    <span>Ordered by
                                        <?php
                                        $that_member = $this->member->identify([
                                            'm_id'=>$request['m_id']
                                        ]);
                                        $member_flName = $that_member['m_fname'].' '.
                                                $that_member['m_lname'];
                                        ?>
                                        <a href="<?= site_url('profile/'.$this->user->get_theirUname([
                                            'm_id' => $that_member['m_id']
                                                ])) ?>">
                                            <?= $member_flName ?>
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-12">
                            <?php
                            if (!empty(next($requesting_roast))) { ?><hr /><?php }
                            $i++;
                            ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <br />
        </div>
        <?php
        if (isset($has_store) && !$has_store) {
        ?>
        <div class="container">
            <div class="row">
                <div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        <strong class="lead">Want to make a store?</strong>
                        <?= form_open('mystore/setup', 'class="form-inline"') ?>
                        <label class="control-label" for="sname">Store name</label>  
                        <input id="sname" name="sname"
                               type="text" placeholder="Store name" 
                               class="form-control input-sm">
                        <button type="submit" class="btn btn-sm btn-default">
                            Open my store</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
