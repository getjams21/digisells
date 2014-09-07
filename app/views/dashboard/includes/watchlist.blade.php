<div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
                      <table class="table table-hover">
                        <thead>
                          <tr class="success">
                            <th>{{ sortBy('username','Watcher',$route)}}</th>
                            <th>{{ sortBy('auctionName','Event Name',$route)}}</th>
                            <th>{{ sortBy('auctionID','Type',$route)}}</th>
                            <th>{{ sortBy('updated_at','Date',$route)}}</th>
                            <th>{{ sortBy('status','Status',$route)}}</th>
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