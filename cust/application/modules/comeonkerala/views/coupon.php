<center>
     <section class="inner_pages">
          <div class="container">
               <div class="row" style="padding:0px 0px 20px 0px" id="html-content-holder">
                    <div class="col-sm-5">
                         <div class="cardWrap">
                              <div class="card cardLeft">
                                   <h1 style="color:#fff;margin-bottom: 0px;">RD LUCKY DRAW</h1>
                                   <div class="title">
                                        <h2>Your name</h2>
                                        <span class="spnSubText"><?php echo isset($eeld_name) ? $eeld_name : ''; ?></span>
                                   </div>
                                   <div class="seat">
                                        <h2>Your lucky number</h2>
                                        <span class="spnSubText"><?php echo isset($eeld_ref_no) ? $eeld_ref_no : ''; ?></span>
                                   </div>
                              </div>
                              <div class="card cardRight">
                                   <div class="number">
                                        <img style="margin-top: 65px;" src="images/logo-royal-drive.svg"/>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-sm-4" style="margin-top: 15px;float: left;">
                    <div class="form-group">
                         <button class="btn btn-primary" id="btnSubmit">Download your ticket</button>
                         
                    </div>
               </div>
               <div class="col-sm-4" style="margin-top: 15px;float: left;">
                    <div class="form-group">
                         <a href="https://www.royaldrive.in" target="blank" class="btn btn-link">Visit Royal Drive Luxury</a>
                         <a href="https://www.rdsmart.in" target="blank" class="btn btn-link">Visit Royal Drive Smart</a>
                    </div>
               </div>
          </div>
     </section>
</center>
<div id="previewImg"></div>
<style>
     .btn-link:hover {
          color: #ffcb05;
          background-color: #343434;
          text-decoration: none;
     }
     .btn-link {
          text-decoration: none;
          display: inline-block;
          padding: 10px;
          font-family: LatoBold;
          margin-bottom: 0;
          font-size: 12px;
          line-height: 1.42857143;
          text-align: center;
          white-space: nowrap;
          vertical-align: middle;
          cursor: pointer;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          background-image: none;
          background-color: #ffcb05;
          color: #000;
     }
     .spnSubText {
          font-size: .7em;
          color: #717373;
     }
     h1:after{
          background:none;
     }
     h2 {
          margin: 0px;
          font-size: 13px;
     }

     .cardWrap {
          width: 100%;
     }
     .card {
          background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
          height: 11em;
          float: left;
          position: relative;
          padding: 1em;
          /*margin-top: 100px;*/
     }

     .cardLeft {
          border-top-left-radius: 8px;
          border-bottom-left-radius: 8px;
          width: 16em;
     }

     .cardRight {
          width: 6.5em;
          border-left: .18em dashed #fff;
          border-top-right-radius: 8px;
          border-bottom-right-radius: 8px;
          &:before,
               &:after {
               content: "";
               position: absolute;
               display: block;
               width: .9em;
               height: .9em;
               background: #fff;
               border-radius: 50%;
               left: -.5em;
          }
          &:before {
               top: -.4em;
          }
          &:after {
               bottom: -.4em;
          }
     }

     h1 {
          font-size: 1.1em;
          margin-top: 0;
          span {
               font-weight: normal;
          }
     }

     .title, .name, .seat, .time {
          text-transform: uppercase;
          font-weight: normal;
          h2 {
               font-size: .5em;
               color: #525252;
               margin: 0;
          }
          span {

               color: #a2aeae;
          }
     }

     .title {
          margin: 25px 0 0 0;
          text-align: left;
     }

     .name, .seat {
          /*margin: .7em 0 0 0;*/
     }

     .time {
          /*margin: .7em 0 0 1em;*/
     }

     .seat, .time {
          float: left;
          text-align: left;
     }

     .eye {
          position: relative;
          width: 2em;
          height: 1.5em;
          background: #fff;
          margin: 0 auto;
          border-radius: 1em/0.6em;
          z-index: 1;
          &:before, &:after {
               content:"";
               display: block;
               position: absolute;
               border-radius: 50%;
          }
          &:before {
               width: 1em;
               height: 1em;
               background: #e84c3d;
               z-index: 2;
               left: 8px;
               top: 4px;
          }
          &:after {
               width: .5em;
               height: .5em;
               background: #fff;
               z-index: 3;
               left: 12px;
               top: 8px;
          }
     }

     .number {
          text-align: center;
          text-transform: uppercase;
          h3 {
               color: #e84c3d;
               margin: .9em 0 0 0;
               font-size: 2.5em;

          }
          span {
               display: block;
               color: #a2aeae;
          }
     }

     .barcode {
          height: 2em;
          width: 0;
          margin: 1.2em 0 0 .8em;
          box-shadow: 1px 0 0 1px #343434,
               5px 0 0 1px #343434,
               10px 0 0 1px #343434,
               11px 0 0 1px #343434,
               15px 0 0 1px #343434,
               18px 0 0 1px #343434,
               22px 0 0 1px #343434,
               23px 0 0 1px #343434,
               26px 0 0 1px #343434,
               30px 0 0 1px #343434,
               35px 0 0 1px #343434,
               37px 0 0 1px #343434,
               41px 0 0 1px #343434,
               44px 0 0 1px #343434,
               47px 0 0 1px #343434,
               51px 0 0 1px #343434,
               56px 0 0 1px #343434,
               59px 0 0 1px #343434,
               64px 0 0 1px #343434,
               68px 0 0 1px #343434,
               72px 0 0 1px #343434,
               74px 0 0 1px #343434,
               77px 0 0 1px #343434,
               81px 0 0 1px #343434;
     }
     @media (max-width:390px) {
          h1 {
               font-size: 12px;
          }
          .cardLeft{
               width: 9em;
          }
          .btnSubmit {
               display: none;
          }
     }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/img-convert.js"></script>

<script>
     document.getElementById("btnSubmit").addEventListener("click", function () {
          html2canvas(document.getElementById("html-content-holder"),
                  {
                       allowTaint: true,
                       useCORS: true
                  }).then(function (canvas) {
               var anchorTag = document.createElement("a");
               document.body.appendChild(anchorTag);
               //document.getElementById("previewImg").appendChild(canvas);
               anchorTag.download = "filename";
               anchorTag.href = canvas.toDataURL();
               anchorTag.target = '_blank';
               anchorTag.click();
          });
     });
</script>