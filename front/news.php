<style>
    .full{
        display: none;
    }
    .news-title{
        cursor:pointer;
        background-color: lightgray;
    }
</style>

<fieldset>
    <legend>目前位置: 首頁 > 最新文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
        </tr>
        <?php
        $all = $News->count(['sh' => 1]);
        $div = 5;
        $pages = ceil($all / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " limit $start,$div");
        foreach ($rows as $row) {

        ?>
            <tr>
                <td class="news-title"><?= $row['title']; ?></td>
                <td>
                    <div class="short"><?= mb_substr($row['text'], 0, 20); ?>...</div>
                    <div class="full"><?=nl2br($row['text']);?></div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <?php
        if (($now - 1) > 0) {
            $pre = $now - 1;
            echo "<a href='index.php?do=pop&p=$pre'> < </a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            $size = ($i == $now) ? '24px' : '16px';
            echo "<a href='index.php?do=pop&p=$i' style='font-size:$size'> $i </a>";
        }

        if (($now + 1 <= $pages)) {
            $next = $now + 1;
            echo "<a href='index.php?do=pop&p=$next'> > </a>";
        }
        ?>
    </div>
</fieldset>

<script>
    //next() 取得同⼀層級符合條件的下⼀個元素
    //siblings() 從 DOM Tree 同層的元素尋找所有符合的 selector但不包含⾃⼰本⾝
    //children() 從指定的位置開始只往「下⼀層」找到符合的 selector
    // 我本來的寫法是用三個td, 分別放news-title跟short跟full 因此用下面的寫法
    // $('.news-title').on("click", function(){
    //     $(this).siblings('.short,.full').toggle();
    // })

        $('.news-title').on("click", function(){
            //73跟74行, 當我點標題的時候, 所有short都顯示, 所有full都隱藏.等於回復原來的樣子.
            // $('.short').show();
            // $('.full').hide();
            $('.short').show();
            $('.full').hide();
            $(this).next().children('.short,.full').toggle();
        })
</script>

