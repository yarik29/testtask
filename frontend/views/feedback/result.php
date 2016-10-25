<div class="feed-res">
    <h3>Спасибо, данные успешно отправлены</h3>
    <p><span style="font-weight: bold"><?=$feed->full_name;?></span>, мы ждем Вас <span style="font-weight: bold"><?=date('d-m-Y', strtotime($feed->input_date))?></span></p>
    <?php if($feed->file): ?>
        <a href="http://<?=$_SERVER['SERVER_NAME'].'/uploads/'.$feed->file;?>">Прикреплённый файл</a>
    <?php endif;?>
</div>

