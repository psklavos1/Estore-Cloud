var rowEditing = false;

// delete Button // reject Button
$(document).ready(function () {
  $(".delete-btn, .reject-btn").click(function () {
    let answer = confirm("Are you sure?");
    console.log(answer);
    if (answer) {
      var tr = $(this).closest("tr");
      var btn_div = $(this).closest("div");
      var del_id = btn_div.attr("id");
      $.ajax({
        type: "POST",
        url: "../ajaxfiles/delete_user.php",
        data: { del_id: del_id },
        success: function (response) {
          if (response == 0) {
            // remove from table
            tr.fadeOut(150, function () {
              tr.remove();
            });
          } else alert(response);
        },
        error: function () {
          alert("Problem deleting this item");
        },
      });
    }
  });
});

// approve Button
$(document).ready(function () {
  $(".approve-btn").on("click", function (event) {
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();

    var target = $(event.target).closest("div");
    user_id = target.attr("id");
    data = { id: user_id };

    $.ajax({
      url: "../ajaxfiles/confirm_user.php",
      method: "POST",
      datatype: "json",
      data: data,
      success: function (response) {
        console.log(response);
        // when confirmed change the buttons for the user
        $(target).addClass("confirmed");
        $(target).html(
          "<a id =" +
            user_id +
            ' value="edit" class = "edit-btn" title="Edit" onclick="change_btns(this)"><i class="fas fa-edit" id = "edit-svg"></i></a> \
        <a id = ' +
            user_id +
            ' value="save" class = "save-btn invisible" title="Save" onclick="change_btns(this)"><i class="fas fa-save" id = "save-edit-svg"></i></a>  \
        <a id = ' +
            user_id +
            ' value="reject" class = "reject-btn-edit invisible" title="Cancel" onclick="change_btns(this)"><i class="fas fa-times" id = "cancel-edit-svg"></i></a> \
        <a value="delete" class = "delete-btn" title="Remove"><i class="fas fa-user-slash"></i></a>'
        );
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
});

var idChanging;
// change visible btns
let change_btns = function (a) {
  var id = $(a).attr("id");
  if (!rowEditing || (rowEditing && idChanging == id)) {
    $("#" + id + ".edit-btn").toggleClass("invisible");
    $("#" + id + ".reject-btn-edit").toggleClass("invisible");
    $("#" + id + ".save-btn").toggleClass("invisible");
  }
};

const prevData = [];

// Handle edit button pressed
$(document).ready(function () {
  $(document).on("click", ".edit-btn", function () {
    if (rowEditing == false) {
      rowEditing = true;
      var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
      idChanging = $(tr[0]).html();

      // store data before change
      for (let i = 0; i < tr.length; i++) {
        prevData[i] = $(tr[i]).html();
      }
      tr.attr("contenteditable", "true");
    } else {
      alert("Another row is being edited currently");
    }
  });
});

// if reject edit is pressed stop editing, return to prior state
$(document).ready(function () {
  $(document).on("click", ".reject-btn-edit", function () {
    rowEditing = false;
    // cancel editable
    var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
    tr.attr("contenteditable", "false");

    for (let i = 0; i < prevData.length; i++) {
      $(tr[i]).html(prevData[i]);
    }
  });
});

// Handle save button pressed
$(document).ready(function () {
  $(document).on("click", ".save-btn", function () {
    rowEditing = false;
    var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
    tr.attr("contenteditable", "false");
    var tr = $(this).closest("tr");
    var i = 0;
    var cols = new Array(6);
    $(tr)
      .find("td")
      .each(function () {
        cols[i] = $(this).text();
        i += 1;
      });
    var update_id = $(this).attr("id");
    data = {
      user_id: update_id,
      name: cols[1],
      surname: cols[2],
      username: cols[3],
      email: cols[4],
      role: cols[5],
    };

    $.ajax({
      type: "POST",
      url: "../ajaxfiles/edit_user.php",
      data: data,
      success: function () {
        console.log("Success");
        // change_btns(update_id);
      },
      error: function (jqXHR, exception) {
        var msg = "";
        if (jqXHR.status === 0) {
          msg = "Not connect.\n Verify Network.";
        } else if (jqXHR.status == 404) {
          msg = "Requested page not found. [404]";
        } else if (jqXHR.status == 500) {
          msg = "Internal Server Error [500].";
        } else if (exception === "parsererror") {
          msg = "Requested JSON parse failed.";
        } else if (exception === "timeout") {
          msg = "Time out error.";
        } else if (exception === "abort") {
          msg = "Ajax request aborted.";
        } else {
          msg = "Uncaught Error.\n" + jqXHR.responseText;
        }
        alert(msg);
      },
    });
  });
});
