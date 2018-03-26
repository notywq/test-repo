<?php
$label_size = "col-md-4 col-sm-3";
$input_size = "col-md-4 col-sm-6";
$uri_for_this = 'profile';
if (!$is_you) {
    $their_uname = $this->user->get_theirUName(['m_id'=>$member['m_id']]);
    $uri_for_this .= '/'.$their_uname;
}
?>
<style>
    .tab-pane {
        padding-top: 2%;
    }
    .head-and-actions {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }
</style>
<div id="content">
    <div class="container-fluid">
        <h1><?= $this->member->get_name(['m_id' => $member['m_id']]) ?></h1>
        <p>
            <?php
            if ($is_you) {
                echo "Your profile";
            } else {
                echo "Member profile";
            }
            ?>
        </p>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 form-horizontal">
                    <?php
                    if (!empty($profile_error)) {
                        form_pieces::create_alert([
                            'context'=>'warning',
                            'label'=>'Could not edit profile.',
                            'text'=>$profile_error,
                        ]);
                    }
                    if (!empty(validation_errors())) {
                        form_pieces::create_alert([
                            'label'=>'Could not edit profile.',
                            'text'=>validation_errors(),
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#profile" data-toggle="tab">Contact information</a></li>
            <li><a href="#certifications" data-toggle="tab">Certifications</a></li>
        </ul>
        <div id="myTabContent" class="tab-content container">
            <div class="tab-pane active" id="profile">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="<?= $label_size ?> control-label h4">
                                    <small>Mobile number</small>
                                </label>
                                <div class="<?= $input_size ?>">
                                    <div class='form-control-static h4'>
                                        <?php
                                        if (!empty($member['m_cellno'])) {
                                            echo $member['m_cellno'];
                                        }
                                        else {
                                            echo "Not set";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="<?= $label_size ?> control-label h4">
                                    <small>Telephone number</small>
                                </label>
                                <div class="<?= $input_size ?>">
                                    <div class='form-control-static h4'>
                                        <?php
                                        if (!empty($member['m_telno'])) {
                                            echo $member['m_telno'];
                                        }
                                        else {
                                            echo "Not set";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="<?= $label_size ?> control-label h4">
                                    <small>E-mail address</small>
                                </label>
                                <div class="<?= $input_size ?>">
                                    <div class='form-control-static h4'>
                                        <?php
                                        if (!empty($member['m_email'])) {
                                            echo $member['m_email'];
                                        }
                                        else {
                                            echo "Not set";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="<?= $label_size ?> control-label h4">
                                    <small>Office address</small>
                                </label>
                                <div class="<?= $input_size ?>">
                                    <div class='form-control-static h4'>
                                        <?php
                                        if (!empty($member['m_office'])) {
                                            $their_province = $this->address->get_string([
                                                'a_id'=>$member['m_office'],
                                                'pref'=>'p'
                                            ]);
                                            $their_city = $this->address->get_string([
                                                'a_id'=>$member['m_office'],
                                                'pref'=>'c'
                                            ]);
                                            $their_address = $this->address->get_string([
                                                'a_id'=>$member['m_office'],
                                                'pref'=>'a'
                                            ]);
                                            ?>
                                        <p><?= $their_address ?></p>
                                        <p><?= $their_city ?>, <?= $their_province ?></p>
                                            <?php
                                        }
                                        else {
                                            echo "Not set";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="certifications">
                <div class="row">
                    <div class="col-xs-6 head-and-actions">
                        <p class="h4">
                            <span>___ certificates</span>
                            <!--TODO Display number of certificates here-->
                        </p>
                    </div><!-- Needed to
                    prevent line breaks --><div class="col-xs-6 head-and-actions">
                        <p class="h3 text-right">
                            <?php if ($is_you) { ?>
                            <a href="#certificateModal" data-toggle="modal" data-target="#certModal" class="btn text-primary">
                                <span class="fas fa-plus-circle"></span>
                                &nbsp;Add certificate
                            </a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <!--TODO convert this thumbnail into loops going through the cert_list-->
                    <div class="col-md-3 col-sm-4">
                        <div class="thumbnail">
                            <a href="<?= site_url('private/certs/tell-you.png') ?>" target="_blank">
                                <img src="private/certs/tell-you.png" alt="Slag" height="200" width="200" />
                            </a>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <span class="h4">
                                            <strong>
                                            Another wonderful template
                                            </strong>
                                        </span>
                                    </div>
                                    <div class="col-xs-12">
                                        Another wonderful template description
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $mid = $member['m_id'];

                    $name = null;
                    $allowed = array("png", "gif", "jpeg", "jpg");

                    foreach ($allowed as $ext) {
                        $i = 0;
                        while (file_exists(site_url()."upload/" . $mid . "_" . $i . "." . $ext)) {

                            $name = $mid . "_" . $i . "." . $ext;
                            ?>
                            <a href='<?= site_url() ?>upload/<?= $name ?>' target='_blank'>
                                <img style="margin-bottom:10px;"src="upload/<?= $name ?>" alt="Certificate" height="200" width="200"/>
                            </a>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="certModal" tabindex="-1" role="dialog" aria-labelledby="UploadCertificate" aria-hidden="true">
                    <?= form_open_multipart(site_url($uri_for_this), 'class="form-horizontal"') ?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Upload Certificate</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cert_name">Certificate name*</label>  
                                        <div class="col-sm-6">
                                            <input id="cert_name" name="cert_name" type="text" placeholder="" class="form-control input-md" value="<?= set_value('cert_name') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cert_desc">Description</label>
                                        <div class="col-sm-6">
                                            <textarea id="cert_desc" name="cert_desc" type="text" placeholder="" class="form-control input-md"><?= set_value('cert_desc')
                                            ?></textarea>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cert_image">Image*</label>
                                        <div class="col-sm-6">
                                            <input id="cert_image" class="form-control-static" type="file" name="cert_image" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Supported files</label>
                                        <div class="col-sm-6">
                                            <div class="form-control-static">
                                                <span class="label label-info">png</span>
                                                <span class="label label-info">jpg/jpeg</span>
                                                <span class="label label-info">gif</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <p class="text-left">
                                        <strong>Note: </strong><br />
                                        You may upload all your valid certifications.
                                    </p>
                                    <p class="text-danger">Again, all fields with * here are <em>required.</em></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="mycertify">
                                        Upload certificate
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?= form_close() ?>
                </div>

            </div>
        </div>
    </div>
</div>
