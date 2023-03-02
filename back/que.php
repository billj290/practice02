<fieldset>
    <legend>新增問券</legend>
    <form action="./api/add_que.php" method="post">
        <div class="subject">
            問卷名稱
            <input type="text" name="subject">
        </div>
        <div class="options">
            <label>選項</label>
            <input type="text" name="option[]">
        </div>
        <input type="submit" value="新增">
        <input type="reset" value="清空">
        <input type="button" value="更多" onclick="moreOpt()">
    </form>
</fieldset>


<script>
    function moreOpt(){
        let opt=`
        <div class="option">
            <label>選項</label>
            <input type="text" name="option[]">
        </div>`;
        $('.options').append(opt);
    }
</script>
