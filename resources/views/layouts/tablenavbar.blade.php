<div class="container">
    <data class="row">
        <div class="card col-12" >
            <div class="card-header">
                
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'admin.dashboard' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('admin.dashboard') }}">Open Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'admin.Adminpending' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('admin.Adminpending') }}">Pending Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'admin.Adminresolved' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('admin.Adminresolved') }}">Resolved Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::path() === 'admin.Admindeleted' ? 'nav-link active' : 'nav-link'}}" style="color: black;" href="{{ route('admin.Admindeleted') }}">Deleted Tickets</a>
                    </li>
                </ul>
            </div>
        </div>
    </data>
</data>

