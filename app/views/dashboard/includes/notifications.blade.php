<div class=""><br>
	<h4 class="capital"><b><a href="/users/{{Auth::user()->username}}">{{ Auth::user()->username }}'s</a> Latest Notifications</h4></b><br>
	<hr class="style-fade">
<div class="table-responsive" style="border-top: 1px solid #C0C0C0;">
	<table class="table table-hover">
    <thead>
  		<tr>
  			<th>Activity</th>
  			<th>Date</th>
        <th>Status</th>
  		</tr>
    </thead> 
    <tbody>
  		@foreach($notifications as $notification)
        
          <tr class="<?php if($notification['is_read'] == 0){echo "unread";};?>">
            <td class="notifID hidden">{{$notification['id']}}</td>
            <td><a href="/users/{{$notification['subject']}}"><b>{{$notification['subject']}}</b></a> {{$notification['body']}} 
            </td>
            <td>{{carbonize($notification['sent_at'])->diffForHumans();}}</td>
            <td class="readStatus"><i>
              @if($notification['is_read'] == 1)
              Read
              @else
              Unread
              @endif
            </i></td>
          </tr>

      @endforeach
      {{$notifications->links()}}
    </tbody>
	</table>
</div>
	<h4><small>No Activities yet...</small></h4>
</div>
