<style>
    .list-col{
        display:flex;
        justify-content:space-between;
        margin-top:5px;
    }

    .list-col div{
        width: calc( 98% / 7);
        background:#ccc;
    }
    .list-data{
        display:flex;
        justify-content:space-between;
        margin-top:5px;
        align-items:center;
    }

    .list-data div{
        width: calc( 98% / 7);
    }

    #items{
        overflow:auto;
        height:340px;
    }
</style>
<h3 class="ct">訂單管理</h3>
<div class="quick-del">
    快速刪除:
    <input type="radio" name="type" id="date" value="date" checked>依日期
    <input type="text" name="date">
    
    <input type="radio" name="type" id="movie" value="movie">依電影
    <select name="movie" id="">
        <?php
        $movies=q("select `movie` from `orders` group by `movie`");
        foreach($movies as $movie){
            echo "<option value='{$movie['movie']}'>{$movie['movie']}</option>";
        }
        ?>
    </select>

    <div class="list-col ct">
        <div>訂單編號</div>
        <div>電影名稱</div>
        <div>日期</div>
        <div>場次時間</div>
        <div>訂購數量</div>
        <div>訂購位置</div>
        <div>操作</div>
    </div>
    <div id="items">
        <?php
        $orders=$Orders->all(" order by `no` desc");
        foreach($orders as $order):
        ?>
        <div class="list-data ct">
            <div><?=$order['no'];?></div>
            <div><?=$order['movie'];?></div>
            <div><?=$order['date'];?></div>
            <div><?=$order['session'];?></div>
            <div><?=$order['tickets'];?></div>
            <div><?php
            $seats=unserialize($order['seats']);
            sort($seats);
            foreach($seats as $seat){
                
                echo floor($seat/5)+1 ."排".($seat%5)+1 ."號<br>";
               
            }
            
            
            ?></div>
            <div><button class="btn-del" data-id="<?=$order['id'];?>">刪除</button></div>
        </div>
        <hr>
        <?php endforeach;?>
    </div>

</div>

<script>
    $('.btn-del').on("click",function(){
        let id=$(this).data('id');
        console.log(id);
        
        if(confirm("確定要刪除這筆訂單嗎?")){
            $.post("./api/del.php",{table:'Orders',id},()=>{
                location.reload();
            })
        }
    })

    $(".quick-del").on("click",function(){
        let type=$("input[name='type']:checked").val();
        let data='';
        switch(type){
            case 'date':
                data=$("#date").val();
            break;
            case 'movie':
                data=$("#movie").val();
            break;
        }

        if(confirm(`確定要刪除${data}的所有訂單嗎?`)){
            $.post("./api/qDel.php",{type,date},(res){

            })
        }
    })
</script>