<!DOCTYPE html>
<html>
<head>
  <title> </title>
  <style type="text/css"  media="print">
    
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
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
      letter-spacing: 5px;
      font-size: 30px;
      line-height: 1.0;
      font-weight: bold;
      padding-bottom: -50px;
      margin-bottom: -50px;
    }
    .l_c, .r_c {
      font-family: Georgia;
    }
    .num {
      font-family: consolas;
      font-size: 37px;
    } 
    .l_c {
      position: absolute;
    }
    .r_c {
      margin-left: 240px; 
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
    .bd-wrap {
      margin: 0 auto;
      width: 540px;
      text-align: center;
      border: solid 2px;
    }
  </style>
</head>
<body>
<div>
@if( isset($ticket) )
  <script type="text/javascript">
    window.print();
    setTimeout(function(){
    window.close();
     }, 
    3000);
  </script>
  <div class="ticket_table">
     <div class="table-head">
       <div class="h1 cent" > {{ $org_info->exists ? $org_info->name : " Organization Name Not Set "  }} </div>
       @if( $ticket->ticket_type != 'normal' )
       <div class="h2 bd-wrap text-capitalize" >  {{ $ticket->ticket_type }} {{ $ticket->ticket->name }} Ticket </div>
       @else
       <div class="h2 bd-wrap text-capitalize" > {{ $ticket->ticket->name }} Ticket </div>
       @endif
     </div>
     <div class="table">  <!-- Ticket Table Head -->
       <div class="l_c">
        @if( $ticket->ticket_type == 'group' )
          <div class=""> Nop </div>
        @else
         <div class=""> Adult </div> 
         <div class=""> Children </div>
        @endif 
         <div class=""> date  </div> 
         <div class=""> Time </div> 
         <div class=""> Issued by </div> 
         <div class=""> Amount  </div>
       </div> <!-- l_c  end -->
       <div class="r_c">  <!-- Ticket Table Details -->
        @if( $ticket->ticket_type == 'group' )
          <div class=""> {{ $ticket->no_of_adult }} </div>
        @else
         <div class="num"> {{ $ticket->no_of_adult }} </div> 
         <div class="num"> {{ $ticket->no_of_children }}  </div> 
        @endif
         <div class="num">  </div> 
         <div class=""> <?php echo date('d M, Y', strtotime($ticket->created_at)); ?> </div>
         <div class=""> <?php echo date('h:i a', strtotime($ticket->created_at)); ?> </div>
      
         <div class="">  {{ $ticket->user->username }} </div> <!-- user -->
         
         <div class="num"> <?php echo number_format($ticket->total); ?> </div> <!-- total Amount -->
       </div> <!-- r_c end -->
     </div>
     <div class="h3 bd-wrap" > ... <span class="num"> {{ $ticket->ticket_num }} </span> ... </div>
     <div> ---- </div>
  </div> <!-- ticket table end -->
@endif 
</div>
</body>
</html>