<ul class="nav flex-column">
    <div style="max-width: 300px">
        <img src="/DSA5_Logo_small.png" alt="DSA5 Logo" width="100%">
    </div>

    <h2>Navigation</h2>
    <li class="nav-item">
        <a href="/index.php?page=home">Home</a>
    </li>

    <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item">
            <a href="/index.php?page=add_content">Add Content</a>
        </li>
        <li class="nav-item">
            <a href="/index.php?page=view_content">View Content</a>
        </li>
        <li class="nav-item">
        <a href="/index.php?page=logout">Log out</a>
    </li>
    <?php elseif ($_GET['page'] === 'registration'): ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=add_content">Add Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=view_content">View Content</a>
        </li>

        <li class="nav-item">
        <a href="/index.php?page=login">Log in</a>
    </li>
    <?php elseif ($_GET['page'] === 'login'): ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=add_content">Add Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=view_content">View Content</a>
        </li>

        <li class="nav-item">
        <a href="/index.php?page=registration">Register</a>
    </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=add_content">Add Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="/index.php?page=view_content">View Content</a>
        </li>

        <li class="nav-item">
        <a href="/index.php?page=login">Log in</a>
        or
        <a href="/index.php?page=registration">Register</a>
    </li>
    <?php endif; ?>

</ul>
