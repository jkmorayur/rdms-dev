<?php
  $CI = & get_instance();
  $CI->rate = $emiInputs['emi_int_per'] / 100 / 12;
  $CI->principle = $emiInputs['emi_loan_amt'];
  $CI->time = $emiInputs['emi_tenure'] * 12; // in month
  $CI->x = pow(1 + $CI->rate, $CI->time);
  $CI->monthly = ($CI->principle * $CI->x * $CI->rate) / ($CI->x - 1);
  $CI->monthly = round($CI->monthly);
  $CI->k = $CI->time;
  $CI->arr = array();

  function getNextMonth($date) {
       global $CI;
       if ($CI->k == 0) {
            return 0;
       }
       $date = new DateTime($date);
       $interval = new DateInterval('P1M');
       $date->add($interval);
       $nextMonth = $date->format('Y-m-d') . "\n";
       $CI->arr[] = $nextMonth;
       $CI->k--;
       return getNextMonth($nextMonth);
  }

  $emiInputs['start_date'] = isset($emiInputs['start_date']) ? $emiInputs['start_date'] : '';
  getNextMonth($emiInputs['start_date']);

  $CI->date = "";
  $CI->upto = $CI->time;
  $CI->i = 0;
  $CI->totalint = 0;
  $CI->payment_date = date("Y m,d");
  $CI->tp = 0;
  $CI->details = '';

  function getEmi($t) {
       global $CI;
       $CI->i++;
       if ($CI->upto <= 0) {
            return 0;
       }
       $r = $t * $CI->rate;
       $p = round($CI->monthly - $r);
       $e = round($t - $p);
       if ($CI->upto == 2) {
            $CI->session->set_userdata('redirect_after_login', $e);
       }
       if ($CI->upto == 1) {
            $p = $CI->session->userdata('redirect_after_login');
            $e = round($t - $p);
            $CI->monthly = round($p + $r);
       }
       $CI->totalint = $CI->totalint + $r;
       $CI->tp = $CI->tp + $CI->monthly;
       $CI->upto--;

       $CI->details = $CI->details . '<tr>' .
               '<td width=20>' . $CI->i . '</td>' .
               '<td width=100>' . date("M j, Y", strtotime($CI->arr[$CI->i - 1])) . '</td>' .
               '<td width=80>' . '₹ ' . number_format(round($r)) . '</td>' .
               '<td width=130>' . '₹ ' . number_format($t) . '</td>' .
               '<td width=100>' . '₹ ' . number_format($p) . '</td>' .
               '<td width=130>' . '₹ ' . number_format($CI->monthly) . '</td>' .
               '<td width=130>' . '₹ ' . number_format(round($e)) . '</td></tr>';

       return getEmi($e);
  }

  getEmi($emiInputs['emi_loan_amt']);
?>
<ul class="fa-ul">
     <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>
          <p>Your monthly payment will be : <?php echo '₹ ' . round($CI->monthly);?></p></li>

     <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>
          <p>Your total payment will be : <?php echo '₹ ' . round($CI->tp);?></p></li>

     <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>
          <p>Your total interest payments will be : <?php echo '₹ ' . round($CI->totalint);?></p></li>
</ul>
<div style="height: 200px; overflow-y: scroll;overflow-x: hidden;">
     <table cellpadding="0" cellspacing="0" class="eni_list">
          <thead>
               <tr>
                    <th>S.N</th>
                    <th>Payment Date</th>
                    <th>Interest</th>
                    <th>Beginning Balance</th>
                    <th>Principle</th>
                    <th>Total Payment</th>
                    <th>Ending Balance</th>
               </tr>
          </thead>
          <tbody>
               <?php echo $CI->details;?>
          </tbody>
     </table>
</div>
<style type="text/css">
     .eni_list{
          width: 100%;
          border-radius: 0px;
          font-size: 12px;
          border:1px solid #D4D4D4;
     }
     .eni_list th{
          padding:5px;
          border:1px solid #D5D5D5;
          text-align:center;
     }
     .eni_list td{
          padding:5px;
          border:1px solid #D5D5D5;
          text-align:center;
     }
     .eni_list tr:nth-child(even){
          background:#E4E4E4;
     }
     span.err{
          color:#F00;
          font-weight:bold;
     }
</style>