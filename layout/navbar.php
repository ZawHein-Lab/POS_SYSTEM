<div class="navbar">
    <div class="leftNavBar">
        <div class="search-container">
            <form action="" method="post">
                <input type="text" name="search_data" placeholder="Search..." class="search-input">
                <button class="search-btn" name="search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="rightNavBar">
        <h6><?php if (isset($_COOKIE['user'])) {
    // Decode the JSON string into a PHP associative array
    $userData = json_decode($_COOKIE['user'], true);

    // Check if the 'username' key exists and display it
    if (isset($userData['username'])) {
        echo htmlspecialchars($userData['username']);
    } else {
        echo "Username";
    }
}?></h6>
        <div class="dropdown">
            <img src="../assets/image/profile.png" id="profileImage" alt="Image" class="dropdown-img">
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Profile</a>
                <form action="" method="POST">
                <button class="dropdown-item" name="logout">Logout</button>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- remove search bar when not needed -->
<script>
   const fullUrl = window.location.href;
//    console.log(fullUrl); // Outputs the complete URL
   const parts = fullUrl.split("/");
    latestUrl = parts[parts.length - 1];
    searchBar = $(".search-container");
    // if(latestUrl=== "add_user.php"){
    //     searchBar.css("display", "none");
    // }
    if(latestUrl.includes("add")) searchBar.css("display","none")
    // console.log($searchBar);
</script>
<!-- remove search bar when not needed -->