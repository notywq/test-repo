<style>
    .no-line:hover, .no-line *:hover {
        text-decoration: none;
    }
    
    #custom-search-input {
        margin:0;
        margin-top: 10px;
        padding: 0;
    }

    #custom-search-input .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */

        margin-bottom: 50px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        font-size: 25px;
        height: 45px;
    }

    #custom-search-input button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 50px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color:#D9230F;
    }

    .search-query:focus + button {
        z-index: 3;
    }

    .product_view .modal-dialog{max-width: 800px; width: 100%;}
    .pre-cost{text-decoration: line-through; color: #a5a5a5;}
</style>

<script>

//Disable Everything Initially
document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("bean1").disabled = true;
	//Add more things that should be disabled at FIRST.
});

//Handle the Beans Checkbox
function toggleBeans() {
    if(document.getElementById("isbeans").checked == true)
	{
		document.getElementById("bean1").disabled = false;
	}
	else
	{
		document.getElementById("bean1").disabled = true;
	}
}

</script>

<div id="content">


	<form method="post" action="browse">
		<div class="container" style="margin-top: 100px">
			<div class="row">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
					<span class="input-group-btn">
						<input type="text" class="  search-query form-control" name="search" id="search" placeholder="Search..." value=""/>
						
						<input type="submit" class="btn btn-default" id="searchSubmit" name="searchSubmit" value="Search">
					
						</span>
					</div>
				</div>
			</div>
		</div>
	</form>
	
<div class="parent-container" style="display:flex;">
<div class="container" style="width:200px;">
<form method="post" action="browse">
	<h3>Advanced Search</h3>
    <div class="form-group">
      <label for="price">Price Range</label>
		<div class="money">
		&#8369;<input type="text" name="pricerangelow" class="numberOnly" autocomplete="off" />
		</div>
		to
		<div class="money">
			&#8369;<input type="text" name="pricerangehigh" class="numberOnly" autocomplete="off" />
		</div>
    </div>
	<!--
    <div class="form-group">
		<label for="location">Location</label>
		<div class="checkbox">
		<label><input type="checkbox" value="">Option 1</label>
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" value="">Option 2</label>
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" value="">Option 3</label>
		</div>
    </div>
	-->
	<?php
	$provinces = $this->address->get_province();
	?>
	<div class="form-group">
            <label for="location">Location</label>
                <select id="location" name="location" class="form-control">
                    <option value="Any">Any</option>
                    <?php foreach ($provinces as $prov) { ?>
                        <option
                            value="<?= $prov['a_province'] ?>"><?= $prov['a_province'] ?></option>
                    <?php } ?>
                </select>
       </div>
	
	
	<div class="form-group">
		<label for="seller">Seller</label>
		<input type="text" name="seller" id="seller">
    </div>
	
	<div class="form-group">
		<label for="serviceType">Product/Service</label>
		<div class="checkbox">
		<label><input type="checkbox" name="isbeans" onclick="toggleBeans(this)" id="isbeans" value="bean">Beans</label>
		</div>
			<label>Type of Beans</label>
			<div class="checkbox">
			<label><input type="checkbox" id="bean1" name="bean_list[]" value="Arabica">Arabica</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_list[]" value="Robusta">Robusta</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_list[]" value="Liberica">Liberica</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_list[]" value="Excelsa">Excelsa</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_list[]" value="Mixed">Mixed</label>
			</div>
			
			<label>Type of Roast</label>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_roast[]" value="Light">Light</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_roast[]" value="Medium">Medium</label>
			</div>
			<div class="checkbox">
			<label><input type="checkbox" name="bean_roast[]" value="Dark">Dark</label>
			</div>
			
			<label>Minimum Quantity</label>
			<input type="text" name="beanmin" id="beanmin">
		<div class="checkbox">
		  <label><input type="checkbox" name="ispkg" value="Packages">Packages</label>
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="isroast" value="Roasters">Roasters</label>
		</div>
			<label>Capacity</label>
			<input type="text" name="capacity" id="capacity">
		<div class="checkbox">
		  <label><input type="checkbox" name="isproc" value="Processors">Processors</label>
		</div>
			<label>Minimum Quantity</label>
			<input type="text" name="pcapacity" id="pcapacity">
    </div>
	
	<div class="form-group">
            <label for="sort">Sort By...</label>
                <select style="padding-left:2px;padding-right:2px;font-size:8pt;width:180px" id="sort" name="sort" class="form-control">
                    <option value="1">Date Posted (Newest to Oldest)</option>
					<option value="2">Date Posted (Oldest to Newest)</option>
					<option value="3">Price (Lowest to Highest)</option>
					<option value="4">Price (Highest to Lowest)</option>
					<option value="5">Alphabetical (A to Z)</option>
					<option value="6">Alphabetical (Z to A)</option>
                </select>
    </div>
	
	<div class="form-group">
	<input type="submit" class="btn btn-default" id="advsearchSubmit" name="advsearchSubmit" value="Search">
	</div>
	</form>
	</div>

    <div class="container" style="display:inline;">
    <div class='container-fluid'>
        <span class="h2">All products</span>
        <br />
        <div class="container">
            <p class="h4"><?= count($beans_list) ?> beans</p>
            <div class="row">
            <?php
            foreach ($beans_list as $beans) {
                $beans_species = $this->beans->get_thatSpeciesString([
                    'b_id' => $beans['b_id']
                ]);
                $beans_species_short = $this->message->cut_body([
                    'msg_body'=>$beans_species,
                    'length'=>25,
                ]);
                ?>
                <div class="col-md-3 col-sm-4">
                    <div class="thumbnail">
                        <img src="<?= base_url('public/beans.png') ?>"
                            alt="<?= $beans['b_roast'] ?> roast <?= $beans_species ?> coffee"
                            class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <span class="h4">
                                        <?= $beans_species_short ?>
                                    </span>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <?php
                                    $link_roast = preg_replace('/\s+/', '_', $beans['b_roast']);
                                    $link_species = preg_replace('/\s+/', '_', $beans_species);
                                    $link_id = preg_replace('/\s+/', '_', $beans['b_id']);
                                    $beans_link = html_escape($link_roast.
                                            "+".$link_species.
                                            "+".$link_id);
                                    ?>
                                    <a href="<?= site_url('browse/beans/'.$beans_link) ?>" class="btn btn-primary btn-sm" type="submit">
                                        <span class="fas fa-shopping-cart"></span>
                                        &nbsp;<?= $beans['b_unitprice'] ?>
                                    </a>
                                    <br />
                                    <a href="<?= site_url('browse/beans/'.$beans_link) ?>"
                                       class="text-primary btn-xs no-line" type="button">
                                        PHP / kg
                                    </a>
                                </div>
                                <div class="col-xs-12">
                                    <span class="h4"><small><?= $beans['b_roast'] ?> roast</small></span><br />
                                    <p class="small">Sold by
                                        
                                        <a href="#"
                                           target="_blank">
                                            <?php
                                            $has_store = $this->store->track(['b_id'=>$beans['b_id']]);
                                            echo $has_store['s_name'];
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <p class="h4"><?= count($pack_list) ?> packages</p>
            <div class="row">
            <?php
            foreach ($pack_list as $pack) {
                $simple_capacity = round($pack['pk_capacity']);
                ?>
                <div class="col-md-3 col-sm-4">
                    <div class="thumbnail">
                        <img src="<?= base_url('public/pack.png') ?>"
                            alt="<?= $pack['pk_color'] ?> roast <?= $pack['pk_type'] ?> pack"
                            class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <span class="h4">
                                        <?= $simple_capacity ?>g
                                        <?= $pack['pk_type'] ?>
                                    </span>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <?php
                                    $link_color = preg_replace('/\s+/', '_', $pack['pk_color']);
                                    $link_type = preg_replace('/\s+/', '_', $pack['pk_type']);
                                    $link_id = preg_replace('/\s+/', '_', $pack['pk_id']);
                                    $pack_link = html_escape($link_color.
                                            "+".$link_type.
                                            "+".$link_id);
                                    ?>
                                    <a href="<?= site_url('browse/pack/'.$pack_link) ?>" class="btn btn-primary btn-sm" type="submit">
                                        <span class="fas fa-shopping-cart"></span>
                                        &nbsp;<?= $pack['pk_unitprice'] ?>
                                    </a>
                                    <br />
                                    <a href="<?= site_url('browse/pack/'.$pack_link) ?>"
                                       class="text-primary btn-xs no-line" type="button">
                                        PHP / <?= $pack['pk_qtyperunit'] ?> pcs
                                    </a>
                                </div>
                                <div class="col-xs-12">
                                    <span class="h4"><small><?= $pack['pk_material'] ?></small></span><br />
                                    <p class="small">Sold by
                                        
                                        <a href="#"
                                           target="_blank">
                                            <?php
                                            $has_store = $this->store->track(['pk_id'=>$pack['pk_id']]);
                                            echo $has_store['s_name'];
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
    <div class='container-fluid'>
        <span class="h2">All services</span>
        <br />
        <div class="container">
            <p class="h4"><?= count($roast_list) ?> roasters</p>
            <div class="row">
            <?php
            foreach ($roast_list as $roast) {
                $address_string = $this->address->get_string([
                    'a_id'=>$roast['ro_address'],
                    'pref'=>'c,p'
                ]);
                $address_shortString = $this->address->get_string([
                    'a_id'=>$roast['ro_address'],
                    'pref'=>'c'
                ]);
                $roast_support = $this->roast->get_roastSupportString([
                    'ro_id'=>$roast['ro_id']
                ]);
                $roast_support_short = $this->message->cut_body([
                    'msg_body'=>$roast_support,
                    'length'=>25,
                ]);
                ?>
                <div class="col-md-3 col-sm-4">
                    <div class="thumbnail">
                        <img src="<?= base_url('public/roast.png') ?>"
                            alt="<?= $roast_support ?> roasts"
                            class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <span class="h4">
                                        <?= $roast_support_short ?>
                                    </span>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <?php
                                    $roast_support_url = str_replace(',', '', $roast_support);
                                    $link_roasts = preg_replace('/\s+/', '_', $roast_support_url);
                                    $link_address = preg_replace('/\s+/', '_', $address_shortString);
                                    $link_id = preg_replace('/\s+/', '_', $roast['ro_id']);
                                    $roast_link = html_escape($link_roasts.
                                            "+".$link_address.
                                            "+".$link_id);
                                    ?>
                                    <a href="<?= site_url('browse/roast/'.$roast_link) ?>" class="btn btn-primary btn-sm" type="submit">
                                        <span class="fas fa-shopping-cart"></span>
                                        &nbsp;<?= $roast['ro_unitprice'] ?>
                                    </a>
                                    <br />
                                    <a href="<?= site_url('browse/roast/'.$roast_link) ?>"
                                       class="text-primary btn-xs no-line" type="button">
                                        PHP / kg
                                    </a>
                                </div>
                                <div class="col-xs-12">
                                    <span class="h4"><small><?= $address_string ?></small></span><br />
                                    <p class="small">Sold by
                                        <a href="#"
                                           target="_blank">
                                            <?php
                                            $has_store = $this->store->track(['ro_id'=>$roast['ro_id']]);
                                            echo $has_store['s_name'];
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <p class="h4"><?= count($proc_list) ?> processors</p>
            <div class="row">
            <?php
            foreach ($proc_list as $proc) {
                $address_string = $this->address->get_string([
                    'a_id'=>$proc['proc_address'],
                    'pref'=>'c,p'
                ]);
                $address_shortString = $this->address->get_string([
                    'a_id'=>$proc['proc_address'],
                    'pref'=>'c'
                ]);
                ?>
                <div class="col-md-3 col-sm-4">
                    <div class="thumbnail">
                        <img src="<?= base_url('public/proc.png') ?>"
                            alt="<?= $proc['proc_activity'] ?> processes"
                            class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <span class="h4">
                                        <?= $proc['proc_activity'] ?><br />
                                    </span>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <?php
                                    $link_activity = preg_replace('/\s+/', '_', $proc['proc_activity']);
                                    $link_address = preg_replace('/\s+/', '_', $address_shortString);
                                    $link_id = preg_replace('/\s+/', '_', $proc['proc_id']);
                                    $proc_link = html_escape($link_activity.
                                            "+".$link_address.
                                            "+".$link_id);
                                    ?>
                                    <a href="<?= site_url('browse/proc/'.$proc_link) ?>" class="btn btn-primary btn-sm" type="submit">
                                        <span class="fas fa-shopping-cart"></span>
                                        &nbsp;<?= $proc['proc_unitprice'] ?>
                                    </a>
                                    <br />
                                    <a href="<?= site_url('browse/proc/'.$proc_link) ?>"
                                       class="text-primary btn-xs no-line" type="button">
                                        PHP / kg
                                    </a>
                                </div>
                                <div class="col-xs-12">
                                    <span class="h4"><small><?= $address_string ?></small></span><br />
                                    <p class="small">Sold by
                                        <a href="#"
                                           target="_blank">
                                            <?php
                                            $has_store = $this->store->track(['proc_id'=>$proc['proc_id']]);
                                            echo $has_store['s_name'];
                                            ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
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
	</div>
    <!--TODO Add modals for given buttons (ambitious)-->
</div>
