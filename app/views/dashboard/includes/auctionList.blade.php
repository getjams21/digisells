<div class="col-md-12">
  <br><hr class="style-fade">
  <table class="table table-hover">
      <tr>
        <th>List No</th>
        <th>Auction Name</th>
        <th>Qty</th>
        <th>Amount</th>
        <th>Bids</th>
        <th>Last Bidder</th>
        <th>Date</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
      </tr>
      <tr>
        @foreach($auction as $auction)
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$auction->auctionName}}</td>
            <td>{{$auction->quantity}}</td>
            <td>{{$auction->minimumPrice}}</td>
            <td>0</td>
            <td>None</td>
            <td>-</td>
            <td>{{date("d F Y",strtotime($auction->startDate)) }} at {{ date("g:ha",strtotime($auction->startDate)) }}</td>
            <td>{{date("d F Y",strtotime($auction->endDate)) }} at {{ date("g:ha",strtotime($auction->endDate)) }}</td>
            <td>
              @if($auction->sold==0)
               <p style="color:green;"><b>AVAILABLE</b></p>
              @else
                <p style="color:red;"><b>ENDED</b></p>
              @endif
            </td>
         </tr> 
        @endforeach
      </tr>
      <tr>
        <td colspan="10"></td>
      </tr>
  </table>
</div>