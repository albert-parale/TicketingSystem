<div class="container">
    <div class="row">
        <div class="card col-12" >
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'user.userdash' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('user.userdash') }}">Open Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'user.userpending' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('user.userpending') }}">Pending Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'user.userresolved' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('user.userresolved') }}">Resolved Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'user.userdelete' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('user.userdelete') }}">Deleted Tickets</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

