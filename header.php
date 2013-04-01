    <div id="header">
        <h1><a id="header-logoLink" href="index.php">Kanban</a></h1>

        <ul id="menuLinks">
                        <li><a href="#">Boards</a></li>
                        <li><a href="#">My Board</a></li>
                        <li><a href="#">Arch Board</a></li>
                        
                        <li class="menuLinks-settings">
                        	<a href="#" class="menuLinks-settingsImgLink null">
	                        	<img src="/img/blankuser.jpg">
	                        </a>
	                        <a href="#" class="menuLinks-settingsLink null">
		                        <?php print_r($_SESSION['adun']);?>
		                    </a>
                        </li>
            <li><a href="/logout.php">Logout</a></li>
        </ul>
    </div>
