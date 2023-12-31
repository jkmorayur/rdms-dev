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