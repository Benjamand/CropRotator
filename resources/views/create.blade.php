<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<script defer src={{asset("scripts/Form.js")}}></script>

<link rel="stylesheet" href={{asset("css/style.css")}}>

<!-- Header -->
<header>
    <title>
        Musicify
    </title>
</header>

<!-- BODY -->

<head>
    <header>
        <meta charset="UTF-8">
        <title>"Music"</title>
        <h1 style="background-color:DodgerBlue;">Musicify</h1>
    </header>
</head>


<body>

<form id="form" action="/action_page.php">



    <!-- Navigation -->
    <nav>
        <ul>
            <a class="active" href="#home">Home</a>
            <a href="MyAlbumLink"> My albums</a>
            <a href="WishlistLink">Wishlist</a>
            <a href="FriendsLink">Friends</a>
            <input type="text" placeholder="Search.."> <br>
        </ul>
    </nav>

    <!-- Section: Body -->
    <section>
        <div>
            <div>
                <label for="fname">Album name:</label><br>
                <input type="text" id="fname" name="fname" value=""><br>
                <label for="ryear">Release year:</label><br>
                <input type="number" id="ryear" name="ryear" value=""><br><br>
            </div>

            <div id="Artists">
                <label for="fname">Artist:</label><br>
                <input type="checkbox" id="Artist1" name="Artist1" value="Drake">
                <label for="Artist1"> Drake </label><br>
                <input type="checkbox" id="Artist2" name="Artist2" value="Lamin">
                <label for="Artist2"> Lamin </label><br>
                <input type="checkbox" id="Artist3" name="Artist3" value="Khaybar">
                <label for="Artist3"> Khaybar </label><br><br>
            </div>

            <div>
                <label for="Kunstnerid">Choose a feat. Artist :</label>

                <select name="Kunstner" id="Kunstnerid"><br>
                    <option value="Khaybar">Khaybar</option>
                    <option value="Dj OmarDick">DJ OmarDick</option>
                    <option value="K to the O">K to the O</option>
                    <option value="Pumper KO">Pumper KO</option>
                </select><br><br>
            </div>

            <div>
                <label for="fname">Type:</label><br>
                <input type="radio" id="single" name="single" value="">
                <label for="single"> Single </label><br>
                <input type="radio" id="EP" name="EP" value="">
                <label for="EP"> EP </label><br>
                <input type="radio" id="album" name="album" value="">
                <label for="album"> Album </label><br><br>
            </div>

            <div>
                <label for="fname">Desciption:</label><br>
                <textarea id ="description" name="description" rows="4" cols="50">
  </textarea><br>
            </div>

            <br><label for="fname">Tracks:</label><br>
            <div id="tracks">
                <input type="text" class="tracks" id="Tracksid" name="Tracks" maxlength="10"><br>
            </div>
            <button type="button" class="button button1 addButton" id="addButton">Add</button>
        </div>

        <!-- Submit -->
        <button class="button button1 submitButton" id="submitButton">Submit</button>
        <!-- Submit
      <br><input type="submit" value="Submit"> <br>
          -->

    </section>

</form>

<!-- Footer -->
<div>
    <footer>
        <p>FOOTER</p>
    </footer>
</div>
</body>

</html>

