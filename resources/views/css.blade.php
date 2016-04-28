<style>
  html,body {
    height: 100%;
  }

  body {
    margin: 0;
    padding: 0;
    width: 100%;
    display: table;
    font-family: 'Lato';
    overflow: hidden;
  }

  body {
    background: #fb503b;
  }

  body,a {
    color: #fff;
  }

  .container {
    text-align: center;
  }

  .content {
    text-align: center;
    display: inline-block;
  }

  h1 {
    font-size: 86px;
    font-weight: 400;
    margin: 0;
    cursor: pointer;
  }

  .pretitle {
    margin: 15px 0 0;
    font-size: 24px;
  }

  .spam{
    font-size: 8px;
    margin-top: 10px;
  }

  .log {
    background: rgba(255,255,255,.95);
    border-radius: 6px;
    color: #000;
    position: absolute;
    top: 260px;
    width: 60%;
    left: 20%;
    height: calc(100% - 252px);
    overflow: hidden;
  }

  .log .details {
    overflow: auto;
    height: 98.5%;
    width: 100%;
    text-align: left;
  }

  .small {
    font-size: 10px;
  }

  .details .header {
    margin: 20px;
  }

  .details ul {
    list-style: none;
    margin: 0;
    padding: 0 20px;
    margin-bottom: 80px;
  }

  .details ul > li {
    border-bottom: 1px solid #999;
    clear: both;
    padding: 18px 0 10px 0;
    font-size: 15px
  }

  .details ul > li:first-of-type{
    padding-top: 0;
  }

  .details ul > li a {
    color: #000;
  }

  h3 {
    font-size: 26px;
    display: inline;
  }

  ::-webkit-scrollbar {
    width: 12px;
  }

  ::-webkit-scrollbar-track {
    border-top-right-radius: 6px;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,0.5);
  }

  .social {
    padding: 10px;
    font-size: 24px;
    background: rgba(255,255,255,.1);
    border-radius: 6px;
    color:#fff;
    width: 360px;
    margin: 0 auto;
  }

  .social a{
    padding: 0 14px;
  }

  .details .fa-external-link {
    font-size: 10px;
    line-height: 20px;
  }

  input {
    width: calc(100% - 20px);
    border: 0;
    font-size: 16px;
    margin: 10px 10px 0;
    padding: 6px;
    background-color: transparent;
    outline: none;
    text-align: right;
    float:right;
    width: 50%;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background: rgba(255,255,255,.9);
    width: 160px;
    max-height: 260px;
    overflow:hidden;
    margin-left: 53.33px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 6px;
  }

  .dropdown:hover .dropdown-content,.dropdown:active .dropdown-content,.dropdown:focus .dropdown-content {
    display: block;
  }

  .dropdown-content ul {
    list-style: none;
    padding: 0;
    margin:0;
    max-height: 260px;
    overflow: auto;
  }

  .dropdown-content ul > li {
    padding-bottom: 20px;
  }

  .dropdown-content ul > li a {
    color: #000;
    font-size: 32px;
    text-decoration: none;
  }

  img{
     width: 32px;
     height:32px
  }

  .log ul > li div:first-of-type{
    width: 80%;
    float:left;
  }

  .log ul > li div:last-of-type{
    width: 18%;
    float:right;
    text-align:right;
  }


  .clearfix:after {
       visibility: hidden;
       display: block;
       font-size: 0;
       content: " ";
       clear: both;
       height: 0;
       }
  .clearfix { display: inline-block; }

  * html .clearfix { height: 1%; }
  .clearfix { display: block; }

  .authors{
    padding-top: 10px;
    overflow: hidden;
    overflow-x:scroll;
    height: 60px;
    white-space:nowrap;
    text-align:center;
  }

  h1 img{
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-top:-10px;
  }
  .featured{
    position: absolute;
    right: 20px;
    top: 20px;
    background: rgba(255,255,255,.9);
    color: #000;
    padding: 10px 20px 10px 20px;
    border-radius: 6px;
    text-align: center;
  }

  .featured:hover{
    text-decoration: none;
  }

  .featured img{
    border-radius: 50%;
    height: 74px;
    width: 74px;
    float: left;
    margin-right: 20px;

  }

  .featured strong{
    font-size: 16px;
    line-height: 28px;
  }

  .featured a{
    color: #000;
  }
  .featured p{
    padding-top: 4px;
  }

  @media only screen and (max-width: 480px) {
    .log {
        top: 140px;
        width: 80%;
        left: 10%;
        height: calc(100% - 132px);
    }

    h1 {
        font-size: 46px;
    }

    .versions {
        margin-top: 0;
    }

    .social {
        display: none;
    }

    .dropdown-content {
      width: 160px;
      position: absolute;
      top: 50px;
      left: calc(50% - 130px);
      max-height: 260px;
      overflow:hidden;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 6px;
    }
  }
  @media only screen and (max-width: 780px) {
    .featured{
      display:none
    }
  }

</style>