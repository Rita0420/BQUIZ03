<h3 class="ct">線上訂票</h3>
<style>
    #orderForm{
        width:60%;
        margin:10px auto;
        padding:20px;
        border:1px solid #ccc;
        background:#aaa;
    }

    #orderForm td{
        background: #ccc;
    }

    #orderForm td:nth-child(1){
        width: 20%;
        text-align:right;
    }

    #orderForm td:nth-child(2) select{
        width: 98%;
        text-align:left;
    }
</style>
<table id="orderForm">
    <tr>
        <td>電影 :</td>
        <td>
            <select name="movie" id="movie">

            </select>
        </td>
    </tr>
    <tr>
        <td>日期 :</td>
        <td>
            <select name="date" id="date">

            </select>
        </td>
    </tr>
    <tr>
        <td>場次 :</td>
        <td>
            <select name="session" id="session">

            </select>
        </td>
    </tr>
</table>

<div class="ct">
    <button>確定</button>
    <button>重置</button>
</div>

<script>
    let url=new URLSearchParams(location.search);
    getMovies();

    $('#movie').on("change",function(){
        getDays($(this).val());
    })

    $('#date').on("change",function(){
        getSessions($('#movie').val(),$(this).val())
    })
    function getMovies(){
        let id=0;

        if(url.has('id')){
            id=url.get('id');
        }

        $.get("./api/get_movies.php",{id},(movies)=>{
            $('#movie').html(movies);
            getDays($('#movie').val());
        })
    }

    function getDays(movieId){
        $.get("./api/get_dates.php",{movieId},(dates)=>{
            $('#date').html(dates);
            getSessions(movieId,$('#date').val());
        })
    }

    function getSessions(movieId,date){
        $.get("./api/get_session.php",{movieId,date},(sessions)=>{
            $('#session').html(sessions);
        })
    }
</script>