<?php
// TODO work on dead links (in dropdown menus)
// TODO work on showing other notifications, and limiting those of other sources
$logged_in = isset($m_id) && is_numeric($m_id);
$member_fmlName;
$member_flName;
if ($logged_in) {
    $member_fmlName = $this->member->get_name([
        'm_id' => $m_id,
    ]);
}
if ($logged_in) {
    $member_flName = $this->member->get_name([
        'm_id' => $m_id,
        'pref' => 'fl'
    ]);
}
?>
<!--Navbar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <!--Modern navbar-->
    <div class="container-fluid hidden-xs">
        <div class="navbar-header">
            <a href="<?= site_url('home') ?>" class="navbar-brand">
                WebKape
            </a>
        </div>

        <?php
        if (isset($logged_in) && $logged_in == TRUE) {
            ?>
            <ul class="nav navbar-nav">
                <li <?php if ($page_title == "Dashboard") { ?>class="active"<?php } ?>><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li <?php if ($page_title == "Orders") { ?>class="active"<?php } ?>><a href="<?= site_url('orders') ?>">Orders</a></li>
                <li <?php if ($page_title == "My store") { ?>class="active"<?php } ?>><a href="<?= site_url('mystore') ?>">My store</a></li>
                <li <?php if ($page_title == "Browse") { ?>class="active"<?php } ?>><a href="<?= site_url('browse') ?>">Browse</a></li>
            </ul>
            <div class="navbar-header navbar-right">
                <span>
                    <a href="#" class="btn btn-link navbar-btn" data-toggle="dropdown">
                        <span class="fas fa-comments"></span>
                        <span>
                            <?php
                            $my_msgs = $this->message->get_msgs([
                                'm_id' => $this->session->m_id
                            ]);
                            $my_unread_msgs = count($this->message->get_msgs([
                                        'm_id' => $this->session->m_id,
                                        'msg_read' => 0
                            ]));
                            if (!empty($my_unread_msgs)) {
                                echo $my_unread_msgs;
                            }
                            ?>
                        </span>
                        <span class="hidden-sm hidden-xs">&nbsp;Messages</span>
                    </a>
                    <ul class="dropdown-menu notify-panel">
                        <?php
                        foreach ($my_msgs as $msg) {
                            $unread_status = "";
                            $icon = "fas fa-envelope-open";
                            if ($msg['msg_read'] == 0) {
                                $unread_status = "notify-unread";
                                $icon = "fas fa-envelope";
                            }
                            $sender_name = $this->member->get_name([
                                'm_id' => $msg['msg_sender'],
                                'pref' => 'fl'
                            ]);
                            $sm_body = $this->message->cut_body([
                                'msg_body' => $msg['msg_body']
                            ]);
                            ?>
                            <li class='container-fluid'>
                                <a href='#' class='row <?= $unread_status ?>'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="<?= $icon ?>"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong><?= $msg['msg_subject'] ?></strong><br />
                                                <small>from <?= $sender_name ?></small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small><?= $sm_body ?></small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        if (empty($my_msgs)) {
                            ?>
                            <li class="text-left">
                                <a>
                                    <span class="h5 navbar-head-and-actions">
                                        Nothing new today.
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="text-right">
                            <!-- TODO Add link here -->
                            <a href="#">
                                <span class="h5 navbar-head-and-actions">
                                    <span class="fas fa-angle-right"></span>
                                    See all messages
                                </span>
                            </a>
                        </li>
                    </ul>
                </span>
                <span>
                    <a href="#" class="btn btn-link navbar-btn" data-toggle="dropdown">
                        <span class="fas fa-bell"></span>
                        <span>
                            <?php
                            $my_notifs = $this->notification->get_notifs([
                                'm_id' => $this->session->m_id,
                                'limit' => 0
                            ]);
                            $my_unread_notifs = count($this->notification->get_notifs([
                                'm_id' => $this->session->m_id,
                                'n_read' => 0
                            ]));
                            if (!empty($my_unread_notifs)) {
                                echo $my_unread_notifs;
                            }
                            ?>
                        </span>
                        <span class="hidden-sm hidden-xs">&nbsp;Notifications</span>
                    </a>
                    <ul class="dropdown-menu notify-panel">
                        <?php
                        foreach ($my_notifs as $notif) {
                            $ticker_line1 = $notif['n_ticker'];
                            $ticker_line2 = "";
                            $ticker_line3 = "";
                            $msg_line1 = "";
                            $msg_line2 = "";
                            $icon = "fas fa-certificate";
                            $unread_status = "";
                            $href = site_url($notif['n_slug']);
                            
                            if (!$notif['n_read']) {
                                $unread_status = "notify-unread";
                            }
                            switch ($notif['n_type']) {
                                case 'request': {
                                    $request_split = explode('/', $notif['n_slug']);
                                    $rh_type = $request_split[1];
                                    $ritem_split = explode('+', $request_split[2]);
                                    $ritem_id = array_pop($ritem_split);
                                    switch ($rh_type) {
                                        case 'beans': {
                                            $rbean = $this->request_beans->identify([
                                                'rb_id' => $ritem_id
                                            ]);

                                            $rbean_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $bean_species = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'b_species',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $bean_roast = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'b_roast',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $ticker_line2 = $rbean_quantity." kg of";
                                            $ticker_line3 = $bean_roast." ".$bean_species;

                                            $bean_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $bean_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $is_seller = $bean_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $bean_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $bean_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;

                                            $rbean_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rbean['rb_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rbean_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'pack': {
                                            $rpack = $this->request_packaging->identify([
                                                'rpk_id' => $ritem_id
                                            ]);
                                            
                                            $rpack_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $pack_capacity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'pk_capacity',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $pack_type = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'pk_type',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $ticker_line2 = $rpack_quantity." sets of";
                                            $ticker_line3 = $pack_capacity." g ".$pack_type;

                                            $pack_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $pack_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $is_seller = $pack_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $pack_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $pack_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;

                                            $rpack_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rpack['rpk_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rpack_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'roast': {
                                            $rroast = $this->request_roast->identify([
                                                'rro_id' => $ritem_id
                                            ]);

                                            $roast_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $roast_addressID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_deliverto',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $roast_address = $this->address->get_string([
                                                'a_id'=>$roast_addressID,
                                                'pref'=>'c,p',
                                            ]);
                                            $ticker_line2 = "Roasting ".$roast_quantity." kg";
                                            $ticker_line3 = "at ".$roast_address;
                                            
                                            $roast_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rroast['rro_created']
                                            ]);
                                            $roast_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rroast['rro_created']
                                            ]);
                                            $is_seller = $roast_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $roast_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $roast_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;
                                            
                                            $rroast_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rroast['rro_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rroast_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'proc': {
                                            $rproc = $this->request_processing->identify([
                                                'rproc_id' => $ritem_id
                                            ]);

                                            $proc_activity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'proc_activity',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $proc_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $proc_addressID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_deliverto',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $proc_address = $this->address->get_string([
                                                'a_id'=>$proc_addressID,
                                                'pref'=>'c,p',
                                            ]);
                                            $ticker_line2 = $proc_activity." ".$proc_quantity." kg";
                                            $ticker_line3 = "at ".$proc_address;
                                            
                                            $proc_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $proc_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $is_seller = $proc_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $proc_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $proc_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;
                                            
                                            $rproc_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rproc['rproc_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rproc_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                            ?>
                            <li class='container-fluid'>
                                <a href='<?= $href ?>'
                                   class='row <?= $unread_status ?>'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="<?= $icon ?>"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong><?= $ticker_line1 ?></strong>
                                                <?php
                                                if (!empty($ticker_line2) || !empty($ticker_line3)) {
                                                ?>
                                                <br />
                                                <small><?= $ticker_line2 ?></small><br />
                                                <small><?= $ticker_line3 ?></small>
                                                <?php
                                                }
                                                ?>
                                            </span>
                                            <?php
                                            if (!empty($msg_line1) || !empty($msg_line2)) {
                                            ?>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                    <span><?= $msg_line1 ?></span><br />
                                                    <span><?= $msg_line2 ?></span>
                                                </small>
                                            </span>
                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        if (empty($my_notifs)) {
                            ?>
                            <li class="text-left">
                                <a>
                                    <span class="h5 navbar-head-and-actions">
                                        Nothing new today.
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="text-right">
                            <!-- TODO Add link here -->
                            <a href="#">
                                <span class="h5 navbar-head-and-actions">
                                    <span class="fas fa-angle-right"></span>
                                    See all notifications
                                </span>
                            </a>
                        </li>
                    </ul>
                </span>
                <span>
                    <a class="btn btn-link navbar-btn dropdown-toggle" data-toggle="dropdown">
                        <span class="fas fa-user-circle"></span>
                        <span class="hidden-sm">&nbsp;<?= $member_fmlName ?>&nbsp;</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="visible-sm dropdown-header">Logged in as:</li>
                        <li class="visible-sm"><a ><?= $member_flName ?></a></li>
                        <li role="separator" class="visible-sm divider"></li>
                        <li <?php
                    if ($page_title == "Profile") {
                        echo 'class="active"';
                    }
                        ?>><a href="<?= site_url('profile') ?>"><span class="fas fa-user"></span>&nbsp;Profile</a></li>
                        <li><a ><span class="fas fa-cog"></span>&nbsp;Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('logout') ?>"><span class="fas fa-sign-out-alt"></span>&nbsp;Log out</a></li>
                    </ul>
                </span>
            </div>
            <?php
        } else {
            ?>
            <!--Navbar sections as lists-->
            <ul class="nav navbar-nav">
                <li <?php if ($page_title == 'Browse') { ?>class="active"<?php } ?>>
                    <a href="<?= site_url('browse') ?>">Browse</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($page_title == 'Log in') { ?>class="active"<?php } ?>>
                    <a href="<?= site_url('login') ?>">Log in</a>
                </li>
                <li <?php if ($page_title == 'Sign up') { ?>class="active"<?php } ?>>
                    <a href="<?= site_url('signup') ?>">Sign up</a>
                </li>
            </ul>
    <?php
}
?>
    </div>

    <!--Alternative navbar for mobile (uses sidebar)-->
    <div class="container-fluid visible-xs">
<?php
if (isset($logged_in) && $logged_in == true) {
    ?>
            <div class="navbar-header">
                <a class="btn btn-default navbar-brand sidebarCollapse">
                    <span class="fas fa-bars"></span>
                </a>
                <span>
                    <a class="btn btn-default navbar-brand" data-toggle="dropdown">
                        WebKape
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Logged in as:</li>
                        <li><a ><?= $member_flName ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?= site_url('home') ?>">
                                <span class="fas fa-home"></span>
                                &nbsp;Home</a>
                        </li>
                        <li <?php if ($page_title == "Profile") { echo 'class="active"'; }?>>
                            <a href="<?= site_url('profile') ?>">
                                <span class="fas fa-user"></span>
                                &nbsp;Profile</a>
                        </li>
                        <li>
                            <a >
                                <span class="fas fa-cog"></span>
                                &nbsp;Settings</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?= site_url('logout') ?>">
                                <span class="fas fa-sign-out-alt"></span>
                                &nbsp;Log out</a>
                        </li>
                    </ul>
                </span>

                <!-- NOTE: With .navbar-toggle, the buttons will be
                in reverse order. -->

                <span>
                    <a href="#" class="btn btn-link navbar-toggle" data-toggle="dropdown">
                        <span class="fas fa-bell"></span>
                        <span>
                            <?php
                            $my_notifs = $this->notification->get_notifs([
                                'm_id' => $this->session->m_id,
                                'limit' => 0
                            ]);
                            $my_unread_notifs = count($this->notification->get_notifs([
                                'm_id' => $this->session->m_id,
                                'n_read' => 0
                            ]));
                            if (!empty($my_unread_notifs)) {
                                echo $my_unread_notifs;
                            }
                            ?>
                        </span>
                        <span class="hidden-sm hidden-xs">&nbsp;Notifications</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notify-panel">
                        <?php
                        foreach ($my_notifs as $notif) {
                            $ticker_line1 = $notif['n_ticker'];
                            $ticker_line2 = "";
                            $ticker_line3 = "";
                            $msg_line1 = "";
                            $msg_line2 = "";
                            $icon = "fas fa-certificate";
                            $unread_status = "";
                            $href = site_url($notif['n_slug']);
                            
                            if (!$notif['n_read']) {
                                $unread_status = "notify-unread";
                            }
                            switch ($notif['n_type']) {
                                case 'request': {
                                    $request_split = explode('/', $notif['n_slug']);
                                    $rh_type = $request_split[1];
                                    $ritem_split = explode('+', $request_split[2]);
                                    $ritem_id = array_pop($ritem_split);
                                    switch ($rh_type) {
                                        case 'beans': {
                                            $rbean = $this->request_beans->identify([
                                                'rb_id' => $ritem_id
                                            ]);

                                            $rbean_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $bean_species = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'b_species',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $bean_roast = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'b_roast',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $ticker_line2 = $rbean_quantity." kg of";
                                            $ticker_line3 = $bean_roast." ".$bean_species;

                                            $bean_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $bean_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rbean['rb_created']
                                            ]);
                                            $is_seller = $bean_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $bean_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $bean_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;

                                            $rbean_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rbean['rb_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rbean_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rb_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'pack': {
                                            $rpack = $this->request_packaging->identify([
                                                'rpk_id' => $ritem_id
                                            ]);
                                            
                                            $rpack_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $pack_capacity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'pk_capacity',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $pack_type = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'pk_type',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $ticker_line2 = $rpack_quantity." sets of";
                                            $ticker_line3 = $pack_capacity." g ".$pack_type;

                                            $pack_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $pack_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rpack['rpk_created']
                                            ]);
                                            $is_seller = $pack_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $pack_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $pack_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;

                                            $rpack_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rpack['rpk_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rpack_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rpk_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'roast': {
                                            $rroast = $this->request_roast->identify([
                                                'rro_id' => $ritem_id
                                            ]);

                                            $roast_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $roast_addressID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_deliverto',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $roast_address = $this->address->get_string([
                                                'a_id'=>$roast_addressID,
                                                'pref'=>'c,p',
                                            ]);
                                            $ticker_line2 = "Roasting ".$roast_quantity." kg";
                                            $ticker_line3 = "at ".$roast_address;
                                            
                                            $roast_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rroast['rro_created']
                                            ]);
                                            $roast_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rroast['rro_created']
                                            ]);
                                            $is_seller = $roast_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $roast_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $roast_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;
                                            
                                            $rroast_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rroast['rro_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rroast_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rro_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                        case 'proc': {
                                            $rproc = $this->request_processing->identify([
                                                'rproc_id' => $ritem_id
                                            ]);

                                            $proc_activity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'proc_activity',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $proc_quantity = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_quantity',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $proc_addressID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_deliverto',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $proc_address = $this->address->get_string([
                                                'a_id'=>$proc_addressID,
                                                'pref'=>'c,p',
                                            ]);
                                            $ticker_line2 = $proc_activity." ".$proc_quantity." kg";
                                            $ticker_line3 = "at ".$proc_address;
                                            
                                            $proc_mID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'm_id',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $proc_sID = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 's_id',
                                                'timestamp' => $rproc['rproc_created']
                                            ]);
                                            $is_seller = $proc_mID !== $m_id;
                                            $sender_text = "";
                                            if ($is_seller) {
                                                $sender_name = $this->member->get_name([
                                                    'm_id' => $proc_mID,
                                                    'pref' => 'fl'
                                                ]);
                                                $sender_text = "for " . $sender_name;
                                            } else {
                                                $sender = $this->store->identify([
                                                    's_id' => $proc_sID,
                                                ]);
                                                $sender_name = $sender['s_name'];
                                                $sender_text = "from " . $sender_name;
                                            }
                                            $msg_line1 = $sender_text;
                                            
                                            $rproc_status = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_status',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $datetime1 = new DateTime($rproc['rproc_created']);
                                            $datetime2 = new DateTime($notif['n_created']);
                                            $interval = $datetime1->diff($datetime2);
                                            $datediffsecs = $interval->format('%r%s');
                                            switch ($rproc_status) {
                                                case 0: {
                                                        if ($datediffsecs <= 0) {
                                                            $icon = "fas fa-plus-circle";
                                                        } else {
                                                            $icon = "fas fa-edit";
                                                        }
                                                        break;
                                                    }
                                                case 1: {
                                                        $icon = "fas fa-edit";
                                                        break;
                                                    }
                                                case 2: {
                                                        $icon = "fas fa-clipboard";
                                                        break;
                                                    }
                                                case 3: {
                                                        $icon = "fas fa-shipping-fast";
                                                        break;
                                                    }
                                                case 4: {
                                                        $icon = "fas fa-clipboard-check";
                                                        break;
                                                    }
                                                case 5: {
                                                        $icon = "fas fa-check-square";
                                                        break;
                                                    }
                                                case 6: {
                                                        $icon = "fas fa-times-circle";
                                                        break;
                                                    }
                                                case 7: {
                                                        $icon = "fas fa-window-close";
                                                        break;
                                                    }
                                                case 8: {
                                                        $icon = "fas fa-dolly";
                                                        break;
                                                    }
                                                case 9: {
                                                        $icon = "fas fa-warehouse";
                                                        break;
                                                    }
                                            }

                                            $current_duedate = $this->request_history->get_entry([
                                                'request_id' => $ritem_id,
                                                'type' => $rh_type,
                                                'inquiry' => 'rproc_duedate',
                                                'timestamp' => $notif['n_created']
                                            ]);
                                            $msg_line2 = "due ".$current_duedate;
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                            ?>
                            <li class='container-fluid'>
                                <a href='<?= $href ?>'
                                   class='row <?= $unread_status ?>'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="<?= $icon ?>"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong><?= $ticker_line1 ?></strong>
                                                <?php
                                                if (!empty($ticker_line2) || !empty($ticker_line3)) {
                                                ?>
                                                <br />
                                                <small><?= $ticker_line2 ?></small><br />
                                                <small><?= $ticker_line3 ?></small>
                                                <?php
                                                }
                                                ?>
                                            </span>
                                            <?php
                                            if (!empty($msg_line1) || !empty($msg_line2)) {
                                            ?>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
                                                    <span><?= $msg_line1 ?></span><br />
                                                    <span><?= $msg_line2 ?></span>
                                                </small>
                                            </span>
                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        if (empty($my_notifs)) {
                            ?>
                            <li class="text-left">
                                <a>
                                    <span class="h5 navbar-head-and-actions">
                                        Nothing new today.
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="text-right">
                            <!-- TODO Add link here -->
                            <a href="#">
                                <span class="h5 navbar-head-and-actions">
                                    <span class="fas fa-angle-right"></span>
                                    See all notifications
                                </span>
                            </a>
                        </li>
                    </ul>
                </span>

                <span>
                    <a class="btn btn-link navbar-toggle" data-toggle="dropdown">
                        <span class="fas fa-comments"></span>
                        <span>
    <?php
    $my_msgs = $this->message->get_msgs([
        'm_id' => $this->session->m_id
    ]);
    $my_unread_msgs = count($this->message->get_msgs([
                'm_id' => $this->session->m_id,
                'msg_read' => 0
    ]));
    if (!empty($my_unread_msgs)) {
        echo $my_unread_msgs;
    }
    ?>
                        </span>
                        <span class="hidden-sm hidden-xs">&nbsp;Messages</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notify-panel">
    <?php
    foreach ($my_msgs as $msg) {
        $unread_status = "";
        $icon = "fas fa-envelope-open";
        if ($msg['msg_read'] == 0) {
            $unread_status = "notify-unread";
            $icon = "fas fa-envelope";
        }
        $sender_name = $this->member->get_name([
            'm_id' => $msg['msg_sender'],
            'pref' => 'fl'
        ]);
        $sm_body = $this->message->cut_body([
            'msg_body' => $msg['msg_body']
        ]);
        ?>
                            <li class='container-fluid'>
                                <a href='#' class='row <?= $unread_status ?>'>
                                    <span class='col-xs-1'>
                                        <span class='notify-mold'>
                                            <span class="h5">
                                                <span class="<?= $icon ?>"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <span class='col-xs-10'>
                                        <span class="notify-mold">
                                            <span class="h5">
                                                <strong><?= $msg['msg_subject'] ?></strong>
                                                <br />
                                                <small>from <?= $sender_name ?></small>
                                            </span>
                                            <span class='a-line'></span>
                                            <span class='h5'>
                                                <small>
        <?= $sm_body ?>
                                                </small>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
        <?php
    }
    if (empty($my_msgs)) {
        ?>
                            <li class="text-left">
                                <a>
                                    <span class="h5 navbar-head-and-actions">
                                        Nothing new today.
                                    </span>
                                </a>
                            </li>
        <?php
    }
    ?>
                        <li class="text-right">
                            <!-- TODO Add link here -->
                            <a href="#">
                                <span class="h5 navbar-head-and-actions">
                                    <span class="fas fa-angle-right"></span>
                                    See all messages
                                </span>
                            </a>
                        </li>
                    </ul>
                </span>
            </div>
    <?php
} else {
    ?>
            <div class="navbar-header">
                <span>
                    <a class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown">
                        WebKape
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li <?php if ($page_title == 'Home') { ?>class="active"<?php } ?>>
                            <a href="<?= site_url('home') ?>">Home</a>
                        </li>
                        <li <?php if ($page_title == 'Browse') { ?>class="active"<?php } ?>>
                            <a href="<?= site_url('browse') ?>">Browse</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li <?php if ($page_title == 'Log in') { ?>class="active"<?php } ?>>
                            <a href="<?= site_url('login') ?>">Log in</a>
                        </li>
                        <li <?php if ($page_title == 'Sign up') { ?>class="active"<?php } ?>>
                            <a href="<?= site_url('signup') ?>">Sign up</a>
                        </li>
                    </ul>
                </span>
            </div>
    <?php
}
?>
    </div>

</nav>
        <?php unset($logged_in); ?>

<?php if (!empty($system_notify)) { ?>
<div class="flying-container">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1
                 alert alert-dismissible alert-<?= $system_notify_context ?>">
                <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div><?= $system_notify ?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
