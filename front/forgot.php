<div>請輸入信箱以查詢密碼</div>
<input type="text" name="email" id="email">
<div id="result"></div>
<button onclick="forgot()">尋找</button>

<script>
    function forgot(){
        $.get("./api/forgot.php",{email:$('#email').val()},(res)=>{
            $('#result').html(res)
        })
    }
</script>