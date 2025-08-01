<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<style>
    .movie{
        width: 95%;
        display:flex;
        align-items: center;
        margin:auto;
        box-shadow:0 0 3px #999;
        height:100px
    }

    .movie > div:nth-child(1){
        width: 15%;
    }

    .movie > div:nth-child(2){
        width: 15%;
    }

     .movie > div:nth-child(3){
        width: 80%;
    }

    .movie > div:nth-child(3) > div:nth-child(1){
        display:flex;
        justify-content: space-around;
    }

    .movie > div:nth-child(3) > div:nth-child(2){
        display:flex;
        justify-content: end;
    }
</style>
<?php
$movies=$Movies->all(" order by `rank`");
foreach($movies as $idx => $movie):
    $prev=($idx-1>=0)?$movies[$idx-1]['id']:$movie['id'];
    $next=($idx+1<count($movies))?$movies[$idx+1]['id']:$movie['id'];
?>
<div class="movie">
    <div><img src="./images/<?=$movie['poster'];?>" alt="" style="width=60px;height:80px"></div>
    <div>分級: <img src="./icon/03C0<?=$movie['level'];?>.png" alt=""></div>
    <div>
        <div>
            <div>片名:<?=$movie['name'];?></div>
            <div>片長:<?=$movie['length'];?></div>
            <div>上映時間:<?=$movie['ondate'];?></div>
        </div>
        <div>
            <button class="show-btn" data-id="<?=$movie['id'];?>"><?=($movie['sh']==1)?"顯示":"隱藏";?></button>
            <button class="sw-btn"  data-sw="<?=$prev;?>"  data-id="<?=$movie['id'];?>">往上</button>
            <button class="sw-btn"  data-sw="<?=$next;?>"  data-id="<?=$movie['id'];?>">往下</button>
            <button onclick="location.href='?do=edit_movie&id=<?=$movie['id'];?>'">編輯電影</button>
            <button class="del-btn" data-id="<?=$movie['id'];?>">刪除電影</button>
        </div>
        <div>
            劇情介紹: <?=$movie['intro'];?>
        </div>
    </div>
</div>
<hr>
<?php endforeach;?>

<script>
    $('.show-btn').on("click",function(){
        
        let id=$(this).data('id');
        console.log(id);
        
        $.post("api/show_movie.php",{id},()=>{
            
            switch ($(this).text()) {
                case '顯示':
                    $(this).text("隱藏")
                    break;
                case '隱藏':
                    $(this).text("顯示")
                    break;
            
                default:
                    break;
            }
        })
    })

     $('.sw-btn').on("click",function(){
        let id=$(this).data('id');
        let sw=$(this).data('sw');
        $.post("./api/sw.php",{table:'Movies',id,sw},(res)=>{
            location.reload();
        })
    })

    $('.del-btn').on("click",function(){
        let id=$(this).data('id');
        console.log(id);
        
        if(confirm("確定要刪除這部電影嗎?")){
            $.post("./api/del.php",{table:'Movies',id},()=>{
                location.reload();
            })
        }
    })
</script>