<div style="height:320px">
<h3 class="ct" style="margin:0;">預告片清單</h3>
</div>
<hr>
<div style="height:160px">
<h3 class="ct" style="margin:0;">新增預告片海報</h3>
<form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
    <table style="margin:auto;">
        <tr>
            <td>預告片海報:</td>
            <td><input type="file" name="img" id="img"></td>
            <td>預告片片名:</td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>
</div>