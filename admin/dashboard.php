<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Blog</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="index.html" class="nav__logo">BLOGGER</a>
            <ul class="nav__items">
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="service.html">Service</a></li>
                <li><a href="contact.html">Contact</a></li>
                <!--<li><a href="signin.html">Signin</a></li>-->
                <liv class="nav__profile">
                    <div class="avatar">
                        <img src="./images/avaani.jpg">
                    </div>
                    <ul>
                        <li><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="logout.html">Logout</a></li>
                    </ul>
                </liv>
            </ul>    
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
<section class="dashboard">
    <div class="container dashboard__container">
        <aside>
            <ul>
                <li><a href="add-post.html"><i class="uil uil-pen"></i>
                    <h5>Add Post</h5>
                </a>
                </li>
                <li><a href="dashboard.html" class="active"><i class="uil uil-postcard"></i>
                <h5>Manage Posts</h5>
                </a>
                </li>
                <li><a href="add-user.html"><i class="uil uil-user-plus"></i>
                <h5>Add User</h5>
                </a>
                </li>
                <li><a href="manage-users.html"><i class="uil uil-users-alt"></i>
            <h5>Manage Users</h5>
                </a>
                </li>
                <li><a href="add-category.html"><i class="uil uil-edit"></i>
                    <h5>Add Category</h5>
                        </a>
                </li>
                <li><a href="manage-categories.html" ><i class="uil uil-list-ul"></i>
                    <h5>Manage Categories</h5>
                        </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td>Wild Life</td>
                        <td><a href="edit-post.html" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.html" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td>Wild Life</td>
                        <td><a href="edit-post.html" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.html" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td>Wild Life</td>
                        <td><a href="edit-post.html" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.html" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td>Wild Life</td>
                        <td><a href="edit-post.html" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.html" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</section>
<footer>
    <div class="footer__socials">
        <a href="https://www.youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
        <a href="https://www.facebook.com" target="_blank"><i class="uil uil-facebook"></i></a>
        <a href="https://www.twitter.com" target="_blank"><i class="uil uil-twitter"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="uil uil-instagram"></i></a>
    </div>
    <div class="container footer__container">
        <article>
            <h4>Category</h4>
            <ul>
                <li><a href="">Art</a></li>
                <li><a href="">Wild Life</a></li>
                <li><a href="">Travel</a></li>
                <li><a href="">Music</a></li>
                <li><a href="">Science</a></li>
                <li><a href="">Gaming</a></li>
            </ul>
        </article>
        <article>
            <h4>Blog</h4>
            <ul>
                <li><a href="">Safety</a></li>
                <li><a href="">Repair</a></li>
                <li><a href="">Recent</a></li>
                <li><a href="">Popular</a></li>
                <li><a href="">Categories</a></li>
                
            </ul>
        </article>
        <article>
            <h4>Support</h4>
            <ul>
                <li><a href="">Online Support</a></li>
                <li><a href="">Social Support</a></li>
                <li><a href="">Call Number</a></li>
                <li><a href="">Location</a></li>
                <li><a href="">Emails</a></li>
            </ul>
        </article>
        <article>
            <h4>Permalinks</h4>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Service</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </article>

    </div>
  </footer>