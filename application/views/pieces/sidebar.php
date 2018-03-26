<!--Sidebar-->
<!-- TODO work on dead links -->
<nav id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h3><?= $page_title ?></h3>
    </div>
    <!-- Sidebar Links -->
    <ul class="list-unstyled components">
        <li <?php if ($parent_page_title == "Dashboard") { ?>class="active"<?php } ?>><a href=<?= site_url('dashboard') ?>>Dashboard</a></li>
        <li <?php if ($parent_page_title == "Orders") { ?>class="active"<?php } ?>><a href=<?= site_url('orders') ?>>Orders</a></li>
        <li <?php if ($parent_page_title == "My store") { ?>class="active"<?php } ?>><a href=<?= site_url('mystore') ?>>My store</a></li>
    </ul>
    <ul class="list-unstyled ext-components">
        <li <?php if ($parent_page_title == "Home") { ?>class="active"<?php } ?>><a href=<?= site_url('home') ?>>WebKape home</a></li>
        <li <?php if ($parent_page_title == "Browse") { ?>class="active"<?php } ?>><a href=<?= site_url('browse') ?>>Browse</a></li>
    </ul>
</nav>
