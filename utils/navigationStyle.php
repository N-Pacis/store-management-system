<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    nav {
        background-color: rgb(12, 12, 12);
        display: flex;
        flex-wrap: wrap;
        height: 40px;
        position: sticky;
        top:0;
        width: 100%;
    }

    nav>h2 {
        float: left;
        text-transform: uppercase;
        padding: 0.2% 1% !important;
        text-align:left!important;
        width: 20%;
        color: #fff;
        font-size: 25px;
    }

    nav>ul {
        display: flex;
        padding: 0.5% 3%;
        width: 55%;
        flex-wrap:wrap;
    }
    #check{
        display:none;
    }
    nav>label{
        float:right;
        color:#fff;
        width:5%;
        margin-left: 10%;
        margin-right: 10%;
        font-size:26px;
        padding:0.4% 0%;
        cursor:pointer;
        display:none
    }
    .nav-item {
        margin: 0% 3.5%;
        list-style-type: none;
    }

    .nav-item>a {
        color: #fff;
        text-decoration: none;
    }

    .nav-item>a.active,a:hover{
        font-weight:bold;
    }
    .display-username{
         color: #fff !important;
        width: 20%;
        display: flex;
        margin-left: 5%;
        padding-left: 10%;
    }
    .display-username>a:first-child{
        text-decoration: none;
    }
    .display-username>a>h2{
        font-size: 22px;
    }
    .display-username>a:last-child{
        margin-top: 2%;
        margin-left: 15%;
    }
    .display-username>a>i{
        font-size: 25px;
        color: dodgerblue;
        cursor: pointer;
    }
    .display-username>a>h2:first-letter{
        text-transform: capitalize;
    }
   
</style>
</head>
<body>
    
</body>
</html>