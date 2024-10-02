
window.addEventListener("load", e=> {
  document.getElementById("submitButton").addEventListener('click', e=> {

    let artistOutput = "";
    for (const child in document.getElementById("Artists").childNodes) {
      if (child.type === "checkbox") {
        if (child.checked) {
          artistOutput += child.value + ",";
        }
      }
    }

    let albumName = document.getElementById("fname").value;
    let releaseYear = document.getElementById("ryear").value;


    alert("albumName: " + albumName + " release year: " + releaseYear);
  } );
  document.getElementById("addButton").addEventListener('click', e => {
    let newButton = document.createElement("input");
    document.getElementById("tracks").appendChild(newButton);
    newButton.setAttribute("name", "Tracks");
    newButton.setAttribute("class", "tracks");

    let newDelete = document.createElement("button");
    newDelete.setAttribute("class", "deleteButton button1");
    newDelete.setAttribute("type", "button")
    document.getElementById("tracks").appendChild(newDelete);
    newDelete.innerHTML = 'Remove'
    newDelete.addEventListener('click', e => {
      newButton.remove();
      newDelete.remove();
    })

  })
});

function triangle(x, y) {
  let l = y;
  for (let i = 0; i <= x; i++) {
    console.log(l);
    l += y;
  }
}

triangle(6, "%");
