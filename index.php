<?php
  include('include/init.php');
  echoHeader("Grace's website");
?>
        <div class="bigparent">
          <div class="fourcontentsflex" style="justify-content: flex-start;">
            <h1 class="frontheader">Hi, I'm Grace</h1>
            <span class="icon">
              <img src="grace lee headshot.jpg" alt="My Face" width="70" height="70" style="border-radius: 50%;">
            </span>
          </div>
          <p class="frontcaption">Welcome to my blog</p>
          <div class="fourcontentsflex">
            <div class="twocontentsflex">
              <?php
                echoBox('viewpost.php?postId=1', 'About me', 'Here"s a little bit about me.');
                echoBox('viewpost.php?postId=2', 'My thoughts on the weather', 'The weather is always interesting to talk about.');
              ?>
            </div>
            <div class="twocontentsflex">
              <?php
                echoBox('viewpost.php?postId=3', 'Recipes', 'Here are some of my favorite recipes.');
                echoBox('viewpost.php?postId=4', 'Going on Walks', 'I love going on walks, here are some thoughts on walks.');
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="contactsection" id="contact">
        <h1>Contact and Socials</h1>
      </div>
    </body>
</html>
