<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Flexbox Card Grid</title>

<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="../css/jquery-ui.css">
<style>
*,
*::before,
*::after {
  box-sizing: border-box;
}
html {
  background-color: #f0f0f0;
}
body {
  color: #999999;
  font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0;
  padding: 1rem;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -moz-font-feature-settings: "liga" on;
}
img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}
.btn {
  background-color: white;
  border: 1px solid #cccccc;
  color: #696969;
  padding: 0.5rem;
  text-transform: lowercase;
}
.btn--block {
  display: block;
  width: 100%;
}

.cards {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  list-style: none;
  margin: 0;
  padding: 0;
}
.LI-cards__item {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  padding: 1rem;
  max-width:25%;
  /*background-color: orange;*/
}


.LI-cards__item--row {
  padding: 1rem;
  /*width: 100%;*/
display: -webkit-flex;
display:flex;

  width:100%;
  background-color:orange;

}

.column {
  flex-basis: 100%;
  padding:0;
}

@media (min-width: 40rem) {
  .LI-cards__item {
    width: 50%;
  }
}
@media (min-width: 56rem) {
  .LI-cards__item {
    /*width: 33.3333%;*/
	width: 25%;
  }
}
.card {
  background-color: white;
  border-radius: 0.25rem;
  box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  overflow: hidden;

}
.card:hover .card__image {
  -webkit-filter: contrast(100%);
          filter: contrast(100%);
}
.card__content {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  padding: 1rem;
  background-color: yellow;
}

.card__content--row {
    -webkit-flex: 1;
    flex:1;

}

.card__row {
    display: -webkit-flex;
    display:flex;
    border-bottom: #ccc solid 1px;
}
.div__cardImage--row {
    width:25vh;

}
.card__image_row {
  /*width:25%;
  height:25%;*/
  background-color:black;
}

.card__image {
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
  -webkit-filter: contrast(70%);
          filter: contrast(70%);
  overflow: hidden;
  position: relative;
  -webkit-transition: -webkit-filter 0.5s cubic-bezier(0.43, 0.41, 0.22, 0.91);
  transition: -webkit-filter 0.5s cubic-bezier(0.43, 0.41, 0.22, 0.91);
  transition: filter 0.5s cubic-bezier(0.43, 0.41, 0.22, 0.91);
  transition: filter 0.5s cubic-bezier(0.43, 0.41, 0.22, 0.91), -webkit-filter 0.5s cubic-bezier(0.43, 0.41, 0.22, 0.91);

}
.card__image::before {
  content: "";
  display: block;
  padding-top: 56.25%;
}
@media (min-width: 40rem) {
  .card__image::before {
    padding-top: 66.6%;
  }
}
.card__image--flowers {
    background-image: url(https://unsplash.it/800/600?image=82);
}
.card__image--river {
    background-image: url(https://unsplash.it/800/600?image=11);
}
.card__image--record {
    background-image: url(https://unsplash.it/800/600?image=39);
}
.card__image--fence {
    background-image: url(https://unsplash.it/800/600?image=59);
}
.card__title {
    color: #696969;
    font-size: 1.25rem;
    font-weight: 300;
    letter-spacing: 2px;
    text-transform: uppercase;
}
.card__text {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 1.25rem;
}

.card__li--hide{
      display:none;
}

.containerMenuAssets {
      display: flex;
      display: -webkit-flex;
      align-items: center;
      -webkit-align-items: center;
      justify-content: center;
      -webkit-justify-content: center;
      height: 5vh;
      width: 100%;
      background-color: red;
}

.btn_menu_assets {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      height: 5vh;
      width: 100%;

      > .fa {
        font-size: 1.5rem;
      }
}

.container_cards{
      width:100%;
      /*padding-right:5px;
      padding-left:5px;*/
      background-color: blue;
      padding: 0;
}

.search__div {
      position: relative;
      color: #aaa;
      font-size: 16px;
      height:100%;
}
.search__div input {
      min-width: 150px;
      height:100%;
      background: #fcfcfc;
      border: 1px solid #aaa;
      border-radius: 5px;
      box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb inset;
}

.search__div input { text-indent: 32px;}

.search__div .fa-search {
    position: absolute;
    top: 10px;
    left: 10px;
}

.title-case {
    width:100%;
    /*height:1%;*/
    background-color:black;
    color:white;
    font-size:0.8em;
}

</style>


</head>

<body>

<div class="containerMenuAssets">

    <button id="bt_img" class="btn_menu_assets secondary"><i class="fa fa-picture-o"></i></button>
    <button id="bt_grid_list" class="btn_menu_assets secondary"><i class="fa fa-align-justify"></i></button>
    <button id="bt_sort" class="btn_menu_assets secondary"><i class="fa fa-sort-alpha-asc"></i></button>
    <button id="bt_date" class="btn_menu_assets secondary"><i class="fa fa-calendar"></i></button>
    <!-- <button id="bt_filters" class="btn_menu_assets secondary">filters</button> -->


<select class="f-select" style="min-width:150px;height:100%;">
    <option disabled selected>Filters</option>
    <option >Blue</option>
    <option >Red</option>
    <option >Yellow</option>
    <option >Green</option>
  </select>

<select class="b-select" style="min-width:150px;height:100%;">
    <option disabled selected>Sort By</option>
    <option data-sort="price:asc">Price Ascending</option>
    <option data-sort="price:desc">Price Descending</option>
    <option data-sort="length:asc">Length Ascending</option>
    <option data-sort="length:desc">Length Descending</option>
    <option data-sort="case:asc">Case Ascending</option>
    <option data-sort="case:desc">Case Descending</option>
  </select>

<div class="search__div">
  <span class="fa fa-search"></span>
  <input placeholder="search" id="input__searchAssets" type="text"/>
</div>



</div>

<div class="container_cards">

<ul id="cards" class="cards">
  <li class="LI-cards__item fiche" data-length="100" data-price="16" data-case="0001" >
    <div class="card fiche_card">
            <div class="div__cardImage">
                  <img class="card__image card__image--fence image_fiche" src="https://unsplash.it/800/600?image=82"></img>
                  <div class="title-case">Case 0001</div>
            </div>


              <div class="card__content">
                <div class="card__title">yellow</div>
                        <div class="details">
                          <span class="length">100M</span>
                          <span class="price">16€</span>
                        </div>
                <p class="card__text">This is the shorthand for fe second and third parameters (flex-shrink and flex-basis) are optional. Default is 0 1 auto. </p>
                <button class="btn btn--block card__btn" style"width:25%;max-width:25%;">Button</button>
              </div>

    </div>
  </li>
  <li class="LI-cards__item fiche" data-length="3" data-price="50"  data-case="0010">
    <div class="card fiche_card">
        <div class="div__cardImage">
            <img class="card__image card__image--fence image_fiche" src="https://unsplash.it/800/600?image=11"></img>
            <div class="title-case">Case 0010</div>
        </div>

      <div class="card__content">
        <div class="card__title">GREEN</div>
                <div class="details">
                  <span class="length">3M</span>
                  <span class="price">50€</span>
                </div>
        <p class="card__text">This defines the ability for a flex item to grow if necessary. It accepts a unitless value that serves as a proportion. It dictates what amount of the available space inside the flex container the item should take up.</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
  <li class="LI-cards__item fiche" data-length="123" data-price="70"  data-case="0005">
    <div class="card fiche_card">
        <div class="div__cardImage">
            <img class="card__image card__image--fence image_fiche" src="https://unsplash.it/800/600?image=39"></img>
            <div class="title-case">Case 0005</div>
        </div>
      <div class="card__content">
        <div class="card__title">BLUE</div>
                <div class="details">
                  <span class="length">123M</span>
                  <span class="price">70€</span>
                </div>
        <p class="card__text">This defines the ability for a flex item to shrink if necessary. Negative numbers are invalid.</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
  <li class="LI-cards__item fiche" data-length="130" data-price="6700" data-case="0120">
    <div class="card fiche_card">
        <div class="div__cardImage">
            <img class="card__image card__image--fence image_fiche" src="https://unsplash.it/800/600?image=59"></img>
            <div class="title-case">Case 0120</div>
        </div>
      <div class="card__content">
        <div class="card__title">RED</div>
                <div class="details">
                  <span class="length">130M</span>
                  <span class="price">6700€</span>
                </div>
        <p class="card__text">This defines the default size of an element before the remaining space is distributed. It can be a length (e.g. 20%, 5rem, etc.) or a keyword. The auto keyword means "look at my width or height property."</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
</ul>

</div>

<script>



$( document ).ready(function() {

    // $('#bt_grid_list').trigger('click');

    document.getElementById("input__searchAssets").value = "";

    function input__searchAssets(valThis){
        if(valThis == ""){
            $('.cards > li').show();
        } else {
            $('.cards > li').each(function(){
                var text = $(this).text().toLowerCase();
                (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();
            });
       };
    }

    $('#input__searchAssets').keyup(function(){
       var valThis = $(this).val().toLowerCase();
       input__searchAssets(valThis);
    });

    $( "#bt_sort" ).click(function(e) {
        $(this).find('.fa').toggleClass('fa-sort-alpha-asc fa-sort-alpha-desc');
        e.stopPropagation();
        e.preventDefault();
    });

    $( "#bt_date" ).click(function(e) {
        $(this).find('.fa').toggleClass('fa-calendar fa-calendar-times-o');
        e.stopPropagation();
        e.preventDefault();
    });

    $.btgl = {};
    $.btgl.switch = 2;
    $( "#bt_grid_list" ).click(function(e) {
        $(this).find('.fa').toggleClass('fa-th fa-align-justify');
    		        if ($.btgl.switch === 1) {

                        $('.fiche_card').removeClass('card__row');
                        $('.fiche').removeClass('column');
                        $('.div__cardImage').removeClass('card__image_row');
                        $('.image_fiche').removeClass('div__cardImage--row');
                        $('.card__content').removeClass('card__content--row');

                        $('.fiche').addClass('LI-cards__item');
                        $('.fiche_card').addClass('card');

                        $("#bt_img").prop("disabled",false);

                        $.btgl.switch = 2;
    	            }
                    else {

                        $('.fiche').removeClass('LI-cards__item');
                        $('.fiche_card').removeClass('card');

                        $('.fiche_card').addClass('card__row');
                        $('.fiche').addClass('column');
                        $('.div__cardImage').addClass('card__image_row');
                        $('.image_fiche').addClass('div__cardImage--row');
                        $('.card__content').addClass('card__content--row');

                        $("#bt_img").prop("disabled",true);

    		            $.btgl.switch = 1;
    		        }
        e.stopPropagation();
        e.preventDefault();
    });

    $.btimg = {};
    $.btimg.switch = 2;
    $( "#bt_img" ).click(function(e) {
        $(this).find('.fa').toggleClass('fa-th fa-align-justify');
    		        if ($.btimg.switch === 1) {
                        $('.card__content').show();
                        $.btimg.switch = 2;
    	            }
                    else {
                        $('.card__content').hide();
    		            $.btimg.switch = 1;
    		        }
        e.stopPropagation();
        e.preventDefault();
    });


  $( function() {
    var availableTagsSearchAssets = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Length",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "up"
    ];
    $( "#input__searchAssets" ).autocomplete({
      source: availableTagsSearchAssets
    });
  } );

    $('#input__searchAssets').on('autocompleteselect', function (e, ui) {
        var optionSelected = ui.item.value;
        input__searchAssets(optionSelected.toLowerCase());
    });

    // $('#input__searchAssets').on('keydown', function(e) {
    //     if( !/[a-z]|[A-Z]/.test( String.fromCharCode( e.which ) ) )
    //         return false;
    // });

    $('#input__searchAssets').on('dblclick focusin', function() {
    //$('#input__searchAssets').on('click focusin', function() {
        this.value = '';
        input__searchAssets('');
    });

});

// https://www.sitepoint.com/user-sortable-lists-flexbox-jquery/
// https://codepen.io/SitePoint/pen/jyJwXO
(function($) {
  "use strict";

  $.fn.numericFlexboxSorting = function(options) {
    const settings = $.extend({
      elToSort: ".cards li"
    }, options);

    const $select = this;
    const ascOrder = (a, b) => a - b;
    const descOrder = (a, b) => b - a;

    $select.on("change", () => {
      const selectedOption = $select.find("option:selected").attr("data-sort");
      sortColumns(settings.elToSort, selectedOption);
    });

    function sortColumns(el, opt) {
      const attr = "data-" + opt.split(":")[0];
      const sortMethod = (opt.includes("asc")) ? ascOrder : descOrder;
      const sign = (opt.includes("asc")) ? "" : "-";

      const sortArray = $(el).map((i, el) => $(el).attr(attr)).sort(sortMethod);

      for (let i = 0; i < sortArray.length; i++) {
        $(el).filter(`[${attr}="${sortArray[i]}"]`).css("order", sign + sortArray[i]);
      }
    }

    return $select;
  };
})(jQuery);

// call the plugin
$(".b-select").numericFlexboxSorting();





</script>



</body>
</html>
