<style>
    .full{
        display: none;
        position: absolute;
        z-index: 99;
        background-color: lightgreen;
        top: 5px;
        left: -10px;
        width: 95% ;
        height: 500px;
        overflow: auto;
        padding: 1rem;
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
            <td>人氣</td>
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
                <td style="position:relative">
                    <div class="short"><?= mb_substr($row['text'], 0, 20); ?>...</div>

                    <div class="full">
                        <?php
                            echo "<div style='color:red'>".$row['type']."</div>";
                            echo "<div style='color:black'>".$row['text']."</div>";
                        ?>
                    </div>
                </td>
                <td>
                    <span class="num"><?=$Log->count(['news'=>$row['id']]);?></span>
                    個人說
                    <img src="./icon/02B03.JPG" style="width:20px;height:20px">
                    <?php
                        if(isset($_SESSION['login'])){
                            if($Log->count(['user'=>$_SESSION['login'],'news'=>$row['id']])>0){
                                echo "<a href='#' class='goods' data-user='{$_SESSION['login']}' data-news='{$row['id']}'>";
                                echo "收回讚";
                                echo "</a>";
                            }else{
                                echo "<a href='#' class='goods' data-user='{$_SESSION['login']}'  data-news='{$row['id']}'>";
                                echo "讚";
                                echo "</a>";
                            }
                        }
                    ?>
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
    $('.news-title').hover(
        function (){
            $(this).next().children('.full').show();
        },
        function (){
            $(this).next().children('.full').hide();
        }
    )

    $('.full').hover(
        function(){
            $(this).show();
        },
        function(){
            $(this).hide()
        }
    )

</script>

