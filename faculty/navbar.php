 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enroll_exam_list.php">Enroll Request List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enroll_student_results.php">Enrolled Student Results</a>
                </li>
                <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Forum
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="CreateNewPost.php">Create New post</a>
    <a class="dropdown-item" href="my_post.php">My Post</a>
    <a class="dropdown-item" href="other_post.php">Other Posts</a>
    
  </div>
</div>
   </ul>
      <div class="d-flex">
      <a class="nav-link" style="color:#C7C8C9" href="faculty_profile.php">Profile(<?php echo Session::get('name') ?>)</a>
      <a class="nav-link "  style="color:#C7C8C9" href="?action=logout">Logout</a>  
      </div>
    </div>
  
</nav>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	