<!DOCTYPE html>
<html>
<head>
  <title> </title>
  <style type="text/css"  media="print">
    
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }
    }
    
  </style>
  <style type="text/css">
    .table-head {
      margin-top: 10px;
    }
    .h1, .h2, .h3 {
      font-weight: bold;
    }
    .h1  {
      font-size: 50px;
    }
    .h2  {
      font-size: 45px;
    }
    .h3 {
      font-size: 25px;
      line-height: 1.0;
    }
    .ticket_table {
      margin-top: -15px;
      margin-bottom: 85px;
      letter-spacing: 5px;
      font-size: 30px;
      line-height: 1.0;
      font-weight: bold;
    }
    .l_c, .r_c {
      font-family: Georgia;
    }
    .num {
      font-family: consolas;
      font-size: 40px;
    } 
    .l_c {
      position: absolute;
    }
    .l_c div {
      width: 310px;
    }
    .r_c {
      margin-left: 310px; 
    }
    .r_c div {
      width: 300px;
      border: solid 0px;
    }
    .cent {
      margin: 0 auto;
      width: 540px;
      text-align: center;
    }
    .tck {
      margin-top: 20px;
      padding-bottom: 10px;
    }
    .bottom {
      margin-top: 50px;
    }

  </style>
</head>
<body>
<div class="container">
  <div class="row ">
  <script type="text/javascript">
    window.print();
    setTimeout(function(){
    window.close();
     }, 
    3000);
  </script>
    <div class="ticket_table">
     <div class="table-head">
       <div class="h1 cent " style="border-bottom:solid 2px;" > {{ $org_info->exists ? $org_info->name : " Organization Name Not Set "  }} </div>
       <div class="h1 cent " style="border-bottom:solid 2px;" > Summary for <?php echo date('d/m/Y', strtotime($date)); ?>  </div>
     </div>
     <div class="table"> 
       <div class="l_c"> 
        @if( count($tickets) > 0 )
          @foreach( $tickets as $ticket )
          <div class="num"> {{ $ticket->name }} </div>
          @endforeach 
        @endif
         <div class="num"> Total &nbsp;&nbsp;&nbsp;&nbsp;  </div> 
       </div> 
       <div class="r_c"> 
        @if( count($tickets) > 0 )
          @foreach( $tickets as $ticket )
          <div class="num"> {{ \App\Helpers\Helpers::getTicketAmount($date, $ticket->id) }} </div>
          @endforeach 
        @endif
         <div class="num" style="border-top:solid 2px;"> &#8358; {{ number_format($total_amount) }}   </div>
       </div>
      </div>
     </div>
  </div> 
  <div class="bottom"> ---- </div>
</div>
</body>
</html>
