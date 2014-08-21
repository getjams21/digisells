<div class="col-md-12">
  <br><hr class="style-fade">
  <table class="table table-hover">
      <tr>
        <th>List No</th>
        <th>Sale Name</th>
        <th>Qty</th>
        <th>Amount</th>
        <th>Date Created</th>
        <th>End Date</th>
        <th>Qty Sold</th>
        <th>Status</th>
      </tr>
      @foreach($selling as $selling)
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$selling->sellingName}}</td>
            <td>{{$selling->quantity}}</td>
            <td>{{$selling->price}}</td>
            <td>{{date("d F Y",strtotime($selling->created_at)) }} at {{ date("g:ha",strtotime($selling->created_at)) }}</td>
            <td>{{date("d F Y",strtotime($selling->expirationDate)) }} at {{ date("g:ha",strtotime($selling->expirationDate)) }}</td>
            <td>0</td>
            <td>
              @if($selling->sold==0)
               <p style="color:green;"><b>AVAILABLE</b></p>
              @else
                <p style="color:red;"><b>ENDED</b></p>
              @endif
            </td>
         </tr> 
        @endforeach
      <tr>
        <td colspan="8"></td>
      </tr>
  </table>
</div>