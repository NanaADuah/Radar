<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center"> 
    <?php if(isset($crumbs)):?>
        <?php foreach($crumbs as $crumb):?>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="<?=$crumb[1]?>"><?=ucfirst($crumb[0])?></a></li>
        <?php endforeach;?>
    <?php endif;?>
    </ol>
</nav>