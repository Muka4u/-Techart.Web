<nav class="nav">

    <?php if($page > 1) {?>

        <a href="/mysite/index.php?page=<?=$page-1;?>">&larr;</a>
        <?php } ?>

    <?php for($i = 1; $i<=$totalPages; $i++) { ?>    
        <a <?=($i == $page) ? 'class="current"' : '';?> 
             href="/mysite/index.php?page=<?=$i;?>"><?=$i;?></a>
        
        <?php } ?>

        <?php if($page < $totalPages) { ?>
        <a href="/mysite/index.php?page=<?=$page+1;?>">&rarr;</a>
 
        <?php } ?>

</nav>