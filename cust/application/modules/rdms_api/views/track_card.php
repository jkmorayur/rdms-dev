<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

/* Variables */
:root {
  --grey: rgb(235, 235, 235);
  --white: rgb(255, 255, 255);
  --border-grey: rgb(211, 211, 211);
}

/* Common classes */
.padding {
  padding: 15px;
}

.border {
  border: 1px solid var(--border-grey);
}

.span {
  font-weight: 500;
}

.mt-50 {
  margin-top: 50px;
}

/* Container styles start */
.container {
  max-width: 1356px;
  margin: 0 auto;
  background-color: var(--white);
  height: auto;
  padding: 30px;
}
/* Container styles end */

/* grey color */
.grey {
  background-color: var(--grey);
}

/* Container responsive styles start  */
@media screen and (max-width: 768px) {
  .container {
    width: 100%;
    padding: 25px;
  }
}

@media screen and (max-width: 576px) {
  .container {
    padding: 20px;
  }
}
/* Container responsive styles start  */

/* main-heading styles start */
.main-heading {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  border: solid 1px var(--border-grey);
}

.main-heading h1 {
  font-size: 22px;
  font-weight: 600;
}
/* main-heading styles start */

/* main heading responsive styles start */
@media screen and (max-width: 768px) {
  .main-heading {
    padding: 8px;
  }
  .main-heading h1 {
    font-size: 20px;
  }
}

@media screen and (max-width: 576px) {
  .main-heading h1 {
    font-size: 18px;
  }
}
/* main heading responsive styles end */

/* name date wrapper styles start */
.name-date-wrapper {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  height: auto;
}

.date p:nth-child(2) {
  margin-top: 8px;
}

.name,
.date p {
  font-size: 18px;
}
/* name date wrapper styles end */

/* name date wrapper responsive start */
@media screen and (max-width: 768px) {
  .name-date-wrapper {
    grid-template-columns: repeat(1, 1fr);
  }

  .name,
  .date p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .name,
  .date p {
    font-size: 14px;
  }
}
/* name date wrapper responsive end */

/* statuses styles start */

.statuses {
  background-color: var(--grey);
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.status,
.current-status p {
  font-size: 18px;
}

/* statuses styles end */

/* Statuses responsive start */
@media screen and (max-width: 768px) {
  .statuses {
    grid-template-columns: repeat(1, 1fr);
  }

  .status,
  .current-status p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .status,
  .current-status p {
    font-size: 14px;
  }
}
/* Statuses responsive end */

/* mode of enquiry styles */
.mode-of-enquiry {
  width: 100%;
}

.mode-of-enquiry p {
  font-size: 18px;
}

/* mode of enquiry responsive start */
@media screen and (max-width: 768px) {
  .mode-of-enquiry p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .mode-of-enquiry p {
    font-size: 14px;
  }
}
/* mode of enquiry responsive end */

/* customer details style start */
.customer-details-heading {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
}

.customer-details-heading p {
  font-size: 20px;
  font-weight: 600;
}
/* customer details style end */

/* customer details responsive start */
@media screen and (max-width: 768px) {
  .customer-details-heading p {
    font-size: 18px;
  }
}

@media screen and (max-width: 576px) {
  .customer-details-heading p {
    font-size: 16px;
  }
}
/* customer details responsive end */

/* customer id name style start */
.customer-id-name {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.customer-id,
.customer-name p {
  font-size: 18px;
}
/* customer id name style end */

/* customer id name responsive start */
@media screen and (max-width: 768px) {
  .customer-id,
  .customer-name p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .customer-id,
  .customer-name p {
    font-size: 14px;
  }
}

@media screen and (max-width: 375px) {
  .customer-id-name {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
  }
}
/* customer id name responsive end */

/* place style start */
.place {
  width: 100%;
}

.place p {
  font-size: 18px;
}
/* place style end */

/* customer id name responsive start */
@media screen and (max-width: 768px) {
  .place p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .place p {
    font-size: 14px;
  }
}
/* customer id name responsive end */

/* Address and contact details style start */

.address-contacts {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}
.address {
  height: auto;
}

.mobile,
.whatsapp,
.email,
.address p {
  font-size: 18px;
}

.whatsapp {
  background-color: var(--grey);
}
/* Address and contact details style end */

/* addess-contact responsive start */
@media screen and (max-width: 768px) {
  .address-contacts {
    grid-template-columns: repeat(1, 1fr);
  }

  .mobile,
  .whatsapp,
  .email,
  .address p {
    font-size: 16px;
  }

  .whatsapp {
    background-color: var(--white);
  }

  .mobile {
    background-color: var(--grey);
  }
}

@media screen and (max-width: 576px) {
  .mobile,
  .whatsapp,
  .email,
  .address p {
    font-size: 14px;
  }
}
/* address contact responsive end */

/* Customer details style start */
.customer-details {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}
.customer-details p {
  font-size: 18px;
}
/* Customer details style end */

/* customer details responsive start */
@media screen and (max-width: 768px) {
  .customer-details {
    grid-template-columns: repeat(1, 1fr);
  }
  .customer-details p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .customer-details p {
    font-size: 14px;
  }
}
/* customer details responsive end */

/* type style start */
.type p {
  font-size: 18px;
}
/* type style end */

/* type responsive start */
@media screen and (max-width: 768px) {
  .type p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .type p {
    font-size: 14px;
  }
}
/* type responsive end */

/* home visit heading style start */
.home-visit-heading {
  display: flex;
  justify-content: center;
  align-items: center;
}

.home-visit-heading p {
  font-size: 20px;
  font-weight: 600;
}
/* home visit heading style end */

/* home visit heading reponsive style start */
@media screen and (max-width: 768px) {
  .home-visit-heading p {
    font-size: 18px;
  }
}

@media screen and (max-width: 576px) {
  .home-visit-heading p {
    font-size: 16px;
  }
}
/* home visit heading reponsive style end */

/* Date-place style start */

.date-place {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.place {
  padding-left: 12px;
}

.date-place p {
  font-size: 18px;
}

/* Date-place style start */

/* date-place reponsive style start */
@media screen and (max-width: 768px) {
  .date-place {
    grid-template-columns: repeat(1, 1fr);
  }

  .d-place {
    padding-top: 12px;
    padding-left: 0;
  }

  .date-place p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .date-place p {
    font-size: 14px;
  }
}
/* date-place reponsive style end */

/* Travel styles start */
.travel {
  display: grid;
  grid-template-columns: 40% 60%;
}

.travel p {
  font-size: 18px;
}

/* .travel-details{
    min-height: 150px;
    max-height: auto;
} */
/* travel styles end */

/* Travel responsive style start */
@media screen and (max-width: 768px) {
  .travel {
    grid-template-columns: repeat(1, 1fr);
  }

  .travel p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .travel p {
    font-size: 14px;
  }
}
/* date-place reponsive style end */

/* Discussion style  start */
.discussion {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.discussion p {
  font-size: 18px;
}

.remark {
  min-height: 150px;
}
/* Discussion style  end */

/* Discussion responsive start */
@media screen and (max-width: 768px) {
  .discussion p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .discussion p {
    font-size: 14px;
  }
}

@media screen and (max-width: 375px) {
  .discussion {
    grid-template-columns: repeat(1, 1fr);
  }
}
/* Discussion responsive end */

/* Enquiry questions style start */
.enquiry-heading {
  display: flex;
  justify-content: center;
  align-items: center;
}

.enquiry-heading p {
  font-size: 20px;
  font-weight: 600;
}
/* Enquiry questions style end */

/* Enquiry questions start */
@media screen and (max-width: 768px) {
  .enquiry-heading p {
    font-size: 18px;
  }
}

@media screen and (max-width: 576px) {
  .enquiry-heading p {
    font-size: 16px;
  }
}
/* Enquiry questions end */

/* Questions style start*/

.questions {
  display: grid;
  grid-template-columns: 80% 20%;
}

.value {
  display: flex;
  justify-content: center;
  align-items: center;
}

.questions p {
  font-size: 18px;
}

/* Questions style end*/

/* Questions responsive start */

@media screen and (max-width: 768px) {
  .questions p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .questions {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
  }

  .value {
    justify-content: flex-start;
    border: none;
  }

  .value p {
    font-weight: 500;
  }

  .questions p {
    font-size: 14px;
  }
}
/* Questions responsive end */

/* Sales heading style start */
.sales-heading {
  display: flex;
  justify-content: center;
  align-items: center;
}

.sales-heading p {
  font-size: 20px;
  font-weight: 600;
}
/* Sales heading style end */

/* Sales heading responsive start */
@media screen and (max-width: 768px) {
  .sales-heading p {
    font-size: 18px;
  }
}

@media screen and (max-width: 576px) {
  .sales-heading p {
    font-size: 16px;
  }
}
/* Sales heading responsive end */

/* Sales style start */
.sales {
  display: grid;
  grid-template-columns: 60% 40%;
}
.left-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
}
.right-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.brand,
.brand-value,
.year,
.year-value,
.color,
.color-value,
.fuel,
.fuel-value,
.registration,
.registration-value,
.KM,
.KM-value,
.price,
.price-value,
.owner,
.owner-value {
  display: flex;
  justify-content: center;
  align-items: center;
}

.brand,
.year,
.price,
.color,
.fuel,
.registration,
.KM,
.owner {
  font-size: 18px;
}

.brand-value,
.year-value,
.color-value,
.fuel-value,
.registration-value,
.KM-value,
.price-value,
.owner-value {
  min-height: 80px;
}

/* Sales sytle end */

/* Sales responsive style start */
@media screen and (max-width: 916px) {
  .sales {
    grid-template-columns: repeat(1, 1fr);
  }

  .right-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
  }

  .brand,
  .year,
  .price,
  .color,
  .fuel,
  .registration,
  .KM,
  .owner {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .left-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
  }
  .right-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
  }

  .brand,
  .year,
  .price,
  .color,
  .fuel,
  .registration,
  .KM,
  .owner {
    font-size: 16px;
  }
}
/* Sales responsive style end */

/* Variant styles start */
.variant p {
  font-size: 18px;
  font-weight: 500;
}
/* Variant styles end */

/* Variant responsive start */
@media screen and (max-width: 768px) {
  .variant p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .variant p {
    font-size: 15px;
  }
}
/*Variant responsive end */

/* date and remark style start */
.date-and-remarks {
  display: grid;
  grid-template-columns: 30% 70%;
  margin-top: 50px;
}

.date-and-remarks p {
  font-size: 18px;
}

.remarks p:nth-child(2) {
  margin-top: 12px;
}

.remarks p:nth-child(3) {
  margin-top: 12px;
}
.date-icon {
  display: flex;
  justify-content: flex-start;
}

.dt {
  margin-left: 12px;
}
.icon img {
  width: 86px;
  height: 86px;
}
/* date and remark style end */

/* Variant responsive start */
@media screen and (max-width: 768px) {
  .date-and-remarks {
    grid-template-columns: repeat(1, 1fr);
    margin-top: 30px;
  }

  .date-and-remarks p {
    font-size: 16px;
  }

  .dt {
    margin-left: 12px;
  }
  .remarks {
    margin-top: 10px;
  }
  .icon img {
    width: 66px;
    height: 66px;
  }
}

@media screen and (max-width: 576px) {
  .date-and-remarks {
    margin-top: 25px;
  }

  .date-and-remarks p {
    font-size: 14px;
  }

  .dt {
    margin-left: 10px;
  }
}
/*Variant responsive end */

/* Analysis style start */
.analysis {
  margin: 35px 0px;
}

.analysis p {
  font-size: 18px;
}
/* Analysis style end */

/* Analysis responsive start */
@media screen and (max-width: 768px) {
  .analysis {
    margin: 25px 0px;
  }
  .analysis p {
    font-size: 16px;
  }
}

@media screen and (max-width: 576px) {
  .analysis {
    margin: 20px 0px;
  }
  .analysis p {
    font-size: 14px;
  }
}
/* Analysis responsive end */

/* footer table style start */
.footer-table p {
  font-size: 18px;
}

.footer-table {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}

.C-status,
.f-vehicle {
  display: flex;
  justify-content: center;
  align-items: center;
}

.f-vehicle-value,
.C-status-value {
  min-height: 90px;
}

.vehicle-grid {
  width: 100%;
}
/* footer table style end */

/* Analysis responsive start */
@media screen and (max-width: 768px) {
  .footer-table p {
    font-size: 16px;
  }

  .footer-table {
    grid-template-columns: repeat(1, 1fr);
  }

  .f-vehicle-value,
  .C-status-value {
    display: flex;
    justify-content: center;
    align-items: center;
  }
}

@media screen and (max-width: 576px) {
  .footer-table p {
    font-size: 14px;
  }
}
/* Analysis responsive end */

/* signature style start */

.signature-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  margin-top: 50px;
}
.signature-grid p {
  font-size: 18px;
}

.exe-sign,
.sm-sign,
.md-sign {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}

/* signature style end*/

/* Analysis responsive start */
@media screen and (max-width: 768px) {
  .signature-grid {
    grid-template-columns: repeat(1, 1fr);
    margin-top: 30px;
  }
  .signature-grid p {
    font-size: 16px;
  }

  .exe-sign,
  .sm-sign,
  .md-sign {
    align-items: baseline;
  }

  .sm-sign,
  .md-sign {
    margin-top: 30px;
  }
}

@media screen and (max-width: 576px) {
  .signature-grid {
    margin-top: 25px;
  }
  .signature-grid p {
    font-size: 14px;
  }

  .sm-sign,
  .md-sign {
    margin-top: 25px;
  }
}
/* Analysis responsive end */

</style>
  </head>
  <body>
    <div class="container">
      <div class="main-heading grey">
        <h1>Title</h1>
      </div>
      <div class="name-date-wrapper">
        <div class="name padding border">
          <p><span class="span">Name Of Executive:</span> Vivek Mpm</p>
        </div>
        <div class="date padding border">
          <p><span class="span">Enq Date:</span> 15/12/2022</p>
          <p><span class="span">Entry Date:</span> 15/01/2023</p>
        </div>
      </div>
      <div class="statuses">
        <div class="status padding border">
          <p><span class="span">Status:</span> Hot</p>
        </div>
        <div class="current-status padding border">
          <p><span class="span">Enq current status:</span> Hot</p>
        </div>
      </div>
      <div class="mode-of-enquiry padding border">
        <p><span class="span">Mode of Enquiry:</span> CUG-RD-IN</p>
      </div>
      <div class="customer-details-heading grey border">
        <p>Customer Details</p>
      </div>
      <div class="customer-id-name">
        <div class="customer-id padding border">
          <p>
            <span class="span">Customer ID:</span> <br />
            7558859
          </p>
        </div>
        <div class="customer-name padding border">
          <p>
            <span class="span">Name :</span> <br />
            David
          </p>
        </div>
      </div>
      <div class="place padding border grey">
        <p><span class="span">Place:</span> Thiruvalla</p>
      </div>
      <div class="address-contacts">
        <div class="address padding border">
          <p><span class="span">Address:</span> Thiruvalla</p>
        </div>
        <div class="contacts">
          <div class="mobile padding border">
            <p><span class="span">Mobile :</span> 98677 75667</p>
          </div>
          <div class="whatsapp padding border">
            <p><span class="span">Whatsapp :</span> 89459 56569</p>
          </div>
          <div class="email padding border">
            <p><span class="span">Email :</span> David@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="customer-details">
        <div class="customer-details-left">
          <div class="occupation padding border grey">
            <p><span class="span">Occupation :</span> Business</p>
          </div>
          <div class="email-id padding border">
            <p><span class="span">Email ID :</span> david@gmail.com</p>
          </div>
          <div class="fill-id padding border grey">
            <p><span class="span">Fill ID :</span></p>
          </div>
          <div class="state padding border">
            <p><span class="span">State :</span> Business</p>
          </div>
        </div>
        <div class="customer-details-right">
          <div class="age-grp padding border grey">
            <p><span class="span">Age Group :</span> 20-30</p>
          </div>
          <div class="company padding border">
            <p><span class="span">Company :</span> david@gmail.com</p>
          </div>
          <div class="district padding border grey">
            <p><span class="span">District :</span> Pathanamthitta</p>
          </div>
          <div class="pin padding border">
            <p><span class="span">Pin :</span> 656 785</p>
          </div>
        </div>
      </div>
      <div class="type padding border grey">
        <p><span class="span">Type :</span> Sell</p>
      </div>

      <div class="home-visit-heading padding border">
        <p>Home Visit Details</p>
      </div>
      <div class="date-place padding border grey">
        <div class="date">
          <p><span class="span">Date :</span></p>
        </div>
        <div class="d-place">
          <p><span class="span">Place :</span></p>
        </div>
      </div>
      <div class="travel">
        <div class="travel-left padding border">
          <div class="travel-details">
            <p><span class="span">Travel Details</span></p>
          </div>
        </div>
        <div class="travel-right">
          <div class="vehicle padding border">
            <p><span class="span">Vehicle :</span></p>
          </div>
          <div class="out-KM padding border grey">
            <p><span class="span">Out KM :</span></p>
          </div>
          <div class="in-KM padding border">
            <p><span class="span">In KM :</span></p>
          </div>
          <div class="in-date padding border grey">
            <p><span class="span">In Date :</span></p>
          </div>
          <div class="Approved padding border">
            <p><span class="span">Approved :</span></p>
          </div>
        </div>
      </div>
      <div class="discussion">
        <div class="discussion-left">
          <div class="discussion-time padding border grey">
            <p><span class="span">Discussion Time :</span></p>
          </div>
          <div class="remark padding border">
            <p><span class="span">SM Remarks :</span></p>
          </div>
        </div>
        <div class="discussion-right">
          <div class="discussion-time padding border grey">
            <p><span class="span">Discussion Time :</span></p>
          </div>
          <div class="remark padding border">
            <p><span class="span">GM Remarks :</span></p>
          </div>
        </div>
      </div>
      <!-- Enquiry Questions Section Start -->
      <div class="mt-50">
        <div class="enquiry-heading padding border grey">
          <p>Enquiry Questions</p>
        </div>
        <div class="questions">
          <div class="question padding border">
            <p>
              Are there any specific makes or model you are interested in? /
              Which vehicle are you planning to buy?
            </p>
          </div>
          <div class="value padding border">
            <p>Nill</p>
          </div>
        </div>
        <div class="questions">
          <div class="question padding border">
            <p>
              Are there any specific makes or model you are interested in? /
              Which vehicle are you planning to buy?
            </p>
          </div>
          <div class="value padding border">
            <p>Nill</p>
          </div>
        </div>
        <div class="questions">
          <div class="question padding border">
            <p>
              Are there any specific makes or model you are interested in? /
              Which vehicle are you planning to buy?
            </p>
          </div>
          <div class="value padding border">
            <p>Business</p>
          </div>
        </div>
        <div class="questions">
          <div class="question padding border">
            <p>
              Are there any specific makes or model you are interested in? /
              Which vehicle are you planning to buy?
            </p>
          </div>
          <div class="value padding border">
            <p>Business</p>
          </div>
        </div>
      </div>
      <!-- Enquiry questions section end -->

      <!-- Sales vehicle section start -->
      <div class="mt-50">
        <div class="sales-heading padding border grey">
          <p>Sales Vehicle</p>
        </div>
        <div class="sales">
          <div class="sales-left border">
            <div class="left-grid">
              <div class="brand-grid">
                <div class="brand padding border span">
                  <p>Brand,Model,Variant</p>
                </div>
                <div class="brand-value padding border"></div>
              </div>
              <div class="fuel-grid">
                <div class="fuel padding border span">
                  <p>Fuel</p>
                </div>
                <div class="fuel-value padding border"></div>
              </div>
              <div class="year-grid">
                <div class="year padding border span">
                  <p>Year</p>
                </div>
                <div class="year-value padding border"></div>
              </div>
              <div class="color-grid">
                <div class="color padding border span">
                  <p>Color</p>
                </div>
                <div class="color-value padding border"></div>
              </div>
            </div>
            <div class="registration-grid">
              <div class="registration padding border span">
                <p>Registration</p>
              </div>
              <div class="registration-value padding border"></div>
            </div>
          </div>
          <div class="sales-right border">
            <div class="right-grid">
              <div class="price-grid">
                <div class="price padding border span">
                  <p>Price : From-To</p>
                </div>
                <div class="price-value padding border"></div>
              </div>
              <div class="KM-grid">
                <div class="KM padding border span">
                  <p>KM : From-To</p>
                </div>
                <div class="KM-value padding border"></div>
              </div>
            </div>
            <div class="registration-grid">
              <div class="owner padding border span">
                <p>Owner</p>
              </div>
              <div class="owner-value padding border"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-50">
        <div class="variant">
          <p>Skoda L & K Variant / Version</p>
        </div>
        <div class="date-and-remarks">
          <div class="date-icon">
            <div class="icon">
              <img src="/image/calender -icon.png" alt="" />
            </div>
            <div class="dt">
              <p class="span">12/12/2022</p>
            </div>
          </div>
          <div class="remarks padding grey">
            <p>
              <span class="span">Remarks :</span> Customer needs to purchase
              Audi
            </p>
            <p><span class="span">Mode of contact :</span> CUG-RD-IN</p>
            <p>
              <span class="span">Next action plan :</span> Customer needs to
              purchase Audi
            </p>
          </div>
        </div>
      </div>
      <div class="analysis">
        <p class="span">
          Enquiry Analysis (Reason for the Drop/Close/Lose of Purchase or Sale/
          Delete)
        </p>
      </div>
      <div class="footer-table">
        <div class="vehicle-grid">
          <div class="f-vehicle padding border grey">
            <p class="span">Vehicle</p>
          </div>
          <div class="f-vehicle-value padding border">
            <p>Skoda, L & K, Variant / Version</p>
          </div>
        </div>
        <div class="current-status-grid">
          <div class="C-status padding border grey">
            <p class="span">Current status</p>
          </div>
          <div class="C-status-value padding border"></div>
        </div>
        <div class="current-status-grid">
          <div class="C-status padding border grey">
            <p class="span">Current Status</p>
          </div>
          <div class="C-status-value padding border"></div>
        </div>
      </div>
      <div class="signature-grid">
        <div class="exe-sign">
          <div class="sign">
            <p>Executive Signature</p>
          </div>
          <div class="exe-date">
            <p class="span">Date :</p>
          </div>
        </div>
        <div class="sm-sign">
          <div class="sign">
            <p>SM/TL Signature</p>
          </div>
          <div class="sm-date">
            <p class="span">Date :</p>
          </div>
        </div>
        <div class="md-sign">
          <div class="sign">
            <p>Executive Signature</p>
          </div>
          <div class="md-date">
            <p class="span">Date :</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

