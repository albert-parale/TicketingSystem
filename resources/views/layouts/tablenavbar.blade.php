@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container" style="width: 1200px;">
    <data class="row">
        <div class="card col-12" >
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Open Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/Adminpending">Pending Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/Adminresolved">Resolved Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/Admindeleted">Deleted Tickets</a>
                    </li>
                </ul>
            </div>
        </div>
    </data>
</data>

