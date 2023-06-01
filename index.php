<?php
  include('include/init.php');
  echoHeader("Grace's website");
?>
    <body>
        <div class="homesection" id="home">
          <div class="stackedflex">
            <h1 class="frontheader">Hi, I'm Grace</h1>
          </div>
          <p class="frontcaption">Welcome to my blog</p>
          <span>
            <img src="grace lee headshot.jpg" alt="My Face" width="70" height="70" style="border-radius: 50%;">
          </span>
          <ul class="homenavbar">
              <li><p class='navbarbuttons'><a href='#home'>home</a></p></li>
              <li><p class='navbarbuttons'><a href='#blogs'>blogs</a></p></li>
              <li><p class='navbarbuttons'><a href='#contact'>contact</a></p></li>
              <li><p class='navbarbuttons'>about</p></li>
          </ul>
        </div>
        <div class="blogsection" id="blogs">
            <div class="blogleft">
              <h1 class="frontheader">Blog Posts</h1>
              <p class="frontcaption">some of my recent musings</p>
            </div>
            <div class="blogright">
                  <?php
                    echoBox('viewpost.php?postId=1', 'About me', 'Here"s a little bit about me.');
                    echoBox('viewpost.php?postId=2', 'My thoughts on the weather', 'The weather is always interesting to talk about.');
                    echoBox('viewpost.php?postId=3', 'Recipes', 'Here are some of my favorite recipes.');
                    echoBox('viewpost.php?postId=4', 'Going on Walks', 'I love going on walks, here are some thoughts on walks.');
                  ?>
            </div>
        </div>  
        <div class="contactsection" id="contact">
          <div class="icons"> 
            <span class="iconcaptions">
              <img src="github icon.png" alt="github icon" width="70" height="70">
              <p><a href="https://github.com/graceleeLACRM">GitHub</a></p>
            </span>
            <span class="iconcaptions">
              <img src="linkedin icon.png" alt="linkedin icon" width="70" height="70">
              <p><a href="https://linkedin.com/in/eun1229">LinkedIn</a></p>
            </span>
            <span class="iconcaptions">
              <img src="mail icon.png" alt="mail icon" width="70" height="70">
              <p><a href="mailto: eunhae.l@wustl.edu">email</a></p>
            </span>
          </div>
        </div>
    </body>
</html>
