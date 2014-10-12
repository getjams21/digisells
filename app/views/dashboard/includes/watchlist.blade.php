<div class="panel panel-primary">
  <div class="panel-heading"><h4>@if($event=='Watching')Listings you're watching
    @else
      Your Current Watchers
    @endif</h4></div>
<div class="panel-body">
<div class="table-responsive" >
  <table class="table table-striped table-bordered table-hover watchlist">
    <thead>
      <tr>
        <th>Username</th>
        <th>Event Name</th>
        <th>Type</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
     </thead> 
     <tbody>
         @foreach($watchlists as $watchlist)
          <tr> 
            <td>
              <a href="/users/{{$watchlist->username}}"><b>
                @if(!$watchlist->type)
                {{$watchlist->username}}
                @else
                {{$watchlist->firstName}}
                @endif
              </b></a>
            </td><td> 
                @if($watchlist->auctionID)
                  <a href="/auction-listing/{{$watchlist->auctionID}}"><b>{{$watchlist->auctionName}}</b> </a>
                @elseif($watchlist->sellingID)
                 <a href="/auction-listing/{{$watchlist->sellingID}}"><b>{{$watchlist->sellingName}}</b> </a>
                @else
                  Listing Activities
                @endif
            </td>
            <td>
              @if($watchlist->auctionID) Auction
              @elseif($watchlist->sellingID) Direct Selling
              @else All Listings
              @endif
            </td>
            <td>{{dateformat($watchlist->updated_at)}} at {{timeformat($watchlist->updated_at)}}</td>
            <td>@if($watchlist->status == 1)
                    ACTIVE
                @endif
            </td>
         </tr> 
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>