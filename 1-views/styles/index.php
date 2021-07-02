<style>
    /*
    320px — 480px: Mobile devices
    481px — 768px: iPads, Tablets
    769px — 1024px: Small screens, laptops
    1025px — 1200px: Desktops, large screens
    1201px and more —  Extra large screens, TV
    */

    .main{
        text-align: center;
        border: solid .5px #ccc;
        padding: 10px
    }

    .hr{
        width: 70%;
    }

    @media only screen and (max-width: 480px) and (min-width: 320px)  {
        .hr {
            margin-left: 30px;
        }
    }

    @media only screen and (max-width: 768px) and (min-width: 481px)  {
        .hr {
            margin-left: 30px;
        }
    }

    @media only screen and (max-width: 1024px) and (min-width: 769px)  {
        .hr {
            margin-left: 30px;
        }
    }

    @media only screen and (max-width: 1900px) and (min-width: 1025px)  {
        .hr {
            margin-left: 100px;
        }
    }

    @media only screen and (max-width: 500px) and (min-width: 1201px)  {
        .hr {
            margin-left: 30px;
        }
    }



</style>