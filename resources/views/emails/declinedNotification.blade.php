
@component('mail::message')
<style>
    .center {
            margin: auto;
            width: 100%;
            text-align: center;
            text-align: center;
            color: gray;
        }
    hr{
        border-top: .1em solid whitesmoke;
    }
</style>

<div class="center">
    <img src="https://lh3.googleusercontent.com/wnITvGiEa9fc92wVxal1rmHJWKkTjOP7_2SweUcVY201W-4fbh_RI_qPOQi-fUlWO5myZWd6ifJTZsUjbVqerK8=w16383" alt="logo" width="100"/>
    <br>
    <br>
    <strong style="font-size: 22px; text-transform: uppercase;">{{ $content['notif_message'] }}</strong>
    <br>
    <br>
        <strong style="font-size: 18px;">{{ $content['note'] }}</strong>
    <br>
    <br>
   
    
</div>



 

@endcomponent
