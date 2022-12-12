<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Search</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content searchForm textColor">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter the name of the file or directory</h5>
            </div>
            <form class="form-inline my-2 my-lg-0 searchForm" method="POST" action="/search">
                @csrf
                <input class="form-control mr-sm-2 searchInput" type="text" name="searchText">
            </form>
        </div>
    </div>
</div>

