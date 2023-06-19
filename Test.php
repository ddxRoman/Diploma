

<script>
$(".content-block").each(function() {
    let more = $(this).find(".show-more");
    let hide = $(this).find(".hide-content");
    hide.hide();
    more.click(function() {
        hide.slideToggle();
        more.text(more.text() == "Скрыть" ? "Показать еще" : "Скрыть");
    });
});</script>
<div class="content-block">
    <p>Видимый текст</p> 
    <button class="show-more">Показать еще</button>    
    <p class="hide-content">Скрытый текст</p>
    <p class="hide-content">Скрытый текст</p>
</div>    

<div class="content-block">
	<p>Видимый текст</p> 
	<p class="hide-content">Скрытый текст</p>
	<p class="hide-content">Скрытый текст</p>
	<button class="show-more">Показать еще</button>	
</div>	

<div class="content-block">
    <p>Видимый текст</p> 
    <p class="hide-content">Скрытый текст</p>
    <p class="hide-content">Скрытый текст</p>
    <button class="show-more">Показать еще</button>    
</div>    


<p>Видимый текст</p> 
<button class="show-more">Показать еще</button>    
<p class="hide-content">Скрытый текст</p>

<style>

.show-more,
.show-all {
    display: inline-flex;
    margin: 10px;
    text-decoration: none;
    position: relative;
    font-size: 20px;
    line-height: 20px;
    padding: 12px 30px;
    color: #FFF;
    font-weight: bold;
    text-transform: uppercase; 
    font-family: 'Roboto', Тahoma, sans-serif;
    background: #337AB7;
    cursor: pointer; 
    border: 2px solid #BFE2FF;
    overflow: hidden;
    z-index: 1;
}
.show-more:hover,
.show-more:active,
.show-more:focus,
.show-all:hover,
.show-all:active,
.show-all:focus{
    color: #FFF;
}
.show-more:before,
.show-all:before {
    content: '';
    position: absolute;
    top: 0;
    right: -50px;
    bottom: 0;
    left: 0;
    border-right: 50px solid transparent;
    border-top: 50px solid #2D6B9F;
    transition: transform 0.5s;
    transform: translateX(-100%);
    z-index: -1;
}
.show-more:hover:before,
.show-more:active:before,
.show-more:focus:before,
.show-all:hover:before,
.show-all:active:before,
.show-all:focus:before{
    transform: translateX(0);
}
</style>