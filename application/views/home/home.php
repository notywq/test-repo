<style>
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

        margin-bottom: 0;
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
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color:#D9230F;
    }

    .search-query:focus + button {
        z-index: 3;   
    }

    #container2 {
        width: 100%;
        text-align:center;
        margin-top:50px;
    }

    #container2 div {
        float: left;
        height: 400px;
        width: 20%;
    }

    .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    .product_view .modal-dialog{max-width: 800px; width: 100%;}
    .pre-cost{text-decoration: line-through; color: #a5a5a5;}
    .space-ten{padding: 10px 0;}
</style>

<div id="content" style="text-align:center;margin-left:auto;margin-right:auto;">
    <?php if (!empty($system_notify)) { ?>
    <div class="flying-container">
        <div class="container">
            <div class="row">
                <div class="alert alert-dismissible alert-<?= $system_notify_context ?>">
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

    <img class="img-responsive center-block" src="<?= site_url('public/webkape_logo.png') ?>">
	<form method="post" action="browse">
		<div class="container" >
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
	
	


    <!--
    <div style="margin-top:100px;">
    <h1> ON SALE! </h1>
    </div>

    <br>
    
    <div >
            <ul class="pagination">
                    <li class="disabled"><a href="#">«</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">»</a></li>
            </ul>
    </div>
    -->
</div>