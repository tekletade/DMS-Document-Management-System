<!DOCTYPE html>
<html>
  <head>
    <title>AJAX Search Example</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="x-dummy.css">
    <script>
    function asearch () {
      // (A) GET SEARCH TERM
      var data = new FormData(document.getElementById("form"));
      data.append("ajax", 1);

      // (B) AJAX SEARCH REQUEST
      fetch("search.php", { method:"POST", body:data })
      .then(res => res.json())
      .then(res => {
        var wrapper = document.getElementById("results");
        if (res.length > 0) {
          wrapper.innerHTML = "";
          for (let r of res) {
            let line = document.createElement("div");
            line.innerHTML = `${r["name"]} - ${r["user_id"]}`;
            wrapper.appendChild(line);
          }
        } else { wrapper.innerHTML = "No results found"; }
      });
      return false;
    }
    </script>
  </head>
  <body>
    <!-- (A) SEARCH FORM -->
    <form id="form" onsubmit="return asearch();">
      <input type="text" name="search" placeholder="Search..." required>
      <input type="submit" value="Search">
    </form>

    <!-- (B) SEARCH RESULTS -->
    <div id="results"></div>
  </body>
</html>