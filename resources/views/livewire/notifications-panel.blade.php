
<a class="notification" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        @if($number>0)
        <span class="badge">{{$number}}</span>
        @endif
</a>
    <div class="dropdown-menu" style="width:40%">
        <a class="dropdown-item disabled" style="max-width:100% " href="#">Notifications</a>
        <div class="dropdown-divider"></div>
        @if($number==0)
         <a class="dropdown-item disabled" style="max-width:100% " href="#">Aucune notification à afficher.</a>
        @else
            @foreach($notifications as $notification)
            <a class="dropdown-item" style="max-width:100% " data-flip="true" href="{{$notification->link}}"><i class="fas fa-{{$notification->icon}}"></i> &nbsp; {{$notification->content}}</a>
            @endforeach
        @endif
    </div>
