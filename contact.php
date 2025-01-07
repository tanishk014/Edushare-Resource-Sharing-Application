
 <!DOCTYPE html>
 <html lang="en">
 <head>

<style>
*
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;

}

body{

    min-height: 100vh;
    width: 100%;
    background: #c8e8e9;
    display: flex;
    align-items: center;
    justify-content: center;

}

.container
{

width: 80%;
background: #fff;
border-radius: 6px;
padding: 30px 60px 40px 40px ;
box-shadow: 0 5px 10px rgba(0,0,0,0.2);

}

.container .content
{
    display: flex;
    align-items: center;
    justify-content: space-between;
}


.container .content .left-side
{

    width: 25%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top:15px ;
    position: relative;

}

.container .content .left-side::before
{

content: '';
position: absolute;
height: 70%;
width: 2px;
right: -15px;
top: 50%;
transform: translateY(-50%);
background: #afafb6;

}


.content .left-side .details
{
    margin-left: 14px;
    text-align: center;

}

.content .left-side .details i
{
font-size: 30px;
color: #3e2093;
margin-bottom: 10px;
}

.content .left-side .details .topic
{
    font-size: 18px;
    font-weight: 500;
}

.content .left-side .details .text-one,
.content .left-side .details .text-two
{
font-size: 14px;
color: #afafb6;

}

.container .content .right-side
{
    width: 75%;
    margin-left: 75px;

}


 .content .right-side .topic-text
{
font-size: 23px;
font-weight: 600;
color: #3e2093;
}

.right-side  .input-box
{
    height: 50px;
    width: 100%;
    margin: 12px 0;
}
.right-side  .input-box input,
.right-side  .input-box textarea
{
    height: 100%;
    width: 100%;
    border: none;
    font-size: 16px;
     background: #f0f1f8;
    border-radius: 6px;
    padding: 0 15px;
    resize: none;
}

.right-side .message-box
{

    min-height: 110px;
    margin-top: 6px;

}
.right-side .button {
    display: inline-block;
    margin-top: 6px;
}

.right-side .button  [type="button"]
{
    color: #fff;
    font-size: 18px;
    outline: none;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    background: #3e2093;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button  [type="button"]:hover
{
    background:#5029bc ;
}


@media  (max-width:950px) 
{
    .container{
        width: 90%;
       
        padding: 30px 35px 40px 35px;
    }
}

@media  (max-width:820px) 
{
    .container{
        margin: 40px 0;
       height: 100%;
    }

    .container.content
    {
        flex-direction: column-reverse;
    }

    .container.content .left-side
    {
     width: 100%;
     flex-direction: row;
     margin-top: 40px;
     justify-content: center;
     flex-wrap: wrap;
    }

    .container.content .left-side::before
    {

        display: none;
    }

    .container.content .right-side
    {
        width: 100%;
        margin-left: 0;
    }
}



</style>

 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
 </head>

 
 <body>

    <div class="container">
        <div class="content">
            <div  class="left-side" >

                 <div class="address details">
                 <i class="fas fa-map-marker-alt"></i>
                    <div class="topic">Address</div>
                    <div class="text-one">Satara</div>
                    <div class="text-two">maharashtra</div>
                </div>


                 <div class="phone details">
                 <i class="fas fa-phone-alt"></i>
                 <div class="topic">Phone</div>
                  <div class="text-one">+91 00000 00000</div>
                  <div class="text-two">+91 00001 00001 </div>
                 </div>

                 
                 <div class="email details">
                 <i class="fas fa-envelope"></i>
                 <div class="topic">Email</div>
                  <div class="text-one">srms@gmail.com </div>
                  <div class="text-two"> info.srms@gmail.com</div>
                 </div>
                 </div>


<div class="right-side"> 
<div class="topic-text">Send us a message</div>
<p>If you have any queries about our system you can send a message and we will respond you as soon as possible!</p>


<form action="#">

<div class="input-box">
    <input type="text" name="" placeholder="Enter Your Name">
</div>

<div class="input-box">
    <input type="text" name="" placeholder="Enter Your email">
</div>

<div class="input-box message-box">
    <textarea></textarea  >
</div>

<div class="button">
    <input type="button" value="Send Now">
</div>


</form>

</div>


               </div>
            </div>
        </div>
   </div>



 </body>
 </html>