<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="?page=home">Sequence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == "home"){echo("active\"aria-current='page'");}?>" href="?page=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == "about"){echo("active\"aria-current='page'");}?>" href="?page=about">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Scores
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item <?php if ($currentPage == "score_fast"){echo("active\"aria-current='page'");}?>" href="?page=score&diff=fast">Fast</a></li>
                    <li><a class="dropdown-item <?php if ($currentPage == "score_norm"){echo("active\"aria-current='page'");}?>" href="?page=score&diff=norm">Normal</a></li>
                    <li><a class="dropdown-item <?php if ($currentPage == "score_slow"){echo("active\"aria-current='page'");}?>" href="?page=score&diff=slow">Slow</a></li>
                </ul>
            </li>
            </ul>
            <form class="d-flex" action="#" onsubmit="searchUser();return false">
                <input id="querryUserInput" class="form-control me-2"   type="search" placeholder="Search for users!" aria-label="Search">
                <button class="btn btn-outline-light" type="button" onclick="searchUser()" >Seach</button>
            </form>
        </div>
    </div>
</nav>