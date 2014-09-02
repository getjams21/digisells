<div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover">
                        <thead>
                          <tr class="success">
                            <th>{{ sortBy('username','Watcher','watchlist')}}</th>
                            <th>{{ sortBy('auctionName','Event Name','watchlist')}}</th>
                            <th>{{ sortBy('auctionID','Type','watchlist')}}</th>
                            <th>{{ sortBy('updated_at','Date','watchlist')}}</th>
                            <th>{{ sortBy('status','Status','watchlist')}}</th>
                          </tr>
                         </thead> 
                         <tbody>
                             @foreach($watchlists as $watchlist)
                              <tr> 
                                <td>
                                  <a href="/users/{{$watchlist->username}}"><b>{{$watchlist->username}}</b></a>
                                </td><td> 
                                    @if($watchlist->auctionID)
                                      <a href="/auction-listing/{{$watchlist->auctionID}}"><b>{{$watchlist->auctionName}}</b> </a>
                                    @elseif($watchlist->sellingID)
                                     <a href="#"><b>{{$watchlist->sellingName}}</b> </a>
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
                          {{$watchlists->links()}}
                          </tbody>
                      </table>
                    </div>