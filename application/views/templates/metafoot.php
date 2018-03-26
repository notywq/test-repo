<script src="<?= site_url('js/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= site_url('js/bootstrap.min.js') ?>"></script>

<?php if (isset($sidebar) && $sidebar == TRUE) { ?>
    <script src="<?= site_url('js/jquery.nicescroll.min.js') ?>"></script>
    <script src="<?= site_url('js/custom/collapsiblesidebar.js') ?>"></script>
<?php } ?>
    
<?php if (isset($addressselect) && $addressselect == TRUE) { // Assumes that data is already prepared ?>
    <script>
        $(document).ready(function () {
            $("#province").change(function (){
                var province=$(this).val();
                $('#city').html('<option value="">Select a city...</option>');
                switch (province) {
                <?php
                $provinces=$this->address->get_province();
                foreach ($provinces as $prov) {
                ?>
                    case "<?= $prov['a_province'] ?>": {
                            <?php
                            $cities=$this->address->get_city(['province'=>$prov['a_province']]);
                            foreach ($cities as $city) {
                            ?>
                                $('#city').append('<option value="<?= $city['ac_id'] ?>"><?= $city['a_city'] ?></option>');
                            <?php
                            }
                            unset($cities);
                            ?>
                            break;
                    }
                <?php
                }
                ?>
                }
            });
        });
    </script>
<?php } ?>

<?php if (isset($datetimepicker) && $datetimepicker == TRUE) { ?>
    <script type="text/javascript" src="<?= site_url('js/bootstrap-datetimepicker.min.js') ?>" charset="UTF-8"></script>
    <script type="text/javascript" src="<?= site_url('js/specific/datetimepicker-dateonly.js') ?>" charset="UTF-8"></script>
<?php } ?>

<?php if (isset($packoptions) && $packoptions == TRUE) { ?>
    <script>
        $(document).ready(function(){
            $('div.js-checkbox-and-co input[type="checkbox"]').change(function(){
                var target_row = $(this).parents('div.js-checkbox-and-co')
                            .children('div.checkbox')
                if ($(this).prop('checked')) {
                    target_row.addClass('col-sm-6').removeClass('col-sm-12')
                            .end()
                            .children('div.js-checkbox-partner')
                            .removeClass('hidden')
                            .children('div.input-group')
                            .children('input[type="text"]').removeAttr('disabled');;
                }
                else {
                    target_row.addClass('col-sm-12').removeClass('col-sm-6')
                            .end()
                            .children('div.js-checkbox-partner')
                            .addClass('hidden')
                            .children('div.input-group')
                            .children('input[type="text"]').attr('disabled',true);
                }
            });
        });
    </script>
<?php } ?>

</body>
