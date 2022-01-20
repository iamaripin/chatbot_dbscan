<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('styles/detail.css?v=1.2') ?>"/>
<link rel="stylesheet" href="<?php echo base_url('styles/rating.css?v=1.1') ?>"/>
<link rel="stylesheet" href="<?php echo base_url('styles/blog.css?v=1.1') ?>"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('styles/datatables.css') ?>"/>
<link rel="stylesheet" href="<?php echo base_url('styles/chat.css') ?>"/>

<title><?php echo SITE_NAME .": ". ucfirst($this->uri->segment(1)) ." - ". ucfirst($this->uri->segment(2)) ?></title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');
body{
    font-family: 'Work Sans', sans-serif;
}
.card{
  background-color: #ededed;
}

.imgcard{
    width: 100%;
    height: 18vmax;
    object-fit: contain;
}
.card{
    border: none;
}

.table-condensed{
  font-size: 12px;
}

.ms-n5 {
    margin-left: -40px;
}
.headmenu {
    display: none;
}

@media only screen and (min-width: 800px) {
  .kanankiri {
    margin-left:80px;
    margin-right:80px;
  }
  
  .formlogin {
    background:#fff;
    border-radius:5px;
    border: 1px solid #d0d0d0;
    padding: 3vmax;
  }
}

@media only screen and (max-width: 600px) {
  .cartgd{
      display:none;
  }
  .pads{
      padding: 0;
  }
}
@media only screen and (max-width: 1000px) {
  .headmenu {
      display: block;
  }
  .headmenus {
      display: none;
  }
}

.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 99000;
  top: 0;
  left: 0;
  background-color: rgb(255,255,255);
  background-color: rgba(255,255,255, 1);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 5px;
  width: 90%;
  left:20px;
  margin-top: 20px;
}

.overlay a {
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  transition: 0.3s;
  color:black;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  left: 5px;
  font-size: 35px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }

}

.formlogin {
  background:#fff;
}

.batas {
   width: 100%; 
   text-align: center; 
   border-bottom: 1px solid #d0d0d0; 
   line-height: 0.1em;
   margin: 10px 0 20px; 
} 

.batas span { 
    background:#fff; 
    padding:0 10px; 
}

</style>

</head>
<body>