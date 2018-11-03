<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css">

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

<style>

:root {
  --navbar-font-size:3vw;
}
.navbarMedia {
    background-color: dark-grey;
}
.navbar-brandMedia {
    font-size: var(--navbar-font-size);
    font-weight: bold;
    line-height: 200%;
}
.navbar-navMedia {
    font-size: var(--navbar-font-size);
}
form.form-searchinline button {
    font-size: var(--navbar-font-size);
    margin-top: calc(var(--navbar-font-size) / 2 );
    float: left;
    background: transparent;
    color: white;
    border: 0;
    cursor: pointer;
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Desktops
  ##Screen = 1281px to higher resolution desktops
*/
@media (min-width: 1281px) {
    body {background-color: blue;}
    :root {
    }
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Laptops, Desktops
  ##Screen = B/w 1025px to 1280px
*/
@media (min-width: 1025px) and (max-width: 1280px) {
    body {background-color: white;}
    :root {
    }
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Tablets, Ipads (portrait)
  ##Screen = B/w 768px to 1024px
*/
@media (min-width: 768px) and (max-width: 1024px) {
    body {background-color: red;}
    :root {
    }
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Tablets, Ipads (landscape)
  ##Screen = B/w 768px to 1024px
*/
@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
    body {background-color: green;}
    :root {
    }
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Low Resolution Tablets, Mobiles (Landscape)
  ##Screen = B/w 481px to 767px
*/
@media (min-width: 481px) and (max-width: 767px) {
    body {background-color: yellow;}
    :root {
    }
}

/* -------------------------------------------------------------------------------- media check --*/
/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/
@media (min-width: 320px) and (max-width: 480px) {
    body {background-color: black;}
    :root {
    }
}

</style>

<body>
            <!--Navbar -->
            <nav class="navbar navbar-expand-sm navbar-dark navbarMedia">
                <a class="navbar-brand navbar-brandMedia" href="#">HOME</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText1" aria-controls="navbarText1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText1">
                    <ul class="navbar-nav mr-auto navbar-navMedia">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">News <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">World</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">Country</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">Country2</a>
                        </li>
                    </ul>
                    <form class="form-searchinline">
                        <button type="submit"><i class="fa fa-search btSearch"></i></button>
                    </form>
                </div>
            </nav>
            <!--/.Navbar -->
     
 <script>
    if (window.matchMedia("(min-width: 1025px)").matches) {
      /* La largeur minimum de l'affichage est 1025 px inclus */
      console.log('1025');
    } else {
      /* L'affichage est inférieur à 600px de large */
    }
</script>

</body>
